<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\Crypt;

class PendaftarController extends Controller
{
    public function index($agenda_id){
        $agenda = Agenda::find(Crypt::decrypt($agenda_id));
        $pendaftars = Pendaftar::with('jenis_tikets')->latest()->paginate(10);
        return view('pendaftar.index', compact(
            'agenda',
            'pendaftars',
        ));
    }
}
