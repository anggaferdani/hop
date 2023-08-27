<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\ActivityManajemen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use App\Models\ActivityManajemenImage;
use Illuminate\Support\Facades\Redirect;

class ActivityManajemenController extends Controller
{
    public function index(){
        if(auth()->user()->level == 'Superadmin' || auth()->user()->level == 'Admin'){
            if(!empty(auth()->user()->level_admin == 'Activity Manajemen')){
                $activity_manajemens = ActivityManajemen::with('activity_manajemen_images')->where('created_by', Auth::id())
                ->orderBy('status_approved', 'DESC')->orderBy('created_at', 'DESC')
                ->where('status_aktif', 'Aktif')
                ->latest()->paginate(10);
            }else{
                $activity_manajemens = ActivityManajemen::with('activity_manajemen_images')
                ->orderBy('status_approved', 'DESC')->orderBy('created_at', 'DESC')
                ->where('status_aktif', 'Aktif')
                ->latest()->paginate(10);
            }
            $provinsis = DB::table('m_provinsi')->get();
            $kabupatens = DB::table('m_kabupaten')->get();
            $kecamatans = DB::table('m_kecamatan')->get();
            return view('activity-manajemen.index', compact(
                'activity_manajemens',
                'provinsis',
                'kabupatens',
                'kecamatans',
            ));
        }elseif(auth()->user()->level == 'Vendor'){
            $activity_manajemens = ActivityManajemen::with('activity_manajemen_images')->where('user_id', Auth::id())->where('status_aktif', 'Aktif')->latest()->paginate(10);
            $provinsis = DB::table('m_provinsi')->get();
            $kabupatens = DB::table('m_kabupaten')->get();
            $kecamatans = DB::table('m_kecamatan')->get();
            return view('activity-manajemen.index', compact(
                'activity_manajemens',
                'provinsis',
                'kabupatens',
                'kecamatans',
            ));
        }
    }

    public function create(){
        $users = User::where('level', 'Vendor')->where('status_aktif', 'Aktif')->get();
        $kategoris = Kategori::select('id', 'kategori')->where('status_aktif', 'Aktif')->get();
        $provinsis = DB::table('m_provinsi')->get();
        return view('activity-manajemen.create', compact(
            'users',
            'kategoris',
            'provinsis',
        ));
    }

