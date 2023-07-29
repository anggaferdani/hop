<?php

namespace App\Http\Livewire;

use App\Models\Seating;
use Livewire\Component;
use App\Models\HangoutPlace;

class FoodAndBeverage extends Component
{
    public $seatings;
    public $food_and_beverages;
    public $provinsi;
    public $kabupaten;
    public $kecamatan;
    public $selectedSeating = [];
    public $harga;

    public function mount()
    {
        $this->seatings = Seating::where('status_aktif', 'Aktif')->get();
        $this->food_and_beverages = HangoutPlace::where([['status', 'Food And Beverage'], ['status_aktif', 'Aktif']])->get();
    }

    public function render()
    {
        return view('livewire.food-and-beverage');
    }

    public function searching()
    {
        $food_and_beverage = HangoutPlace::query();

        if(!empty($this->provinsi)){
            $food_and_beverage = $food_and_beverage->whereHas('Provinsi', function($query){
                $query->where('nama_provinsi', 'like', '%'.$this->provinsi.'%');
            });
        }
        if(!empty($this->kabupaten)){
            $food_and_beverage = $food_and_beverage->whereHas('Kabupaten', function($query){
                $query->where('nama_kabupaten', 'like', '%'.$this->kabupaten.'%');
            });
        }
        if(!empty($this->kecamatan)){
            $food_and_beverage = $food_and_beverage->whereHas('Kecamatan', function($query){
                $query->where('nama_kecamatan', 'like', '%'.$this->kecamatan.'%');
            });
        }
        if(!empty($this->selectedSeating)){
            $food_and_beverage = $food_and_beverage->whereHas('seatings', function($query){
                $query->whereIn('seating_id', $this->selectedSeating);
            });
        }
        if(!empty($this->harga)){
            $food_and_beverage = $food_and_beverage->where('harga', '=', $this->harga);
        }

        $this->food_and_beverages = $food_and_beverage->where('status', 'Food And Beverage')->where('status_aktif', 'Aktif')->get();
    }
}