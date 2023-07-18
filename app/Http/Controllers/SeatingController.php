<?php

namespace App\Http\Controllers;

use App\Models\Seating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SeatingController extends Controller
{
    public function index(){
        $seatings = Seating::where('status_aktif', 'Aktif')->latest()->paginate(10);
        return view('seating.index', compact(
            'seatings',
        ));
    }

    public function create(){
        return view('seating.create');
    }

    public function store(Request $request){
        $request->validate([
            'seating' => 'required',
        ]);

        $array = array(
            'seating' => $request['seating'],
        );

        $seating = Seating::create($array);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.seating.index')->with('success', 'Data has been created at '.$seating->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.seating.index')->with('success', 'Data has been created at '.$seating->created_at);
        }
    }

    public function show($id){
        $seating = Seating::find(Crypt::decrypt($id));
        return view('seating.show', compact(
            'seating',
        ));
    }

    public function edit($id){
        $seating = Seating::find(Crypt::decrypt($id));
        return view('seating.edit', compact(
            'seating',
        ));
    }

    public function update(Request $request, $id){
        $seating = Seating::find(Crypt::decrypt($id));

        $request->validate([
            'seating' => 'required',
        ]);

        $seating->update([
            'seating' => $request['seating'],
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.seating.index')->with('success', 'Data has been updated at '.$seating->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.seating.index')->with('success', 'Data has been updated at '.$seating->updated_at);
        }
    }

    public function destroy($id){
        $seating = Seating::find(Crypt::decrypt($id));
        
        $seating->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.seating.index')->with('success', 'Data has been deleted at '.$seating->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.seating.index')->with('success', 'Data has been deleted at '.$seating->updated_at);
        }
    }
}
