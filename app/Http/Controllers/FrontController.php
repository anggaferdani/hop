<?php

namespace App\Http\Controllers;

use App\Models\ActivityManajemen;
use App\Models\Agenda;
use App\Models\Banner;
use App\Models\FoodAndBeverage;
use App\Models\Kategori;
use App\Models\Lodging;
use App\Models\Update;
use Illuminate\Http\Request;
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
        $updates = Update::with('update_images')->where('status_aktif', 'Aktif')->latest()->paginate(10);
        return view('front.updates', compact(
            'update_banners',
            'updates',
        ));
    }

    public function update($id){
        $update = Update::with('users', 'update_images')->find(Crypt::decrypt($id));
        return view('front.update', compact(
            'update',
        ));
    }

    public function agendas(){
        $agendas = Agenda::with('agenda_images')->where('status_aktif', 'Aktif')->latest()->paginate(3);
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

    public function food_and_beverages(){
        $food_and_beverages = FoodAndBeverage::with('food_and_beverage_images')->where('status_aktif', 'Aktif')->latest()->get();
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

    public function lodgings(){
        $lodgings = Lodging::with('lodging_images')->where('status_aktif', 'Aktif')->latest()->get();
        return view('front.lodgings', compact(
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
}