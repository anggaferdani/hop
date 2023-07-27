<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;

class ScannerController extends Controller
{
    public function scanner(){
        return view('scanner');
    }

    public function search(Request $request){
        $search = $request->get('search');

        $agendas = Pendaftar::where('token', 'like', '%' .$search . '%')->where('status_aktif', 'Aktif')->get();

        return view('result', compact(
            'agendas',
        ));
    }
}
