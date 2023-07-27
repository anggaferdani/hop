<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Seating;
use Illuminate\Http\Request;
use App\Models\FoodAndBeverage;
use Illuminate\Support\Facades\DB;
use App\Models\FoodAndBeverageImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class FoodAndBeverageController extends Controller
{
    public function index(){
        $food_and_beverages = FoodAndBeverage::with('food_and_beverage_images')->where('status_aktif', 'Aktif')->latest()->paginate(10);
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('food-and-beverage.index', compact(
            'food_and_beverages',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function create(){
        $seatings = Seating::select('id', 'seating')->where('status_aktif', 'Aktif')->get();
        $provinsis = DB::table('m_provinsi')->get();
        return view('food-and-beverage.create', compact(
            'seatings',
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
            'seating.*' => 'required',
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

        $food_and_beverage = FoodAndBeverage::create($array);

        if($request->has('image')){
            foreach($request->file('image') as $image){
                $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                $image->move(public_path('food-and-beverage/image/'), $image2);
                FoodAndBeverageImage::create([
                    'food_and_beverage_id' => $food_and_beverage->id,
                    'image' => $image2,
                ]);
            }
        }

        $food_and_beverage->seatings()->attach($request->seating);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.food-and-beverage.index')->with('success', 'Data has been created at '.$food_and_beverage->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.food-and-beverage.index')->with('success', 'Data has been created at '.$food_and_beverage->created_at);
        }
    }

    public function show($id){
        $food_and_beverage = FoodAndBeverage::with('food_and_beverage_images')->find(Crypt::decrypt($id));
        $seating_id = $food_and_beverage->seatings->pluck('id');
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('food-and-beverage.show', compact(
            'food_and_beverage',
            'seating_id',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function edit($id){
        $seatings = Seating::select('id', 'seating')->where('status_aktif', 'Aktif')->get();
        $food_and_beverage = FoodAndBeverage::with('food_and_beverage_images')->find(Crypt::decrypt($id));
        $seating_id = $food_and_beverage->seatings->pluck('id');
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('food-and-beverage.edit', compact(
            'food_and_beverage',
            'seating_id',
            'seatings',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function update(Request $request, $id){
        $food_and_beverage = FoodAndBeverage::with('food_and_beverage_images')->find(Crypt::decrypt($id));

        $request->validate([
            'nama_tempat' => 'required',
            'deskripsi_tempat' => 'required',
            'image.*' => 'required',
            'lokasi' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'harga' => 'required',
        ]);

        $food_and_beverage->update([
            'nama_tempat' => $request['nama_tempat'],
            'deskripsi_tempat' => $request['deskripsi_tempat'],
            'lokasi' => $request['lokasi'],
            'provinsi' => $request['provinsi'],
            'kabupaten_kota' => $request['kabupaten_kota'],
            'kecamatan' => $request['kecamatan'],
            'harga' => $request['harga'],
        ]);

        if($request->has('image')){
            foreach($request->file('image') as $image){
                $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                $image->move(public_path('food-and-beverage/image/'), $image2);
                FoodAndBeverageImage::create([
                    'food_and_beverage_id' => $food_and_beverage->id,
                    'image' => $image2,
                ]);
            }
        }

        $food_and_beverage->seatings()->sync($request->seating);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.food-and-beverage.index')->with('success', 'Data has been updated at '.$food_and_beverage->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.food-and-beverage.index')->with('success', 'Data has been updated at '.$food_and_beverage->updated_at);
        }
    }

    public function destroy($id){
        $food_and_beverage = FoodAndBeverage::find(Crypt::decrypt($id));
        
        $food_and_beverage->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.food-and-beverage.index')->with('success', 'Data has been deleted at '.$food_and_beverage->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.food-and-beverage.index')->with('success', 'Data has been deleted at '.$food_and_beverage->updated_at);
        }
    }

    public function deleteImage($id){
        $image = FoodAndBeverageImage::find(Crypt::decrypt($id));
        
        if(file_exists(public_path("food-and-beverage/image/".$image->image))){
            File::delete("food-and-beverage/image/".$image->image);
        }

        $image->delete();
        
        return back()->with('success', 'Data has been deleted at '.Carbon::now()->toDateTimeString());
    }
}
