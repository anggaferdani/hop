<?php

namespace App\Http\Livewire;

use App\Models\Agenda;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Livewire\Component;
use App\Models\Kecamatan;

class Agenda2 extends Component
{
    public $agendas;
    public $provinsi = [];
    public $kabupaten = [];
    public $kecamatan = [];
    public $tanggal_mulai;
    public $tanggal_berakhir;

    public $selectedProvinsi;
    public $kabupatens = [];
    public $selectedKabupaten;
    public $kecamatans = [];

    public $null = '';
    
    public function mount()
    {
        $this->agendas = Agenda::with('hangout_places')->where([['status_approved', 'Approved'], ['status_aktif', 'Aktif']])->get();
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

        return view('livewire.agenda2')->with([
            'provinsis' => $provinsis,
        ]);
    }

    public function searching(){
        $agenda = Agenda::query();

        if(!empty($this->provinsi)){
            $agenda = $agenda->whereHas('hangout_places', function($query){
                $query->where('provinsi', 'like', '%'.$this->provinsi.'%');
            });
        }
            if(empty($this->provinsi)){
                $agenda = $agenda->where('status_aktif', 'Aktif');
            }
        if(!empty($this->kabupaten)){
            $agenda = $agenda->whereHas('hangout_places', function($query){
                $query->where('kabupaten_kota', 'like', '%'.$this->kabupaten.'%');
            });
        }
        if(!empty($this->kecamatan)){
            $agenda = $agenda->whereHas('hangout_places', function($query){
                $query->where('kecamatan', 'like', '%'.$this->kecamatan.'%');
            });
        }
        if(!empty($this->tanggal_mulai) && !empty($this->tanggal_berakhir)){
            $agenda = $agenda->whereBetween('tanggal_mulai', [$this->tanggal_mulai.' 00:00:00', $this->tanggal_berakhir.' 23:59:59']);
        }elseif(!empty($this->tanggal_mulai)){
            $agenda = $agenda->whereDate('tanggal_mulai', '>=', $this->tanggal_mulai);
        }elseif(!empty($this->tanggal_berakhir)){
            $agenda = $agenda->whereDate('tanggal_berakhir', '<=', $this->tanggal_berakhir);
        }

        $this->agendas = $agenda->where('status_approved', 'Approved')->where('status_aktif', 'Aktif')->get();
    }
}
