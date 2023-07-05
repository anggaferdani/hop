<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TypeController extends Controller
{
    public function index(){
        $types = Type::where('status_aktif', 'Aktif')->latest()->paginate(10);
        return view('type.index', compact(
            'types',
        ));
    }

    public function create(){
        return view('type.create');
    }

    public function store(Request $request){
        $request->validate([
            'type' => 'required',
        ]);

        $array = array(
            'type' => $request['type'],
        );

        $type = Type::create($array);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.type.index')->with('success', 'Data has been created at '.$type->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.type.index')->with('success', 'Data has been created at '.$type->created_at);
        }
    }

    public function show($id){
        $type = Type::find(Crypt::decrypt($id));
        return view('type.show', compact(
            'type',
        ));
    }

    public function edit($id){
        $type = Type::find(Crypt::decrypt($id));
        return view('type.edit', compact(
            'type',
        ));
    }

    public function update(Request $request, $id){
        $type = Type::find(Crypt::decrypt($id));

        $request->validate([
            'type' => 'required',
        ]);

        $type->update([
            'type' => $request['type'],
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.type.index')->with('success', 'Data has been updated at '.$type->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.type.index')->with('success', 'Data has been updated at '.$type->updated_at);
        }
    }

    public function destroy($id){
        $type = Type::find(Crypt::decrypt($id));
        
        $type->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.type.index')->with('success', 'Data has been deleted at '.$type->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.type.index')->with('success', 'Data has been deleted at '.$type->updated_at);
        }
    }
}
