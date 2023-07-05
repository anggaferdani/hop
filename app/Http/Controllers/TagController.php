<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::where('status_aktif', 'Aktif')->latest()->paginate(10);
        return view('tag.index', compact(
            'tags',
        ));
    }

    public function create(){
        return view('tag.create');
    }

    public function store(Request $request){
        $request->validate([
            'tag' => 'required',
        ]);

        $array = array(
            'tag' => $request['tag'],
        );

        $tag = Tag::create($array);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.tag.index')->with('success', 'Data has been created at '.$tag->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.tag.index')->with('success', 'Data has been created at '.$tag->created_at);
        }
    }

    public function show($id){
        $tag = Tag::find(Crypt::decrypt($id));
        return view('tag.show', compact(
            'tag',
        ));
    }

    public function edit($id){
        $tag = Tag::find(Crypt::decrypt($id));
        return view('tag.edit', compact(
            'tag',
        ));
    }

    public function update(Request $request, $id){
        $tag = Tag::find(Crypt::decrypt($id));

        $request->validate([
            'tag' => 'required',
        ]);

        $tag->update([
            'tag' => $request['tag'],
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.tag.index')->with('success', 'Data has been updated at '.$tag->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.tag.index')->with('success', 'Data has been updated at '.$tag->updated_at);
        }
    }

    public function destroy($id){
        $tag = Tag::find(Crypt::decrypt($id));
        
        $tag->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.tag.index')->with('success', 'Data has been deleted at '.$tag->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.tag.index')->with('success', 'Data has been deleted at '.$tag->updated_at);
        }
    }
}
