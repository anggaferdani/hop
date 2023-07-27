<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lodging;
use App\Models\Fasilitas;
use App\Models\LodgingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class LodgingController extends Controller
{
    public function index(){
        $lodgings = Lodging::with('lodging_images')->where('status_aktif', 'Aktif')->latest()->paginate(10);
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
            'image.*' => 'required',
            'lokasi' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'harga' => 'required',
            'fasilitas.*' => 'required',
        ]);

        $array = array(
            'nama_tempat' => $request['nama_tempat'],
            'deskripsi_tempat' => $request['deskripsi_tempat'],
            'lokasi' => $request['lokasi'],
            'provinsi' => $request['provinsi'],
            'kabupaten_kota' => $request['kabupaten_kota'],
            'kecamatan' => $request['kecamatan'],
            'harga' => $request['harga'],
        );

        $lodging = Lodging::create($array);

        if($request->has('image')){
            foreach($request->file('image') as $image){
                $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                $image->move(public_path('lodging/image/'), $image2);
                LodgingImage::create([
                    'lodging_id' => $lodging->id,
                    'image' => $image2,
                ]);
            }
        }

        $lodging->fasilitas()->attach($request->fasilitas);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.lodging.index')->with('success', 'Data has been created at '.$lodging->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.lodging.index')->with('success', 'Data has been created at '.$lodging->created_at);
        }
    }

    public function show($id){
        $lodging = Lodging::with('lodging_images')->find(Crypt::decrypt($id));
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
        $lodging = Lodging::with('lodging_images')->find(Crypt::decrypt($id));
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
        $lodging = Lodging::with('lodging_images', 'fasilitas')->find(Crypt::decrypt($id));

        $request->validate([
            'nama_tempat' => 'required',
            'deskripsi_tempat' => 'required',
            'image.*' => 'required',
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
        ]);

        if($request->has('image')){
            foreach($request->file('image') as $image){
                $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                $image->move(public_path('lodging/image/'), $image2);
                LodgingImage::create([
                    'lodging_id' => $lodging->id,
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
        $lodging = Lodging::find(Crypt::decrypt($id));
        
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
        $image = LodgingImage::find(Crypt::decrypt($id));
        
        if(file_exists(public_path("lodging/image/".$image->image))){
            File::delete("lodging/image/".$image->image);
        }
        
        $image->delete();

        return back()->with('success', 'Data has been deleted at '.Carbon::now()->toDateTimeString());
    }
}
