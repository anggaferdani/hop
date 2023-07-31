<?php

namespace App\Http\Livewire;

use App\Models\Agenda;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;

class Search extends Component
{
    public $query;
    public $agendas;
    public $highlightIndex;

    public function mount()
    {
        $this->reset2();
    }

    public function reset2()
    {
        $this->query = '';
        $this->agendas = [];
        $this->highlightIndex = 0;
    }

    public function incrementHighlight()
    {
        if($this->highlightIndex === count($this->agendas) - 1){
            $this->highlightIndex = 0;
            return;
        }

        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if($this->highlightIndex === 0){
            $this->highlightIndex = count($this->agendas) - 1;
            return;
        }

        $this->highlightIndex--;
    }

    public function selectContact()
    {
        $agendas = $this->agendas[$this->highlightIndex] ?? null;
        if($agendas){
            $this->redirect(route('agenda', Crypt::encrypt($agendas['id'])));
        }
    }

    public function updatedQuery()
    {
        $this->agendas = Agenda::where('judul', 'like', '%' . $this->query . '%')->orWhere('deskripsi', 'like', '%' . $this->query . '%')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.search');
    }
}
