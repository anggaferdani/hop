<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\PublicArea;
use Illuminate\Http\Request;
use App\Models\PublicAreaImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class PublicAreaController extends Controller
{
    public function index(){
        $public_areas = PublicArea::with('public_area_images')->where('status_aktif', 'Aktif')->latest()->paginate(10);
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('public-area.index', compact(
            'public_areas',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function create(){
        $provinsis = DB::table('m_provinsi')->get();
        return view('public-area.create', compact(
            'provinsis',
        ));
    }

    public function store(Request $request){
        $request->validate([
            'nama_tempat' => 'required',
            'deskripsi_tempat' => 'required',
            'image.*' => 'required',
            'lokasi' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
        ]);

        $array = array(
            'nama_tempat' => $request['nama_tempat'],
            'deskripsi_tempat' => $request['deskripsi_tempat'],
            'lokasi' => $request['lokasi'],
            'provinsi' => $request['provinsi'],
            'kabupaten_kota' => $request['kabupaten_kota'],
            'kecamatan' => $request['kecamatan'],
        );

        $public_area = PublicArea::create($array);

        if($request->has('image')){
            foreach($request->file('image') as $image){
                $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                $image->move(public_path('public-area/image/'), $image2);
                PublicAreaImage::create([
                    'public_area_id' => $public_area->id,
                    'image' => $image2,
                ]);
            }
        }

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.public-area.index')->with('success', 'Data has been created at '.$public_area->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.public-area.index')->with('success', 'Data has been created at '.$public_area->created_at);
        }
    }

    public function show($id){
        $public_area = PublicArea::with('public_area_images')->find(Crypt::decrypt($id));
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('public-area.show', compact(
            'public_area',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function edit($id){
        $public_area = PublicArea::with('public_area_images')->find(Crypt::decrypt($id));
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('public-area.edit', compact(
            'public_area',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function update(Request $request, $id){
        $public_area = PublicArea::with('public_area_images')->find(Crypt::decrypt($id));

        $request->validate([
            'nama_tempat' => 'required',
            'deskripsi_tempat' => 'required',
            'image.*' => 'required',
            'lokasi' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
        ]);

        $public_area->update([
            'nama_tempat' => $request['nama_tempat'],
            'deskripsi_tempat' => $request['deskripsi_tempat'],
            'lokasi' => $request['lokasi'],
            'provinsi' => $request['provinsi'],
            'kabupaten_kota' => $request['kabupaten_kota'],
            'kecamatan' => $request['kecamatan'],
        ]);

        if($request->has('image')){
            foreach($request->file('image') as $image){
                $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                $image->move(public_path('public-area/image/'), $image2);
                PublicAreaImage::create([
                    'public_area_id' => $public_area->id,
                    'image' => $image2,
                ]);
            }
        }

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.public-area.index')->with('success', 'Data has been updated at '.$public_area->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.public-area.index')->with('success', 'Data has been updated at '.$public_area->updated_at);
        }
    }

    public function destroy($id){
        $public_area = PublicArea::find(Crypt::decrypt($id));
        
        $public_area->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.public-area.index')->with('success', 'Data has been deleted at '.$public_area->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.public-area.index')->with('success', 'Data has been deleted at '.$public_area->updated_at);
        }
    }

    public function deleteImage($id){
        $image = PublicAreaImage::find(Crypt::decrypt($id));
        
        if(file_exists(public_path("public-area/image/".$image->image))){
            File::delete("public-area/image/".$image->image);
        }

        $image->delete();
        
        return back()->with('success', 'Data has been deleted at '.Carbon::now()->toDateTimeString());
    }
}