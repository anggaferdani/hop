<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function login(){
        return view('authentications.login');
    }

    public function postLogin(Request $request){
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        $credentials = array(
            'email' => $request['email'],
            'password' => $request['password'],
        );

        if(Auth::guard('web')->attempt($credentials)){
            if(auth()->user()->status_aktif == 'Aktif'){
                if(auth()->user()->level == 'Superadmin'){
                    return redirect()->route('superadmin.dashboard');
                }elseif(auth()->user()->level == 'Admin'){
                    return redirect()->route('admin.dashboard');
                }elseif(auth()->user()->level == 'Vendor'){
                    $verifikasi = Verifikasi::where('user_id', auth()->user()->id)->first();
                    if($verifikasi->status_verifikasi == 'Terverifikasi'){
                        return redirect()->route('vendor.dashboard');
                    }elseif($verifikasi->status_verifikasi == 'Belum Terverifikasi'){
                        Auth::guard('web')->logout();
                        return redirect()->route('login')->with('fail', 'Your account was not verified yet. A verification email has been sent to '.$request->email.'. Please check your email');
                    }else{
                        Auth::guard('web')->logout();
                        return redirect()->route('login')->with('fail', 'Your account was not verified yet. A verification email has been sent to '.$request->email.'. Please check your email');
                    }
                }else{
                    return redirect()->route('login')->with('fail', 'The account level you entered does not match');
                }
            }if(auth()->user()->status_aktif == 'Tidak Aktif'){
                Auth::guard('web')->logout();
                return redirect()->route('login')->with('fail', 'Your account has been disabled');
            }
        }else{
            return redirect()->route('login')->with('fail', 'The email or password you entered is incorrect. Please try again');
        }
    }

    public function register(){
        return view('authentications.register');
    }

    public function postRegister(Request $request){
        $request->validate([
            'nama_panjang' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'terms_and_conditions' => 'accepted',
        ]);

        $array = array(
            'nama_panjang' => $request['nama_panjang'],
            'email' => $request['email'],
            'password' => $request['password'],
            'logo' => 'DEFAULT.jpeg',
            'level' => 'Vendor',
        );

        $user = User::create($array);

        $array2 = array(
            'user_id' => $user->id,
            'status_verifikasi' => 'Belum Terverifikasi',
        );

        $verifikasi = Verifikasi::create($array2);

        $deskripsi = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta enim fugiat mollitia sit cupiditate, ea quisquam impedit qui ipsa est, tenetur eligendi ipsam labore reiciendis ullam non dolorem? Nesciunt, doloremque.';
        $url = route('verifikasi', ['service' => 'email_verification', 'user_id' => Crypt::encrypt($user->id)]);

        $mail = [
            'kepada' => $user->email,
            'email' => 'hangoutproject@gmail.com',
            'dari' => 'Hangout Project',
            'subject' => 'Verification',
            'deskripsi' => $deskripsi,
            'url' => $url,
        ];

        Mail::send('email.verification', $mail, function($message) use ($mail){
            $message->to($mail['kepada'])
            ->from($mail['email'], $mail['dari'])
            ->subject($mail['subject']);
        });

        return redirect()->route('confirmation', ['email' => Crypt::encrypt($user->email)])->with('success', 'Data has been created at '.$user->created_at);
    }

    public function confirmation($email){
        return view('authentications.confirmation')->with('email', Crypt::decrypt($email));
    }

    public function verifikasi($user_id){
        $verifikasi = Verifikasi::where('user_id', Crypt::decrypt($user_id))->first();

        $verifikasi->update([
            'status_verifikasi' => 'Terverifikasi',
        ]);

        if($verifikasi){
            return redirect()->route('vendor.dashboard');
        }
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }

    public function profile(){
        $profile = User::where('id', auth()->user()->id)->first();
        return view('profile', compact('profile'));
    }

    public function postProfile(Request $request){
        $profile = User::where('id', auth()->user()->id)->first();

        $request->validate([
            'nama_panjang' => 'required',
            'email' => 'required|email|unique:users,email,'.$profile->id.",id",
            'password' => 'nullable',
        ]);

        if($logo = $request->file('logo')){
            $destination_path = 'vendor/logo/';
            $logo2 = date('YmdHis').rand(999999999, 9999999999).$logo->getClientOriginalName();
            $logo->move($destination_path, $logo2);
            $profile['logo'] = $logo2;
        }

        if($request->password){
            $profile->email = $request->email;
            $profile->password = bcrypt($request->password);
            $profile->save();
        }else{
            $profile->email = $request->email;
            $profile->save();
        }
        
        $profile->update([
            'nama_panjang' => $request->nama_panjang,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Data has been updated at '.$profile->updated_at);
    }
}
