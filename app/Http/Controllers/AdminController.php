<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    public function index(){
        $admins = User::where('level', 'Admin')->where('status_aktif', 'Aktif')->latest()->paginate(10);
        return view('admin.index', compact(
            'admins',
        ));
    }

    public function create(){
        return view('admin.create');
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
            'level' => 'Admin',
        );

        $admin = User::create($array);

        return redirect()->route('superadmin.admin.index')->with('success', 'Data has been created at '.$admin->created_at);
    }

    public function show($id){
        $admin = User::find(Crypt::decrypt($id));
        return view('admin.show', compact(
            'admin',
        ));
    }

    public function edit($id){
        $admin = User::find(Crypt::decrypt($id));
        return view('admin.edit', compact(
            'admin',
        ));
    }

    public function update(Request $request, $id){
        $admin = User::find(Crypt::decrypt($id));

        $request->validate([
            'nama_panjang' => 'required',
            'email' => 'required|email|unique:users,email,'.$admin->id.",id",
        ]);

        $admin->update([
            'nama_panjang' => $request['nama_panjang'],
            'email' => $request['email'],
        ]);

        return redirect()->route('superadmin.admin.index')->with('success', 'Data has been updated at '.$admin->updated_at);
    }

    public function destroy($id){
        $admin = User::find(Crypt::decrypt($id));
        
        $admin->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        return redirect()->route('superadmin.admin.index')->with('success', 'Data has been deleted at '.$admin->updated_at);
    }
}
