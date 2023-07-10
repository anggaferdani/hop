<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BannerController extends Controller
{
    public function index(){
        $banners = Banner::where('status_aktif', 'Aktif')->latest()->paginate(10);
        return view('banner.index', compact(
            'banners',
        ));
    }

    public function create(){
        return view('banner.create');
    }

    public function store(Request $request){
        $request->validate([
            'thumbnail' => 'required',
            'link' => 'required',
        ]);

        $array = array(
            'link' => $request['link'],
        );

        if($thumbnail = $request->file('thumbnail')){
            $destination_path = 'banner/thumbnail/';
            $thumbnail2 = date('YmdHis').rand(999999999, 9999999999).$thumbnail->extension();
            $thumbnail->move($destination_path, $thumbnail2);
            $array['thumbnail'] = $thumbnail2;
        }

        $banner = Banner::create($array);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.banner.index')->with('success', 'Data has been created at '.$banner->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.banner.index')->with('success', 'Data has been created at '.$banner->created_at);
        }
    }

    public function show($id){
        $banner = Banner::find(Crypt::decrypt($id));
        return view('banner.show', compact(
            'banner',
        ));
    }

    public function edit($id){
        $banner = Banner::find(Crypt::decrypt($id));
        return view('banner.edit', compact(
            'banner',
        ));
    }

    public function update(Request $request, $id){
        $banner = Banner::find(Crypt::decrypt($id));

        $request->validate([
            'link' => 'required',
        ]);

        if($thumbnail = $request->file('thumbnail')){
            $destination_path = 'banner/thumbnail/';
            $thumbnail2 = date('YmdHis') . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($destination_path, $thumbnail2);
            $banner['thumbnail'] = $thumbnail2;
        }

        $banner->update([
            'link' => $request['link'],
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.banner.index')->with('success', 'Data has been updated at '.$banner->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.banner.index')->with('success', 'Data has been updated at '.$banner->updated_at);
        }
    }

    public function destroy($id){
        $banner = Banner::find(Crypt::decrypt($id));
        
        $banner->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.banner.index')->with('success', 'Data has been deleted at '.$banner->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.banner.index')->with('success', 'Data has been deleted at '.$banner->updated_at);
        }
    }
    
    public function kosongkan($id){
        $banner = Banner::find(Crypt::decrypt($id));
        
        $banner->update([
            'status_aktif2' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.banner.index')->with('success', 'Data has been deleted at '.$banner->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.banner.index')->with('success', 'Data has been deleted at '.$banner->updated_at);
        }
    }
}
