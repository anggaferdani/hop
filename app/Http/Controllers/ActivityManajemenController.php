<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Type;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\ActivityManajemen;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use App\Models\ActivityManajemenImage;

class ActivityManajemenController extends Controller
{
    public function index(){
        $activity_manajemens = ActivityManajemen::with('activity_manajemen_images')->where('status_aktif', 'Aktif')->latest()->paginate(10);
        return view('activity-manajemen.index', compact(
            'activity_manajemens',
        ));
    }

    public function create(){
        $kategoris = Kategori::select('id', 'kategori')->where('status_aktif', 'Aktif')->get();
        $types = Type::select('id', 'type')->where('status_aktif', 'Aktif')->get();
        return view('activity-manajemen.create', compact(
            'kategoris',
            'types',
        ));
    }

    public function store(Request $request){
        $request->validate([
            'kategori_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal_publikasi' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'image.*' => 'required',
            'type.*' => 'required',
        ]);

        $harga_mulai = preg_replace('/\D/', '', $request->harga_mulai);
        $harga_mulai2 = trim($harga_mulai);

        $array = array(
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
            'twitter' => $request['twitter'],
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

        $activity_manajemen->types()->attach($request->type);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.activity-manajemen.index')->with('success', 'Data has been created at '.$activity_manajemen->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.activity-manajemen.index')->with('success', 'Data has been created at '.$activity_manajemen->created_at);
        }
    }

    public function show($id){
        $activity_manajemen = ActivityManajemen::with('activity_manajemen_images')->find(Crypt::decrypt($id));
        $kategoris = Kategori::select('id', 'kategori')->where('status_aktif', 'Aktif')->get();
        $types = Type::select('id', 'type')->where('status_aktif', 'Aktif')->get();
        return view('activity-manajemen.show', compact(
            'activity_manajemen',
            'kategoris',
            'types',
        ));
    }

    public function edit($id){
        $activity_manajemen = ActivityManajemen::with('activity_manajemen_images')->find(Crypt::decrypt($id));
        $kategoris = Kategori::select('id', 'kategori')->where('status_aktif', 'Aktif')->get();
        $types = Type::select('id', 'type')->where('status_aktif', 'Aktif')->get();
        return view('activity-manajemen.edit', compact(
            'activity_manajemen',
            'kategoris',
            'types',
        ));
    }

    public function update(Request $request, $id){
        $activity_manajemen = ActivityManajemen::with('activity_manajemen_images', 'types')->find(Crypt::decrypt($id));

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
            'twitter' => $request['twitter'],
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

        $activity_manajemen->types()->sync($request->type);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.activity-manajemen.index')->with('success', 'Data has been updated at '.$activity_manajemen->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.activity-manajemen.index')->with('success', 'Data has been updated at '.$activity_manajemen->updated_at);
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
}
