<?php

namespace App\Http\Controllers;

use App\Models\Entertaiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EntertaimentController extends Controller
{
    public function index(){
        $entertaiments = Entertaiment::where('status_aktif', 'Aktif')->latest()->paginate(10);
        return view('entertaiment.index', compact(
            'entertaiments',
        ));
    }

    public function create(){
        return view('entertaiment.create');
    }

    public function store(Request $request){
        $request->validate([
            'entertaiment' => 'required',
        ]);

        $array = array(
            'entertaiment' => $request['entertaiment'],
        );

        $entertaiment = Entertaiment::create($array);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.entertaiment.index')->with('success', 'Data has been created at '.$entertaiment->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.entertaiment.index')->with('success', 'Data has been created at '.$entertaiment->created_at);
        }
    }

    public function show($id){
        $entertaiment = Entertaiment::find(Crypt::decrypt($id));
        return view('entertaiment.show', compact(
            'entertaiment',
        ));
    }

    public function edit($id){
        $entertaiment = Entertaiment::find(Crypt::decrypt($id));
        return view('entertaiment.edit', compact(
            'entertaiment',
        ));
    }

    public function update(Request $request, $id){
        $entertaiment = Entertaiment::find(Crypt::decrypt($id));

        $request->validate([
            'entertaiment' => 'required',
        ]);

        $entertaiment->update([
            'entertaiment' => $request['entertaiment'],
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.entertaiment.index')->with('success', 'Data has been updated at '.$entertaiment->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.entertaiment.index')->with('success', 'Data has been updated at '.$entertaiment->updated_at);
        }
    }

    public function destroy($id){
        $entertaiment = Entertaiment::find(Crypt::decrypt($id));
        
        $entertaiment->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.entertaiment.index')->with('success', 'Data has been deleted at '.$entertaiment->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.entertaiment.index')->with('success', 'Data has been deleted at '.$entertaiment->updated_at);
        }
    }
}
