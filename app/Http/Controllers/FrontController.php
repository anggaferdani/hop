<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Agenda;
use App\Models\Banner;
use App\Models\Update;
use App\Models\Lodging;
use App\Models\Seating;
use App\Models\Kategori;
use App\Models\Provinsi;
use App\Models\Fasilitas;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\View\View;
use App\Models\PublicArea;
use Illuminate\Support\Str;
use App\Models\HangoutPlace;
use Illuminate\Http\Request;
use Jorenvh\Share\ShareFacade;
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
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('front.index', compact(
            'updates',
            'agendas',
            'banners',
            'provinsis',
            'kabupatens',
            'kecamatans',
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
        $share = ShareFacade::page(
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
        $agendas = Agenda::with('agenda_images', 'hangout_places')->where('status_aktif', 'Aktif')->paginate(9);
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('front.agendas', compact(
            'agendas',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function agenda($id){
        $agenda = Agenda::with('agenda_images', 'jenis_tikets', 'hangout_places')->find(Crypt::decrypt($id));
        $agendas = Agenda::with('agenda_images')->where('id', '<>', Crypt::decrypt($id))->where("status_aktif", "Aktif")->latest()->get();
        $provinsi = Provinsi::find($agenda->provinsi);
        $kabupaten = Kabupaten::find($agenda->kabupaten_kota);
        $kecamatan = Kecamatan::find($agenda->kecamatan);
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        $share = ShareFacade::page(
            'http://hop.co.id/agenda/'.$id, $agenda->judul,
        )
        ->facebook()
        ->twitter()
        ->telegram()
        ->whatsapp();
        return view('front.agenda', compact(
            'agenda',
            'agendas',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'provinsis',
            'kabupatens',
            'kecamatans',
            'share',
        ));
    }

    public function food_and_beverages (Request $request) {
        $seatings = Seating::where('status_aktif', 'Aktif')->get();

        $food_and_beverages = HangoutPlace::with('hangout_place_images')->where('status', 'Food And Beverage')->where('status_aktif', 'Aktif')->get();
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();

        return view('front.food-and-beverages', compact(
            'seatings',
            'food_and_beverages',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function sportainments(){
        return view('front.sportainments');
    }

    public function sportainment($id){
        $sportainment = HangoutPlace::with('hangout_place_images', 'hangout_place_logos')->find(Crypt::decrypt($id));
        $sportainments = HangoutPlace::with('hangout_place_images', 'hangout_place_logos')->whereHas('hangout_place_logos')->where('id', '<>', Crypt::decrypt($id))->where('status', 'Food And Beverage')->where("status_aktif", "Aktif")->latest()->get();
        $provinsi = Provinsi::find($sportainment->provinsi);
        $kabupaten = Kabupaten::find($sportainment->kabupaten_kota);
        $kecamatan = Kecamatan::find($sportainment->kecamatan);
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        $share = ShareFacade::page(
            'http://hop.co.id/sportainment/'.$id, $sportainment->judul,
        )
        ->facebook()
        ->twitter()
        ->telegram()
        ->whatsapp();
        return view('front.sportainment', compact(
            'sportainment',
            'sportainments',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'provinsis',
            'kabupatens',
            'kecamatans',
            'share',
        ));
    }

    public function food_and_beverage($id){
        $food_and_beverage = HangoutPlace::with('hangout_place_images')->find(Crypt::decrypt($id));
        $food_and_beverages = HangoutPlace::with('hangout_place_images')->where('id', '<>', Crypt::decrypt($id))->where('status', 'Food And Beverage')->where("status_aktif", "Aktif")->latest()->get();
        $provinsi = Provinsi::find($food_and_beverage->provinsi);
        $kabupaten = Kabupaten::find($food_and_beverage->kabupaten_kota);
        $kecamatan = Kecamatan::find($food_and_beverage->kecamatan);
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        $share = ShareFacade::page(
            'http://hop.co.id/food-and-beverage/'.$id, $food_and_beverage->judul,
        )
        ->facebook()
        ->twitter()
        ->telegram()
        ->whatsapp();
        return view('front.food-and-beverage', compact(
            'food_and_beverage',
            'food_and_beverages',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'provinsis',
            'kabupatens',
            'kecamatans',
            'share',
        ));
    }

    public function lodgings(Request $request){
        $fasilitasies = Fasilitas::where('status_aktif', 'Aktif')->get();
        $lodgings = HangoutPlace::with('hangout_place_images')->where('status', 'Lodging')->where('status_aktif', 'Aktif')->latest()->get();
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
        $lodging = HangoutPlace::with('hangout_place_images')->find(Crypt::decrypt($id));
        $lodgings = HangoutPlace::with('hangout_place_images')->where('id', '<>', Crypt::decrypt($id))->where('status', 'Lodging')->where("status_aktif", "Aktif")->latest()->get();
        $provinsi = Provinsi::find($lodging->provinsi);
        $kabupaten = Kabupaten::find($lodging->kabupaten_kota);
        $kecamatan = Kecamatan::find($lodging->kecamatan);
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        $share = ShareFacade::page(
            'http://hop.co.id/lodging/'.$id, $lodging->judul,
        )
        ->facebook()
        ->twitter()
        ->telegram()
        ->whatsapp();
        return view('front.lodging', compact(
            'lodging',
            'lodgings',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'provinsis',
            'kabupatens',
            'kecamatans',
            'share',
        ));
    }

    public function public_areas(Request $request){
        $public_areas = HangoutPlace::with('hangout_place_images')->where('status', 'Public Area')->where('status_aktif', 'Aktif')->latest()->get();
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();

        return view('front.public-areas', compact(
            'public_areas',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function public_area($id){
        $public_area = HangoutPlace::with('hangout_place_images')->find(Crypt::decrypt($id));
        $public_areas = HangoutPlace::with('hangout_place_images')->where('id', '<>', Crypt::decrypt($id))->where('status', 'Public Area')->where("status_aktif", "Aktif")->latest()->get();
        $provinsi = Provinsi::find($public_area->provinsi);
        $kabupaten = Kabupaten::find($public_area->kabupaten_kota);
        $kecamatan = Kecamatan::find($public_area->kecamatan);
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        $share = ShareFacade::page(
            'http://hop.co.id/public-area/'.$id, $public_area->judul,
        )
        ->facebook()
        ->twitter()
        ->telegram()
        ->whatsapp();
        return view('front.public-area', compact(
            'public_area',
            'public_areas',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'provinsis',
            'kabupatens',
            'kecamatans',
            'share',
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
        $provinsi = Provinsi::find($activity_manajemen->provinsi);
        $kabupaten = Kabupaten::find($activity_manajemen->kabupaten_kota);
        $kecamatan = Kecamatan::find($activity_manajemen->kecamatan);
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        $share = ShareFacade::page(
            'http://hop.co.id/activity-manajemen/'.$id, $activity_manajemen->judul,
        )
        ->facebook()
        ->twitter()
        ->telegram()
        ->whatsapp();
        return view('front.activity-manajemen', compact(
            'activity_manajemen',
            'kategoris',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'provinsis',
            'kabupatens',
            'kecamatans',
            'share',
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
