<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Agenda;
use App\Models\Banner;
use App\Models\Update;
use App\Models\Lodging;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\FoodAndBeverage;
use App\Models\ActivityManajemen;
use App\Models\Fasilitas;
use App\Models\Tag;
use Illuminate\Support\Facades\Crypt;

class FrontController extends Controller
{
    public function index(){
        $updates = Update::with('update_images')->where('status_aktif', 'Aktif')->latest()->get();
        $agendas = Agenda::with('agenda_images')->where('status_aktif', 'Aktif')->latest()->get();
        $banners = Banner::where('status_aktif', 'Aktif')->latest()->get();
        return view('front.index', compact(
            'updates',
            'agendas',
            'banners',
        ));
    }

    public function updates(){
        $update_banners = Update::with('update_images')->where('status_aktif', 'Aktif')->latest()->get();
        $updates = Update::with('update_images')->where('status_aktif', 'Aktif')->latest()->get();
        $tags = Tag::where('status_aktif', 'Aktif')->get();
        return view('front.updates', compact(
            'update_banners',
            'updates',
            'tags',
        ));
    }

    public function update($id){
        $update = Update::with('users', 'update_images')->find(Crypt::decrypt($id));
        return view('front.update', compact(
            'update',
        ));
    }

    public function tags($id){
        $tag = Tag::with(["updates" => function($query){ $query->where("status_aktif", "Aktif"); }])->where('id', Crypt::decrypt($id))->where('status_aktif', 'Aktif')->find(Crypt::decrypt($id));
        return view('front.tags', compact(
            'tag',
        ));
    }

    public function agendas(Request $request){
        $query = Agenda::query();

        if(isset($request->provinsi) && ($request->provinsi != null)){
            $query->where('provinsi', $request->provinsi);
        }
        if(isset($request->kabupaten_kota) && ($request->kabupaten_kota != null)){
            $query->where('kabupaten_kota', $request->kabupaten_kota);
        }
        if(isset($request->kecamatan) && ($request->kecamatan != null)){
            $query->where('kecamatan', $request->kecamatan);
        }
        if((isset($request->tanggal_mulai) && ($request->tanggal_mulai != null) && isset($request->tanggal_berakhir) && ($request->tanggal_berakhir != null))){
            $tanggal_mulai = Carbon::parse($request->tanggal_mulai);
            $tanggal_berakhir = Carbon::parse($request->tanggal_berakhir);

            $query->where([['tanggal_mulai', '<=', $tanggal_mulai], ['tanggal_berakhir', '>=', $tanggal_berakhir]])
            ->orwhereBetween('tanggal_mulai', array($tanggal_mulai, $tanggal_berakhir))
            ->orWhereBetween('tanggal_berakhir', array($tanggal_mulai, $tanggal_berakhir))->get();
        }

        $agendas = $query->with('agenda_images')->where('status_aktif', 'Aktif')->latest()->paginate(3);
        return view('front.agendas', compact(
            'agendas',
        ));
    }

    public function agenda($id){
        $agenda = Agenda::with('agenda_images')->find(Crypt::decrypt($id));
        return view('front.agenda', compact(
            'agenda',
        ));
    }

    public function food_and_beverages(Request $request){
        $query = FoodAndBeverage::query();

        if(isset($request->provinsi) && ($request->provinsi != null)){
            $query->where('provinsi', $request->provinsi);
        }
        if(isset($request->kabupaten_kota) && ($request->kabupaten_kota != null)){
            $query->where('kabupaten_kota', $request->kabupaten_kota);
        }
        if(isset($request->kecamatan) && ($request->kecamatan != null)){
            $query->where('kecamatan', $request->kecamatan);
        }
        if(isset($request->seating) && ($request->seating != null)){
            $query->where('seating', $request->seating);
        }
        if(isset($request->harga) && ($request->harga != null)){
            $query->where('harga', $request->harga);
        }

        $food_and_beverages = $query->with('food_and_beverage_images')->where('status_aktif', 'Aktif')->latest()->get();

        return view('front.food-and-beverages', compact(
            'food_and_beverages',
        ));
    }

