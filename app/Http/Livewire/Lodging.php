<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Provinsi;
use App\Models\Fasilitas;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\HangoutPlace;

class Lodging extends Component
{
    public $fasilitasies;
    public $lodgings;
    public $provinsi;
    public $kabupaten;
    public $kecamatan;
    public $selectedFasilitas = [];
    public $harga;

    public $selectedProvinsi;
    public $kabupatens = [];
    public $selectedKabupaten;
    public $kecamatans = [];

    public function mount()
    {
        $this->fasilitasies = Fasilitas::where('status_aktif', 'Aktif')->get();
        $this->lodgings = HangoutPlace::where([['status', 'Lodging'], ['status_approved', 'Approved'], ['status_aktif', 'Aktif']])->get();
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

        return view('livewire.lodging')->with([
            'provinsis' => $provinsis,
        ]);
    }

    public function searching()
    {
        $lodging = HangoutPlace::query();

        if(!empty($this->provinsi)){
            $lodging = $lodging->whereHas('provinsi', function($query){
                $query->where('id_provinsi', 'like', '%'.$this->provinsi.'%');
            });
        }
        if(empty($this->provinsi)){
            $lodging = $lodging->where('status_aktif', 'Aktif');
        }
        if(!empty($this->kabupaten)){
            $lodging = $lodging->whereHas('kabupaten', function($query){
                $query->where('id_kabupaten', 'like', '%'.$this->kabupaten.'%');
            });
        }
        if(!empty($this->kecamatan)){
            $lodging = $lodging->whereHas('kecamatan', function($query){
                $query->where('id_kecamatan', 'like', '%'.$this->kecamatan.'%');
            });
        }
        if(!empty($this->selectedFasilitas)){
            $lodging = $lodging->whereHas('fasilitas', function($query){
                $query->whereIn('fasilitas_id', $this->selectedFasilitas);
            });
        }
        if(!empty($this->harga)){
            $lodging = $lodging->where('harga', '=', $this->harga);
        }

        $this->lodgings = $lodging->where('status', 'Lodging')->where('status_approved', 'Approved')->where('status_aktif', 'Aktif')->get();
    }
}
