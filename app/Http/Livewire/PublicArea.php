<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HangoutPlace;

class PublicArea extends Component
{
    public $public_areas;
    public $provinsi;
    public $kabupaten;
    public $kecamatan;

    public function mount()
    {
        $this->public_areas = HangoutPlace::where([['status', 'Public Area'], ['status_aktif', 'Aktif']])->get();
    }

    public function searching()
    {
        $public_area = HangoutPlace::query();

        if(!empty($this->provinsi)){
            $public_area = $public_area->whereHas('provinsi', function($query){
                $query->where('nama_provinsi', 'like', '%'.$this->provinsi.'%');
            });
        }
        if(!empty($this->kabupaten)){
            $public_area = $public_area->whereHas('kabupaten', function($query){
                $query->where('nama_kabupaten', 'like', '%'.$this->kabupaten.'%');
            });
        }
        if(!empty($this->kecamatan)){
            $public_area = $public_area->whereHas('kecamatan', function($query){
                $query->where('nama_kecamatan', 'like', '%'.$this->kecamatan.'%');
            });
        }
        $this->public_areas = $public_area->where('status', 'Public Area')->where('status_aktif', 'Aktif')->get();
    }

    public function render()
    {
        return view('livewire.public-area');
    }
}
