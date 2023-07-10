<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KategoriController extends Controller
{
    public function index(){
        $kategoris = Kategori::where('status_aktif', 'Aktif')->latest()->paginate(10);
        return view('kategori.index', compact(
            'kategoris',
        ));
    }

    public function create(){
        return view('kategori.create');
    }

    public function store(Request $request){
        $request->validate([
            'kategori' => 'required',
        ]);

        $array = array(
            'kategori' => $request['kategori'],
        );

        $kategori = Kategori::create($array);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.kategori.index')->with('success', 'Data has been created at '.$kategori->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.kategori.index')->with('success', 'Data has been created at '.$kategori->created_at);
        }
    }

    public function show($id){
        $kategori = Kategori::find(Crypt::decrypt($id));
        return view('kategori.show', compact(
            'kategori',
        ));
    }

    public function edit($id){
        $kategori = Kategori::find(Crypt::decrypt($id));
        return view('kategori.edit', compact(
            'kategori',
        ));
    }

    public function update(Request $request, $id){
        $kategori = Kategori::find(Crypt::decrypt($id));

        $request->validate([
            'kategori' => 'required',
        ]);

        $kategori->update([
            'kategori' => $request['kategori'],
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.kategori.index')->with('success', 'Data has been updated at '.$kategori->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.kategori.index')->with('success', 'Data has been updated at '.$kategori->updated_at);
        }
    }

    public function destroy($id){
        $kategori = Kategori::find(Crypt::decrypt($id));
        
        $kategori->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.kategori.index')->with('success', 'Data has been deleted at '.$kategori->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.kategori.index')->with('success', 'Data has been deleted at '.$kategori->updated_at);
        }
    }
}
