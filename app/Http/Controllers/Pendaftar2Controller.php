<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Pendaftar2Controller extends Controller
{
    public function index(){
        $pendaftars = Pendaftar::with('jenis_tikets')
        ->orderBy('status_approved', 'DESC')->orderBy('created_at', 'DESC')
        ->where('status_aktif', 'Aktif')->latest()->paginate(10);
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('pendaftar2.index', compact(
            'pendaftars',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }
}
