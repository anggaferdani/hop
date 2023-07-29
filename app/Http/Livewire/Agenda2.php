<?php

namespace App\Http\Livewire;

use App\Models\Agenda;
use Livewire\Component;

class Agenda2 extends Component
{
    public $agendas;
    public $provinsi;
    public $kabupaten;
    public $kecamatan;
    public $tanggal_mulai;
    public $tanggal_berakhir;
    
    public function mount()
    {
        $this->agendas = Agenda::with('Provinsi')->where('status_aktif', 'Aktif')->get();
    }

    public function render()
    {
        return view('livewire.agenda2');
    }

    public function searching(){
        $agenda = Agenda::query();

        if(!empty($this->provinsi)){
            $agenda = $agenda->whereHas('Provinsi', function($query){
                $query->where('nama_provinsi', 'like', '%'.$this->provinsi.'%');
            });
        }
        if(!empty($this->kabupaten)){
            $agenda = $agenda->whereHas('Kabupaten', function($query){
                $query->where('nama_kabupaten', 'like', '%'.$this->kabupaten.'%');
            });
        }
        if(!empty($this->kecamatan)){
            $agenda = $agenda->whereHas('Kecamatan', function($query){
                $query->where('nama_kecamatan', 'like', '%'.$this->kecamatan.'%');
            });
        }
        if(!empty($this->tanggal_mulai) && !empty($this->tanggal_berakhir)){
            $agenda = $agenda->whereBetween('tanggal_mulai', [$this->tanggal_mulai.' 00:00:00', $this->tanggal_berakhir.' 23:59:59']);
        }elseif(!empty($this->tanggal_mulai)){
            $agenda = $agenda->whereDate('tanggal_mulai', '>=', $this->tanggal_mulai);
        }elseif(!empty($this->tanggal_berakhir)){
            $agenda = $agenda->whereDate('tanggal_berakhir', '<=', $this->tanggal_berakhir);
        }

        $this->agendas = $agenda->where('status_aktif', 'Aktif')->get();
    }
}
