<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class FeatureController extends Controller
{
    public function index(){
        $features = Feature::where('status_aktif', 'Aktif')->latest()->paginate(10);
        return view('feature.index', compact(
            'features',
        ));
    }

    public function create(){
        return view('feature.create');
    }

    public function store(Request $request){
        $request->validate([
            'feature' => 'required',
        ]);

        $array = array(
            'feature' => $request['feature'],
        );

        $feature = Feature::create($array);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.feature.index')->with('success', 'Data has been created at '.$feature->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.feature.index')->with('success', 'Data has been created at '.$feature->created_at);
        }
    }

    public function show($id){
        $feature = Feature::find(Crypt::decrypt($id));
        return view('feature.show', compact(
            'feature',
        ));
    }

    public function edit($id){
        $feature = Feature::find(Crypt::decrypt($id));
        return view('feature.edit', compact(
            'feature',
        ));
    }

    public function update(Request $request, $id){
        $feature = Feature::find(Crypt::decrypt($id));

        $request->validate([
            'feature' => 'required',
        ]);

        $feature->update([
            'feature' => $request['feature'],
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.feature.index')->with('success', 'Data has been updated at '.$feature->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.feature.index')->with('success', 'Data has been updated at '.$feature->updated_at);
        }
    }

    public function destroy($id){
        $feature = Feature::find(Crypt::decrypt($id));
        
        $feature->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.feature.index')->with('success', 'Data has been deleted at '.$feature->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.feature.index')->with('success', 'Data has been deleted at '.$feature->updated_at);
        }
    }
}
