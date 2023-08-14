<?php

namespace App\Http\Livewire;

use App\Models\ActivityManajemen;
use App\Models\Agenda;
use App\Models\HangoutPlace;
use App\Models\Update;
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
        if($agendas->getTable() == 'agendas'){
            $this->redirect(route('agenda', Crypt::encrypt($agendas['id'])));
        }elseif($agendas->getTable() == 'updates'){
            $this->redirect(route('update', Crypt::encrypt($agendas['id'])));
        }elseif($agendas->getTable() == 'hangout_places'){
            $this->redirect(route('food-and-beverage', Crypt::encrypt($agendas['id'])));
        }elseif($agendas->getTable() == 'hangout_places'){
            $this->redirect(route('lodging', Crypt::encrypt($agendas['id'])));
        }elseif($agendas->getTable() == 'hangout_places'){
            $this->redirect(route('public-area', Crypt::encrypt($agendas['id'])));
        }elseif($agendas->getTable() == 'activity_manajemens'){
            $this->redirect(route('activity-manajemen', Crypt::encrypt($agendas['id'])));
        }
    }

    public function updatedQuery()
    {
        $agenda2 = Agenda::selectRaw(' *, "agenda" as from_table')->where('judul', 'like', '%' . $this->query . '%')->orWhere('deskripsi', 'like', '%' . $this->query . '%')->where('status_aktif', 'Aktif')->get();
        $update2 = Update::selectRaw(' *, "update" as from_table')->where('judul', 'like', '%' . $this->query . '%')->orWhere('deskripsi', 'like', '%' . $this->query . '%')->where('status_aktif', 'Aktif')->get();
        $food_and_beverage2 = HangoutPlace::selectRaw(' *, "food-and-beverage" as from_table')->where('nama_tempat', 'like', '%' . $this->query . '%')->where('status', 'Food And Beverage')->where('status_aktif', 'Aktif')->get();
        $lodging2 = HangoutPlace::selectRaw(' *, "lodging" as from_table')->where('nama_tempat', 'like', '%' . $this->query . '%')->where('status', 'Lodging')->where('status_aktif', 'Aktif')->get();
        $public_area2 = HangoutPlace::selectRaw(' *, "public-area" as from_table')->where('nama_tempat', 'like', '%' . $this->query . '%')->where('status', 'Public Area')->where('status_aktif', 'Aktif')->get();
        $activity_manajemen2 = ActivityManajemen::selectRaw(' *, "activity-manajemen" as from_table')->where('judul', 'like', '%' . $this->query . '%')->orWhere('deskripsi', 'like', '%' . $this->query . '%')->where('status_aktif', 'Aktif')->get();

        $this->agendas = $agenda2->union($update2)->union($food_and_beverage2)->union($lodging2)->union($public_area2)->union($activity_manajemen2);
    }

    public function render()
    {
        return view('livewire.search');
    }
}