    public function food_and_beverage($id){
        $food_and_beverage = FoodAndBeverage::with('food_and_beverage_images')->find(Crypt::decrypt($id));
        return view('front.food-and-beverage', compact(
            'food_and_beverage',
        ));
    }

    public function lodgings(Request $request){
        $query = Lodging::query();
        $fasilitasies = Fasilitas::where('status_aktif', 'Aktif')->get();

        if(isset($request->provinsi) && ($request->provinsi != null)){
            $query->where('provinsi', $request->provinsi);
        }
        if(isset($request->kabupaten_kota) && ($request->kabupaten_kota != null)){
            $query->where('kabupaten_kota', $request->kabupaten_kota);
        }
        if(isset($request->kecamatan) && ($request->kecamatan != null)){
            $query->where('kecamatan', $request->kecamatan);
        }
        if(isset($request->harga) && ($request->harga != null)){
            $query->where('harga', $request->harga);
        }

        $lodgings = $query->with('lodging_images')->where('status_aktif', 'Aktif')->latest()->get();

        return view('front.lodgings', compact(
            'fasilitasies',
            'lodgings',
        ));
    }

    public function lodging($id){
        $lodging = Lodging::with('lodging_images')->find(Crypt::decrypt($id));
        return view('front.lodging', compact(
            'lodging',
        ));
    }

    public function activity_manajemens(){
        $kategoris = Kategori::with('activity_manajemens.activity_manajemen_images')->with(["activity_manajemens" => function($query){ $query->where("status_aktif", "Aktif"); }])->whereHas("activity_manajemens", function($query){ $query->where("status_aktif", "Aktif"); })->where('status_aktif', 'Aktif')->get();
        return view('front.activity-manajemens', compact(
            'kategoris',
        ));
    }

    public function activity_manajemen($id){
        $activity_manajemen = ActivityManajemen::with('activity_manajemen_images')->find(Crypt::decrypt($id));
        $kategoris = Kategori::with('activity_manajemens', 'activity_manajemens.activity_manajemen_images')->with(["activity_manajemens" => function($query) use ($id){ $query->where('id', '<>', Crypt::decrypt($id)); }])->whereHas("activity_manajemens", function($query){ $query->where("status_aktif", "Aktif"); })->where('status_aktif', 'Aktif')->latest()->get();
        return view('front.activity-manajemen', compact(
            'activity_manajemen',
            'kategoris',
        ));
    }
    
    public function kategoris($id){
        $kategori = Kategori::with('activity_manajemens', 'activity_manajemens.activity_manajemen_images')->with(["activity_manajemens" => function($query){ $query->where("status_aktif", "Aktif"); }])->where('id', Crypt::decrypt($id))->where('status_aktif', 'Aktif')->find(Crypt::decrypt($id));
        return view('front.kategoris', compact(
            'kategori',
        ));
    }

    public function about_us(){
        return view('front.about-us');
    }

    public function autocomplete(Request $request){
        $search = $request->search;

        if($search == ''){
            $autocomplate = Agenda::orderby('judul', 'asc')->select('id', 'judul')->where('status_aktif', 'Aktif')->get();
        }else{
            $autocomplate = Agenda::orderby('judul', 'asc')->select('id', 'judul')->where('judul', 'like', '%' .$search . '%')->where('status_aktif', 'Aktif')->get();
        }

        $response = array();
        foreach($autocomplate as $autocomplate){
            $response[] = array("value" => $autocomplate->id, "label" => $autocomplate->judul);
        }

        return response()->json($response);
    }

    public function search(Request $request){
        $search = $request->search;

        if($search != ""){
            $agenda = Agenda::where('judul', 'LIKE', '%' . $search . '%')->where('status_aktif', 'Aktif')->first();
            if($agenda){
                return redirect()->route('agenda', Crypt::encrypt($agenda->id));
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }
}
