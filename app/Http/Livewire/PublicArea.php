<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\HangoutPlace;

class PublicArea extends Component
{
    public $public_areas;
    public $provinsi;
    public $kabupaten;
    public $kecamatan;

    public $selectedProvinsi;
    public $kabupatens = [];
    public $selectedKabupaten;
    public $kecamatans = [];

    public function mount()
    {
        $this->public_areas = HangoutPlace::where([['status', 'Public Area'], ['status_approved', 'Approved'], ['status_aktif', 'Aktif']])->get();
    }

    public function render()
    {
        if(!empty($this->selectedProvinsi)){
            $this->kabupatens = Kabupaten::where('id_provinsi', $this->selectedProvinsi)->get();
        }
        if(!empty($this->selectedKabupaten)){
            $this->kecamatans = Kecamatan::where('id_kabupaten', $this->selectedKabupaten)->get();
        }

        $provinsis = Provinsi::all();
        
        return view('livewire.public-area')->with([
            'provinsis' => $provinsis,
        ]);
    }

    public function searching()
    {
        $public_area = HangoutPlace::query();

        if(!empty($this->provinsi)){
            $public_area = $public_area->whereHas('provinsi', function($query){
                $query->where('id_provinsi', 'like', '%'.$this->provinsi.'%');
            });
        }
        if(empty($this->provinsi)){
            $public_area = $public_area->where('status_aktif', 'Aktif');
        }
        if(!empty($this->kabupaten)){
            $public_area = $public_area->whereHas('kabupaten', function($query){
                $query->where('id_kabupaten', 'like', '%'.$this->kabupaten.'%');
            });
        }
        if(!empty($this->kecamatan)){
            $public_area = $public_area->whereHas('kecamatan', function($query){
                $query->where('id_kecamatan', 'like', '%'.$this->kecamatan.'%');
            });
        }
        $this->public_areas = $public_area->where('status', 'Public Area')->where('status_approved', 'Approved')->where('status_aktif', 'Aktif')->get();
    }
}
