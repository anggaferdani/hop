<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LokasiController extends Controller
{
    public function kabupaten($id){
        $kabupatens = DB::table('m_kabupaten')->where("id_provinsi", '=', $id)->get();
        return json_encode($kabupatens);
    }

    public function kecamatan($id){
        $kecamatans = DB::table('m_kecamatan')->where("id_kabupaten", '=', $id)->get();
        return json_encode($kecamatans);
    }
}