    public function store(Request $request){
        if(Auth::check()){
            if(auth()->user()->level == 'Superadmin' || auth()->user()->level == 'Admin'){
                $request->validate([
                    'user_id' => 'required',
                    'kategori_id' => 'required',
                    'judul' => 'required',
                    'deskripsi' => 'required',
                    'tanggal_publikasi' => 'required',
                    'image' => 'required',
                    'lokasi' => 'required',
                    'provinsi' => 'required',
                    'kabupaten_kota' => 'required',
                    'kecamatan' => 'required',
                    'image.*' => 'required',
                ]);

                $harga_mulai = preg_replace('/\D/', '', $request->harga_mulai);
                $harga_mulai2 = trim($harga_mulai);

                $array = array(
                    'user_id' => $request['user_id'],
                    'kategori_id' => $request['kategori_id'],
                    'judul' => $request['judul'],
                    'deskripsi' => $request['deskripsi'],
                    'tanggal_publikasi' => $request['tanggal_publikasi'],
                    'lokasi' => $request['lokasi'],
                    'provinsi' => $request['provinsi'],
                    'kabupaten_kota' => $request['kabupaten_kota'],
                    'kecamatan' => $request['kecamatan'],
                    'whatsapp' => $request['whatsapp'],
                    'instagram' => $request['instagram'],
                    'tiktok' => $request['tiktok'],
                    'harga_mulai' => $harga_mulai2,
                    'status_approved' => 'Approved',
                );

                $activity_manajemen = ActivityManajemen::create($array);

                if($request->has('image')){
                    foreach($request->file('image') as $image){
                        $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                        $image->move(public_path('activity-manajemen/image/'), $image2);
                        ActivityManajemenImage::create([
                            'activity_manajemen_id' => $activity_manajemen->id,
                            'image' => $image2,
                        ]);
                    }
                }
                

                if(auth()->user()->level == 'Superadmin'){
                    return redirect()->route('superadmin.activity-manajemen.index')->with('success', 'Data has been created at '.$activity_manajemen->created_at);
                }elseif(auth()->user()->level == 'Admin'){
                    return redirect()->route('admin.activity-manajemen.index')->with('success', 'Data has been created at '.$activity_manajemen->created_at);
                }

            }elseif(auth()->user()->level == 'Vendor'){
                $request->validate([
                    'kategori_id' => 'required',
                    'judul' => 'required',
                    'deskripsi' => 'required',
                    'tanggal_publikasi' => 'required',
                    'image' => 'required',
                    'lokasi' => 'required',
                    'provinsi' => 'required',
                    'kabupaten_kota' => 'required',
                    'kecamatan' => 'required',
                    'image.*' => 'required',
                ]);

                $harga_mulai = preg_replace('/\D/', '', $request->harga_mulai);
                $harga_mulai2 = trim($harga_mulai);

                $array = array(
                    'user_id' => Auth::id(),
                    'kategori_id' => $request['kategori_id'],
                    'judul' => $request['judul'],
                    'deskripsi' => $request['deskripsi'],
                    'tanggal_publikasi' => $request['tanggal_publikasi'],
                    'lokasi' => $request['lokasi'],
                    'provinsi' => $request['provinsi'],
                    'kabupaten_kota' => $request['kabupaten_kota'],
                    'kecamatan' => $request['kecamatan'],
                    'whatsapp' => $request['whatsapp'],
                    'instagram' => $request['instagram'],
                    'tiktok' => $request['tiktok'],
                    'harga_mulai' => $harga_mulai2,
                );

                $activity_manajemen = ActivityManajemen::create($array);

                if($request->has('image')){
                    foreach($request->file('image') as $image){
                        $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                        $image->move(public_path('activity-manajemen/image/'), $image2);
                        ActivityManajemenImage::create([
                            'activity_manajemen_id' => $activity_manajemen->id,
                            'image' => $image2,
                        ]);
                    }
                }

                return redirect()->route('vendor.activity-manajemen.index')->with('success', 'Data has been created at '.$activity_manajemen->created_at);
            }
        }else{
            if($request->sudah_mengisi_form_ini_sebelumnya == 'iya'){
                $request->validate([
                    'user_id' => 'required',
                    'kategori_id' => 'required',
                    'judul' => 'required',
                    'deskripsi' => 'required',
                    'tanggal_publikasi' => 'required',
                    'image' => 'required',
                    'lokasi' => 'required',
                    'provinsi' => 'required',
                    'kabupaten_kota' => 'required',
                    'kecamatan' => 'required',
                    'image.*' => 'required',
                ]);

                $harga_mulai = preg_replace('/\D/', '', $request->harga_mulai);
                $harga_mulai2 = trim($harga_mulai);

                $array2 = array(
                    'user_id' => $request->user_id,
                    'kategori_id' => $request['kategori_id'],
                    'judul' => $request['judul'],
                    'deskripsi' => $request['deskripsi'],
                    'tanggal_publikasi' => $request['tanggal_publikasi'],
                    'lokasi' => $request['lokasi'],
                    'provinsi' => $request['provinsi'],
                    'kabupaten_kota' => $request['kabupaten_kota'],
                    'kecamatan' => $request['kecamatan'],
                    'whatsapp' => $request['whatsapp'],
                    'instagram' => $request['instagram'],
                    'tiktok' => $request['tiktok'],
                    'harga_mulai' => $harga_mulai2,
                );

                $activity_manajemen = ActivityManajemen::create($array2);

                if($request->has('image')){
                    foreach($request->file('image') as $image){
                        $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                        $image->move(public_path('activity-manajemen/image/'), $image2);
                        ActivityManajemenImage::create([
                            'activity_manajemen_id' => $activity_manajemen->id,
                            'image' => $image2,
                        ]);
                    }
                }
            }elseif($request->sudah_mengisi_form_ini_sebelumnya == 'tidak'){
                $request->validate([
                    'logo' => 'required',
                    'nama_panjang' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'kategori_id' => 'required',
                    'judul' => 'required',
                    'deskripsi' => 'required',
                    'tanggal_publikasi' => 'required',
                    'image' => 'required',
                    'lokasi' => 'required',
                    'provinsi' => 'required',
                    'kabupaten_kota' => 'required',
                    'kecamatan' => 'required',
                    'image.*' => 'required',
                ]);

                try{
                    DB::beginTransaction();
    
                    $array = array(
                        'nama_panjang' => $request['nama_panjang'],
                        'email' => $request['email'],
                        'level' => 'Vendor',
                        'password' => bcrypt(12345678),
                    );
    
                    if($request->has('logo')){
                        foreach($request->file('logo') as $logo){
                            $logo2 = date('YmdHis').rand(999999999, 9999999999).$logo->getClientOriginalName();
                            $logo->move(public_path('user/logo/'), $logo2);
                            $array['logo'] = $logo2;
                        }
                    }
    
                    $user = User::create($array);
    
                    $harga_mulai = preg_replace('/\D/', '', $request->harga_mulai);
                    $harga_mulai2 = trim($harga_mulai);
    
                    $array2 = array(
                        'user_id' => $user->id,
                        'kategori_id' => $request['kategori_id'],
                        'judul' => $request['judul'],
                        'deskripsi' => $request['deskripsi'],
                        'tanggal_publikasi' => $request['tanggal_publikasi'],
                        'lokasi' => $request['lokasi'],
                        'provinsi' => $request['provinsi'],
                        'kabupaten_kota' => $request['kabupaten_kota'],
                        'kecamatan' => $request['kecamatan'],
                        'whatsapp' => $request['whatsapp'],
                        'instagram' => $request['instagram'],
                        'tiktok' => $request['tiktok'],
                        'harga_mulai' => $harga_mulai2,
                    );
    
                    $activity_manajemen = ActivityManajemen::create($array2);
    
                    if($request->has('image')){
                        foreach($request->file('image') as $image){
                            $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                            $image->move(public_path('activity-manajemen/image/'), $image2);
                            ActivityManajemenImage::create([
                                'activity_manajemen_id' => $activity_manajemen->id,
                                'image' => $image2,
                            ]);
                        }
                    }
    
                    DB::commit();
                }catch(Throwable $th){
                    DB::rollback();
                    return redirect()->back()->with('error', $th->getMessage());
                }
            }

            return back()->with('success', 'Data has been created at '.$activity_manajemen->created_at);
        }
    }

