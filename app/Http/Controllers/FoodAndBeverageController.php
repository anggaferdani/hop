<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Feature;
use App\Models\Seating;
use App\Models\Entertaiment;
use App\Models\HangoutPlace;
use Illuminate\Http\Request;
use App\Models\HangoutPlaceImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class FoodAndBeverageController extends Controller
{
    public function index(){
        $food_and_beverages = HangoutPlace::with('hangout_place_images')->where('status', 'Food And Beverage')->where('status_aktif', 'Aktif')->latest()->paginate(10);
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
        $features = Feature::select('id', 'feature')->where('status_aktif', 'Aktif')->get();
        $entertaiments = Entertaiment::select('id', 'entertaiment')->where('status_aktif', 'Aktif')->get();
        $provinsis = DB::table('m_provinsi')->get();
        return view('food-and-beverage.create', compact(
            'seatings',
            'provinsis',
            'features',
            'entertaiments',
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
            'feature.*' => 'required',
            'entertaiment.*' => 'required',
        ]);

        $array = array(
            'nama_tempat' => $request['nama_tempat'],
            'deskripsi_tempat' => $request['deskripsi_tempat'],
            'lokasi' => $request['lokasi'],
            'provinsi' => $request['provinsi'],
            'kabupaten_kota' => $request['kabupaten_kota'],
            'kecamatan' => $request['kecamatan'],
            'harga' => $request['harga'],
            'status' => 'Food And Beverage',
        );

        if($logo = $request->file('logo')){
            $destination_path = 'food-and-beverage/logo/';
            $logo2 = date('YmdHis').rand(999999999, 9999999999).$logo->getClientOriginalName();
            $logo->move($destination_path, $logo2);
            $array['logo'] = $logo2;
        }

        $food_and_beverage = HangoutPlace::create($array);

        if($request->has('image')){
            foreach($request->file('image') as $image){
                $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                $image->move(public_path('food-and-beverage/image/'), $image2);
                HangoutPlaceImage::create([
                    'hangout_place_id' => $food_and_beverage->id,
                    'image' => $image2,
                ]);
            }
        }

        $food_and_beverage->seatings()->attach($request->seating);
        $food_and_beverage->features()->attach($request->feature);
        $food_and_beverage->entertaiments()->attach($request->entertaiment);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.food-and-beverage.index')->with('success', 'Data has been created at '.$food_and_beverage->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.food-and-beverage.index')->with('success', 'Data has been created at '.$food_and_beverage->created_at);
        }
    }

    public function show($id){
        $food_and_beverage = HangoutPlace::with('hangout_place_images')->find(Crypt::decrypt($id));
        $seating_id = $food_and_beverage->seatings->pluck('id');
        $feature_id = $food_and_beverage->features->pluck('id');
        $entertaiment_id = $food_and_beverage->entertaiments->pluck('id');
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('food-and-beverage.show', compact(
            'food_and_beverage',
            'seating_id',
            'feature_id',
            'entertaiment_id',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function edit($id){
        $seatings = Seating::select('id', 'seating')->where('status_aktif', 'Aktif')->get();
        $features = Feature::select('id', 'feature')->where('status_aktif', 'Aktif')->get();
        $entertaiments = Entertaiment::select('id', 'entertaiment')->where('status_aktif', 'Aktif')->get();
        $food_and_beverage = HangoutPlace::with('hangout_place_images')->find(Crypt::decrypt($id));
        $seating_id = $food_and_beverage->seatings->pluck('id');
        $feature_id = $food_and_beverage->features->pluck('id');
        $entertaiment_id = $food_and_beverage->entertaiments->pluck('id');
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('food-and-beverage.edit', compact(
            'food_and_beverage',
            'seating_id',
            'feature_id',
            'entertaiment_id',
            'seatings',
            'features',
            'entertaiments',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function update(Request $request, $id){
        $food_and_beverage = HangoutPlace::with('hangout_place_images')->find(Crypt::decrypt($id));

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

        if($logo = $request->file('logo')){
            $destination_path = 'food-and-beverage/logo/';
            $logo2 = date('YmdHis').rand(999999999, 9999999999).$logo->getClientOriginalName();
            $logo->move($destination_path, $logo2);
            $food_and_beverage['logo'] = $logo2;
        }

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
                HangoutPlaceImage::create([
                    'food_and_beverage_id' => $food_and_beverage->id,
                    'image' => $image2,
                ]);
            }
        }

        $food_and_beverage->seatings()->sync($request->seating);
        $food_and_beverage->faetures()->sync($request->faeture);
        $food_and_beverage->entertaiments()->sync($request->entertaiment);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.food-and-beverage.index')->with('success', 'Data has been updated at '.$food_and_beverage->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.food-and-beverage.index')->with('success', 'Data has been updated at '.$food_and_beverage->updated_at);
        }
    }

    public function destroy($id){
        $food_and_beverage = HangoutPlace::find(Crypt::decrypt($id));
        
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
        $image = HangoutPlaceImage::find(Crypt::decrypt($id));
        
        if(file_exists(public_path("food-and-beverage/image/".$image->image))){
            File::delete("food-and-beverage/image/".$image->image);
        }

        $image->delete();
        
        return back()->with('success', 'Data has been deleted at '.Carbon::now()->toDateTimeString());
    }
}
