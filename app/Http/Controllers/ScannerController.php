<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;

class ScannerController extends Controller
{
    public function scanner(){
        return view('scanner');
    }

    public function searchByBarcode(Request $request)
    {
        $barcode = $request->input('barcode');

        $item = Pendaftar::where('token', $barcode)->first();

        return response()->json(['item' => $item]);
    }
}
