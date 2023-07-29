<?php

namespace App\Http\Livewire;

use App\Models\Fasilitas;
use Livewire\Component;
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

    public function mount()
    {
        $this->fasilitasies = Fasilitas::where('status_aktif', 'Aktif')->get();
        $this->lodgings = HangoutPlace::where([['status', 'Lodging'], ['status_aktif', 'Aktif']])->get();
    }

    public function render()
    {
        return view('livewire.lodging');
    }

    public function searching()
    {
        $lodging = HangoutPlace::query();

        if(!empty($this->provinsi)){
            $lodging = $lodging->whereHas('provinsi', function($query){
                $query->where('nama_provinsi', 'like', '%'.$this->provinsi.'%');
            });
        }
        if(!empty($this->kabupaten)){
            $lodging = $lodging->whereHas('kabupaten', function($query){
                $query->where('nama_kabupaten', 'like', '%'.$this->kabupaten.'%');
            });
        }
        if(!empty($this->kecamatan)){
            $lodging = $lodging->whereHas('kecamatan', function($query){
                $query->where('nama_kecamatan', 'like', '%'.$this->kecamatan.'%');
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

        $this->lodgings = $lodging->where('status', 'Lodging')->where('status_aktif', 'Aktif')->get();
    }
}
