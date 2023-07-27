<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Agenda;
use App\Models\Banner;
use App\Models\Update;
use App\Models\Lodging;
use App\Models\Kategori;
use App\Models\Provinsi;
use App\Models\Fasilitas;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FoodAndBeverage;
use App\Models\ActivityManajemen;
use Illuminate\Support\Facades\DB;
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
        $updates = Update::with('users', 'update_images')->where('id', '<>', Crypt::decrypt($id))->where("status_aktif", "Aktif")->latest()->get();
        $share = \Share::page(
            'http://hop.co.id/update/'.$id, $update->judul,
        )
        ->facebook()
        ->twitter()
        ->telegram()
        ->whatsapp();
        return view('front.update', compact(
            'update',
            'updates',
            'share',
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

        $agendas = $query->with('agenda_images')->where('status_aktif', 'Aktif')->latest()->paginate(9);
        return view('front.agendas', compact(
            'agendas',
        ));
    }

    public function agenda($id){
        $agenda = Agenda::with('agenda_images', 'jenis_tikets')->find(Crypt::decrypt($id));
        $agendas = Agenda::with('agenda_images')->where('id', '<>', Crypt::decrypt($id))->where("status_aktif", "Aktif")->latest()->get();
        $share = \Share::page(
            'http://hop.co.id/agenda/'.$id, $agenda->judul,
        )
        ->facebook()
        ->twitter()
        ->telegram()
        ->whatsapp();
        return view('front.agenda', compact(
            'agenda',
            'agendas',
            'share',
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
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();

        return view('front.food-and-beverages', compact(
            'food_and_beverages',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function food_and_beverage($id){
        $food_and_beverage = FoodAndBeverage::with('food_and_beverage_images')->find(Crypt::decrypt($id));
        $food_and_beverages = FoodAndBeverage::with('food_and_beverage_images')->where('id', '<>', Crypt::decrypt($id))->where("status_aktif", "Aktif")->latest()->get();
        $provinsi = Provinsi::find($food_and_beverage->provinsi);
        $kabupaten = Kabupaten::find($food_and_beverage->kabupaten_kota);
        $kecamatan = Kecamatan::find($food_and_beverage->kecamatan);
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        return view('front.food-and-beverage', compact(
            'food_and_beverage',
            'food_and_beverages',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'provinsis',
            'kabupatens',
            'kecamatans',
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
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();

        return view('front.lodgings', compact(
            'fasilitasies',
            'lodgings',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function lodging($id){
        $lodging = Lodging::with('lodging_images')->find(Crypt::decrypt($id));
        $lodgings = Lodging::with('lodging_images')->where('id', '<>', Crypt::decrypt($id))->where("status_aktif", "Aktif")->latest()->get();
        $provinsi = Provinsi::find($lodging->provinsi);
        $kabupaten = Kabupaten::find($lodging->kabupaten_kota);
        $kecamatan = Kecamatan::find($lodging->kecamatan);
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        return view('front.lodging', compact(
            'lodging',
            'lodgings',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'provinsis',
            'kabupatens',
            'kecamatans',
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
        $search = $request->get('search');

        $agenda = DB::raw("CONCAT(`penyelenggara`, ' ', `judul`, ' ', `deskripsi`,  ' ', `jenis`, ' ', `provinsi`, ' ', `kabupaten_kota`, ' ', `kecamatan`)");
        $update = DB::raw("CONCAT(`judul`, ' ', `deskripsi`)");
        $activity_manajemen = DB::raw("CONCAT(`judul`, ' ', `deskripsi`,  ' ', `provinsi`, ' ', `kabupaten_kota`, ' ', `kecamatan`)");

        $agendas = Agenda::orderby('judul', 'asc')->where($agenda, 'like', '%' .$search . '%')->where('status_aktif', 'Aktif')->get();
        $updates = Update::orderby('judul', 'asc')->where($update, 'like', '%' .$search . '%')->where('status_aktif', 'Aktif')->get();
        $activity_manajemens = ActivityManajemen::orderby($activity_manajemen, 'asc')->where('judul', 'like', '%' .$search . '%')->where('status_aktif', 'Aktif')->get();

        $autocomplates = $agendas->union($updates)->union($activity_manajemens);

        $response = array();
        foreach($autocomplates as $autocomplate){
            $response[] = array(
                "value" => $autocomplate->id,
                "judul" => $autocomplate->judul,
                "deskripsi" => Str::limit($autocomplate->deskripsi, 75),
                "provinsi" => $autocomplate->provinsi,
                "kabupaten_kota" => $autocomplate->kabupaten_kota,
                "kecamatan" => $autocomplate->kecamatan,
                "kategori" => class_basename($autocomplate),
            );
        }

        return response()->json($response);
    }

    public function search(Request $request){
        $search = $request->get('search');

        if($search != ""){
            $agenda = Agenda::where('judul', 'LIKE', '%' . $search . '%')->where('status_aktif', 'Aktif')->first();
            $update = Update::where('judul', 'LIKE', '%' . $search . '%')->where('status_aktif', 'Aktif')->first();
            $activity_manajemen = ActivityManajemen::where('judul', 'LIKE', '%' . $search . '%')->where('status_aktif', 'Aktif')->first();
            if($agenda){
                return redirect()->route('agenda', Crypt::encrypt($agenda->id));
            }elseif($update){
                return redirect()->route('update', Crypt::encrypt($update->id));
            }elseif($activity_manajemen){
                return redirect()->route('activity-manajemen', Crypt::encrypt($activity_manajemen->id));
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }
}
