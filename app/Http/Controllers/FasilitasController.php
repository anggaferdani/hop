<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class FasilitasController extends Controller
{
    public function index(){
        $fasilitasies = Fasilitas::where('status_aktif', 'Aktif')->latest()->paginate(10);
        return view('fasilitas.index', compact(
            'fasilitasies',
        ));
    }

    public function create(){
        return view('fasilitas.create');
    }

    public function store(Request $request){
        $request->validate([
            'fasilitas' => 'required',
        ]);

        $array = array(
            'fasilitas' => $request['fasilitas'],
        );

        $fasilitas = Fasilitas::create($array);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.fasilitas.index')->with('success', 'Data has been created at '.$fasilitas->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.fasilitas.index')->with('success', 'Data has been created at '.$fasilitas->created_at);
        }
    }

    public function show($id){
        $fasilitas = Fasilitas::find(Crypt::decrypt($id));
        return view('fasilitas.show', compact(
            'fasilitas',
        ));
    }

    public function edit($id){
        $fasilitas = Fasilitas::find(Crypt::decrypt($id));
        return view('fasilitas.edit', compact(
            'fasilitas',
        ));
    }

    public function update(Request $request, $id){
        $fasilitas = Fasilitas::find(Crypt::decrypt($id));

        $request->validate([
            'fasilitas' => 'required',
        ]);

        $fasilitas->update([
            'fasilitas' => $request['fasilitas'],
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.fasilitas.index')->with('success', 'Data has been updated at '.$fasilitas->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.fasilitas.index')->with('success', 'Data has been updated at '.$fasilitas->updated_at);
        }
    }

    public function destroy($id){
        $fasilitas = Fasilitas::find(Crypt::decrypt($id));
        
        $fasilitas->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.fasilitas.index')->with('success', 'Data has been deleted at '.$fasilitas->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.fasilitas.index')->with('success', 'Data has been deleted at '.$fasilitas->updated_at);
        }
    }
}
