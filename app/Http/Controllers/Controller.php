<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                    return redirect()->route('vendor.dashboard');
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

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
}
