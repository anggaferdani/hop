<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class VendorController extends Controller
{
    public function index(){
        $vendors = User::where('level', 'Vendor')->where('status_aktif', 'Aktif')->latest()->paginate(10);
        return view('vendor.index', compact(
            'vendors',
        ));
    }

    public function create(){
        return view('vendor.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama_panjang' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $array = array(
            'nama_panjang' => $request['nama_panjang'],
            'email' => $request['email'],
            'password' => $request['password'],
            'level' => 'Vendor',
        );

        $vendor = User::create($array);

        $array2 = array(
            'user_id' => $vendor->id,
            'status_verifikasi' => 'Terverifikasi',
        );

        Verifikasi::create($array2);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.vendor.index')->with('success', 'Data has been created at '.$vendor->created_at);
        }if(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.vendor.index')->with('success', 'Data has been created at '.$vendor->created_at);
        }
    }

    public function show($id){
        $vendor = User::find(Crypt::decrypt($id));
        return view('vendor.show', compact(
            'vendor',
        ));
    }

    public function edit($id){
        $vendor = User::find(Crypt::decrypt($id));
        return view('vendor.edit', compact(
            'vendor',
        ));
    }

    public function update(Request $request, $id){
        $vendor = User::find(Crypt::decrypt($id));

        $request->validate([
            'nama_panjang' => 'required',
            'email' => 'required|email|unique:users,email,'.$vendor->id.",id",
        ]);

        $vendor->update([
            'nama_panjang' => $request['nama_panjang'],
            'email' => $request['email'],
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.vendor.index')->with('success', 'Data has been updated at '.$vendor->updated_at);
        }if(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.vendor.index')->with('success', 'Data has been updated at '.$vendor->updated_at);
        }
    }

    public function destroy($id){
        $vendor = User::find(Crypt::decrypt($id));
        
        $vendor->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.vendor.index')->with('success', 'Data has been deleted at '.$vendor->updated_at);
        }if(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.vendor.index')->with('success', 'Data has been deleted at '.$vendor->updated_at);
        }
    }
}
