<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Update;
use App\Models\UpdateImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class UpdateController extends Controller
{
    public function index(){
        $updates = Update::with('update_images')->where('status_aktif', 'Aktif')->latest()->paginate(10);
        return view('update.index', compact(
            'updates',
        ));
    }

    public function create(){
        $tags = Tag::select('id', 'tag')->where('status_aktif', 'Aktif')->get();
        return view('update.create', compact(
            'tags',
        ));
    }

    public function store(Request $request){
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal_publikasi' => 'required',
            'image.*' => 'required',
            'tag.*' => 'required',
        ]);

        $array = array(
            'judul' => $request['judul'],
            'deskripsi' => $request['deskripsi'],
            'tanggal_publikasi' => $request['tanggal_publikasi'],
            'user_id' => Auth::id(),
        );

        $update = Update::create($array);

        if($request->has('image')){
            foreach($request->file('image') as $image){
                $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                $image->move(public_path('update/image/'), $image2);
                UpdateImage::create([
                    'update_id' => $update->id,
                    'image' => $image2,
                ]);
            }
        }

        $update->tags()->attach($request->tag);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.update.index')->with('success', 'Data has been created at '.$update->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.update.index')->with('success', 'Data has been created at '.$update->created_at);
        }
    }

    public function show($id){
        $update = Update::with('users', 'update_images')->find(Crypt::decrypt($id));
        $tag_id = $update->tags->pluck('id');
        $tags = Tag::select('id', 'tag')->where('status_aktif', 'Aktif')->get();
        return view('update.show', compact(
            'update',
            'tag_id',
            'tags',
        ));
    }

    public function edit($id){
        $update = Update::with('users', 'update_images')->find(Crypt::decrypt($id));
        $tag_id = $update->tags->pluck('id');
        $tags = Tag::select('id', 'tag')->where('status_aktif', 'Aktif')->get();
        return view('update.edit', compact(
            'update',
            'tag_id',
            'tags',
        ));
    }

    public function update(Request $request, $id){
        $update = Update::with('update_images', 'tags')->find(Crypt::decrypt($id));

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal_publikasi' => 'required',
        ]);

        $update->update([
            'judul' => $request['judul'],
            'deskripsi' => $request['deskripsi'],
            'tanggal_publikasi' => $request['tanggal_publikasi'],
        ]);

        if($request->has('image')){
            foreach($request->file('image') as $image){
                $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                $image->move(public_path('update/image/'), $image2);
                UpdateImage::create([
                    'update_id' => $update->id,
                    'image' => $image2,
                ]);
            }
        }

        $update->tags()->sync($request->tag);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.update.index')->with('success', 'Data has been updated at '.$update->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.update.index')->with('success', 'Data has been updated at '.$update->updated_at);
        }
    }

    public function destroy($id){
        $update = Update::find(Crypt::decrypt($id));
        
        $update->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.update.index')->with('success', 'Data has been deleted at '.$update->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.update.index')->with('success', 'Data has been deleted at '.$update->updated_at);
        }
    }

    public function deleteImage($id, $update_id){
        $image = UpdateImage::find(Crypt::decrypt($id));
        
        if(file_exists(public_path("update/image/".$image->image))){
            File::delete("update/image/".$image->image);
        }
        
        Update::find(Crypt::decrypt($update_id))->delete();

        return back()->with('success', 'Data has been deleted at '.Carbon::now()->toDateTimeString());
    }
}
