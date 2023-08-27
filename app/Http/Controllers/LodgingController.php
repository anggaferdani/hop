<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lodging;
use App\Models\Fasilitas;
use App\Models\HangoutPlace;
use App\Models\LodgingImage;
use Illuminate\Http\Request;
use App\Models\HangoutPlaceImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class LodgingController extends Controller
{
    public function index(){
        if(!empty(auth()->user()->level_admin == 'Lodging')){
            $lodgings = HangoutPlace::with('hangout_place_images')->where('status', 'Lodging')->where('created_by', Auth::id())
            ->orderBy('status_approved', 'DESC')->orderBy('created_at', 'DESC')
            ->where('status_aktif', 'Aktif')
            ->latest()->paginate(10);
        }else{
            $lodgings = HangoutPlace::with('hangout_place_images')->where('status', 'Lodging')
            ->orderBy('status_approved', 'DESC')->orderBy('created_at', 'DESC')
            ->where('status_aktif', 'Aktif')
            ->latest()->paginate(10);
        }
        
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('lodging.index', compact(
            'lodgings',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function create(){
        $fasilitasies = Fasilitas::select('id', 'fasilitas')->where('status_aktif', 'Aktif')->get();
        $provinsis = DB::table('m_provinsi')->get();
        return view('lodging.create', compact(
            'fasilitasies',
            'provinsis',
        ));
    }

    public function store(Request $request){
        $request->validate([
            'nama_tempat' => 'required',
            'deskripsi_tempat' => 'required',
            'image' => 'required',
            'lokasi' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'harga' => 'required',
            'fasilitas' => 'required',
        ]);

        if(Auth::check()){
            $array = array(
                'nama_tempat' => $request['nama_tempat'],
                'deskripsi_tempat' => $request['deskripsi_tempat'],
                'lokasi' => $request['lokasi'],
                'provinsi' => $request['provinsi'],
                'kabupaten_kota' => $request['kabupaten_kota'],
                'kecamatan' => $request['kecamatan'],
                'harga' => $request['harga'],
                'instagram' => $request['instagram'],
                'tiktok' => $request['tiktok'],
                'status' => 'Lodging',
                'status_approved' => 'Approved',
            );
        }else{
            $array = array(
                'nama_tempat' => $request['nama_tempat'],
                'deskripsi_tempat' => $request['deskripsi_tempat'],
                'lokasi' => $request['lokasi'],
                'provinsi' => $request['provinsi'],
                'kabupaten_kota' => $request['kabupaten_kota'],
                'kecamatan' => $request['kecamatan'],
                'harga' => $request['harga'],
                'instagram' => $request['instagram'],
                'tiktok' => $request['tiktok'],
                'status' => 'Lodging',
            );
        }

        $lodging = HangoutPlace::create($array);

        if($request->has('image')){
            foreach($request->file('image') as $image){
                $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                $image->move(public_path('lodging/image/'), $image2);
                HangoutPlaceImage::create([
                    'hangout_place_id' => $lodging->id,
                    'image' => $image2,
                ]);
            }
        }

        $lodging->fasilitas()->attach($request->fasilitas);

        if(Auth::check()){
            if(auth()->user()->level == 'Superadmin'){
                return redirect()->route('superadmin.lodging.index')->with('success', 'Data has been created at '.$lodging->created_at);
            }elseif(auth()->user()->level == 'Admin'){
                return redirect()->route('admin.lodging.index')->with('success', 'Data has been created at '.$lodging->created_at);
            }
        }else{
            return back()->with('success', 'Data has been created at '.$lodging->created_at);
        }
    }

    public function show($id){
        $lodging = HangoutPlace::with('hangout_place_images')->find(Crypt::decrypt($id));
        $fasilitas_id = $lodging->fasilitas->pluck('id');
        $fasilitasies = Fasilitas::select('id', 'fasilitas')->where('status_aktif', 'Aktif')->get();
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('lodging.show', compact(
            'lodging',
            'fasilitas_id',
            'fasilitasies',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function edit($id){
        $lodging = HangoutPlace::with('hangout_place_images')->find(Crypt::decrypt($id));
        $fasilitas_id = $lodging->fasilitas->pluck('id');
        $fasilitasies = Fasilitas::select('id', 'fasilitas')->where('status_aktif', 'Aktif')->get();
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('lodging.edit', compact(
            'lodging',
            'fasilitas_id',
            'fasilitasies',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function update(Request $request, $id){
        $lodging = HangoutPlace::with('hangout_place_images', 'fasilitas')->find(Crypt::decrypt($id));

        $request->validate([
            'nama_tempat' => 'required',
            'deskripsi_tempat' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'harga' => 'required',
        ]);

        $lodging->update([
            'nama_tempat' => $request['nama_tempat'],
            'deskripsi_tempat' => $request['deskripsi_tempat'],
            'provinsi' => $request['provinsi'],
            'kabupaten_kota' => $request['kabupaten_kota'],
            'kecamatan' => $request['kecamatan'],
            'harga' => $request['harga'],
            'instagram' => $request['instagram'],
            'tiktok' => $request['tiktok'],
        ]);

        if($request->has('image')){
            foreach($request->file('image') as $image){
                $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                $image->move(public_path('lodging/image/'), $image2);
                HangoutPlaceImage::create([
                    'hangout_place_id' => $lodging->id,
                    'image' => $image2,
                ]);
            }
        }

        $lodging->fasilitas()->sync($request->fasilitas);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.lodging.index')->with('success', 'Data has been updated at '.$lodging->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.lodging.index')->with('success', 'Data has been updated at '.$lodging->updated_at);
        }
    }

    public function destroy($id){
        $lodging = HangoutPlace::find(Crypt::decrypt($id));
        
        $lodging->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.lodging.index')->with('success', 'Data has been deleted at '.$lodging->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.lodging.index')->with('success', 'Data has been deleted at '.$lodging->updated_at);
        }
    }

    public function deleteImage($id){
        $image = HangoutPlaceImage::find(Crypt::decrypt($id));
        
        if(file_exists(public_path("lodging/image/".$image->image))){
            File::delete("lodging/image/".$image->image);
        }
        
        $image->delete();

        return back()->with('success', 'Data has been deleted at '.Carbon::now()->toDateTimeString());
    }

    public function approved($id){
        $lodging = HangoutPlace::find(Crypt::decrypt($id));
        
        $lodging->update([
            'status_approved' => 'Approved',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.lodging.index')->with('success', 'Data has been approved at '.$lodging->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.lodging.index')->with('success', 'Data has been approved at '.$lodging->updated_at);
        }
    }

    public function deletePermanently($id){
        $lodging = HangoutPlace::find(Crypt::decrypt($id));
        
        $lodging->delete();

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.lodging.index')->with('success', 'Data has been deleted permanently at '.$lodging->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.lodging.index')->with('success', 'Data has been deleted permanently at '.$lodging->updated_at);
        }
    }
}