    public function show($id){
        $activity_manajemen = ActivityManajemen::with('activity_manajemen_images')->find(Crypt::decrypt($id));
        $kategoris = Kategori::select('id', 'kategori')->where('status_aktif', 'Aktif')->get();
        $users = User::where('level', 'Vendor')->where('status_aktif', 'Aktif')->get();
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('activity-manajemen.show', compact(
            'activity_manajemen',
            'kategoris',
            'users',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function edit($id){
        $activity_manajemen = ActivityManajemen::with('activity_manajemen_images')->find(Crypt::decrypt($id));
        $kategoris = Kategori::select('id', 'kategori')->where('status_aktif', 'Aktif')->get();
        $users = User::where('level', 'Vendor')->where('status_aktif', 'Aktif')->get();
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('activity-manajemen.edit', compact(
            'activity_manajemen',
            'kategoris',
            'users',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function update(Request $request, $id){
        if(auth()->user()->level == 'Superadmin' || auth()->user()->level == 'Admin'){
            $activity_manajemen = ActivityManajemen::with('activity_manajemen_images')->find(Crypt::decrypt($id));

            $request->validate([
                'user_id' => 'required',
                'kategori_id' => 'required',
                'judul' => 'required',
                'deskripsi' => 'required',
                'tanggal_publikasi' => 'required',
                'provinsi' => 'required',
                'kabupaten_kota' => 'required',
                'kecamatan' => 'required',
            ]);

            $harga_mulai = preg_replace('/\D/', '', $request->harga_mulai);
            $harga_mulai2 = trim($harga_mulai);

            $activity_manajemen->update([
                'user_id' => $request['user_id'],
                'kategori_id' => $request['kategori_id'],
                'judul' => $request['judul'],
                'deskripsi' => $request['deskripsi'],
                'tanggal_publikasi' => $request['tanggal_publikasi'],
                'provinsi' => $request['provinsi'],
                'kabupaten_kota' => $request['kabupaten_kota'],
                'kecamatan' => $request['kecamatan'],
                'lokasi' => $request['lokasi'],
                'whatsapp' => $request['whatsapp'],
                'instagram' => $request['instagram'],
                'tiktok' => $request['tiktok'],
                'harga_mulai' => $harga_mulai2,
            ]);

            if($request->has('image')){
                foreach($request->file('image') as $image){
                    $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                    $image->move(public_path('activity-manajemen/image/'), $image2);
                    ActivityManajemenImage::create([
                        'activity_manajemen_id' => $activity_manajemen->id,
                        'image' => $image2,
                    ]);
                }
            }

            if(auth()->user()->level == 'Superadmin'){
                return redirect()->route('superadmin.activity-manajemen.index')->with('success', 'Data has been updated at '.$activity_manajemen->updated_at);
            }elseif(auth()->user()->level == 'Admin'){
                return redirect()->route('admin.activity-manajemen.index')->with('success', 'Data has been updated at '.$activity_manajemen->updated_at);
            }
        
        }elseif(auth()->user()->level == 'Vendor')
            {$activity_manajemen = ActivityManajemen::with('activity_manajemen_images')->find(Crypt::decrypt($id));

            $request->validate([
                'kategori_id' => 'required',
                'judul' => 'required',
                'deskripsi' => 'required',
                'tanggal_publikasi' => 'required',
                'provinsi' => 'required',
                'kabupaten_kota' => 'required',
                'kecamatan' => 'required',
            ]);

            $harga_mulai = preg_replace('/\D/', '', $request->harga_mulai);
            $harga_mulai2 = trim($harga_mulai);

            $activity_manajemen->update([
                'user_id' => Auth::id(),
                'kategori_id' => $request['kategori_id'],
                'judul' => $request['judul'],
                'deskripsi' => $request['deskripsi'],
                'tanggal_publikasi' => $request['tanggal_publikasi'],
                'provinsi' => $request['provinsi'],
                'kabupaten_kota' => $request['kabupaten_kota'],
                'kecamatan' => $request['kecamatan'],
                'lokasi' => $request['lokasi'],
                'whatsapp' => $request['whatsapp'],
                'instagram' => $request['instagram'],
                'tiktok' => $request['tiktok'],
                'harga_mulai' => $harga_mulai2,
            ]);

            if($request->has('image')){
                foreach($request->file('image') as $image){
                    $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                    $image->move(public_path('activity-manajemen/image/'), $image2);
                    ActivityManajemenImage::create([
                        'activity_manajemen_id' => $activity_manajemen->id,
                        'image' => $image2,
                    ]);
                }
            }

            return redirect()->route('vendor.activity-manajemen.index')->with('success', 'Data has been updated at '.$activity_manajemen->updated_at);
        }
    }

    public function destroy($id){
        $activity_manajemen = ActivityManajemen::find(Crypt::decrypt($id));
        
        $activity_manajemen->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.activity-manajemen.index')->with('success', 'Data has been deleted at '.$activity_manajemen->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.activity-manajemen.index')->with('success', 'Data has been deleted at '.$activity_manajemen->updated_at);
        }elseif(auth()->user()->level == 'Vendor'){
            return redirect()->route('vendor.activity-manajemen.index')->with('success', 'Data has been deleted at '.$activity_manajemen->updated_at);
        }
    }

    public function deleteImage($id){
        $image = ActivityManajemenImage::find(Crypt::decrypt($id));
        
        if(file_exists(public_path("activity-manajemen/image/".$image->image))){
            File::delete("activity-manajemen/image/".$image->image);
        }
        
        $image->delete();

        return back()->with('success', 'Data has been deleted at '.Carbon::now()->toDateTimeString());
    }

    public function approved($id){
        $activity_manajemen = ActivityManajemen::find(Crypt::decrypt($id));
        
        $activity_manajemen->update([
            'status_approved' => 'Approved',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.activity-manajemen.index')->with('success', 'Data has been approved at '.$activity_manajemen->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.activity-manajemen.index')->with('success', 'Data has been approved at '.$activity_manajemen->updated_at);
        }
    }

    public function deletePermanently($id){
        $activity_manajemen = ActivityManajemen::find(Crypt::decrypt($id));
        
        $activity_manajemen->delete();

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.activity-manajemen.index')->with('success', 'Data has been deleted permanently at '.$activity_manajemen->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.activity-manajemen.index')->with('success', 'Data has been deleted permanently at '.$activity_manajemen->updated_at);
        }
    }
}
