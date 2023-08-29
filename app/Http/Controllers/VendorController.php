<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Feature;
use App\Models\Seating;
use App\Models\Kategori;
use App\Models\Fasilitas;
use App\Models\Verifikasi;
use App\Models\Entertaiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class VendorController extends Controller
{
    public function index(){
        $vendors = User::where('level', 'Vendor')->latest()->paginate(10);
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
        ]);

        if($request['logo'] == null){
            $array = array(
                'nama_panjang' => $request['nama_panjang'],
                'email' => $request['email'],
                'password' => bcrypt(12345678),
                'logo' => 'DEFAULT.jpeg',
                'level' => 'Vendor',
            );
        }else{
            $array = array(
                'nama_panjang' => $request['nama_panjang'],
                'email' => $request['email'],
                'password' => bcrypt(12345678),
                'level' => 'Vendor',
            );
    
            if($request->file('logo')){
                foreach($request->file('logo') as $logo){
                    $logo2 = date('YmdHis').rand(999999999, 9999999999).$logo->getClientOriginalName();
                    $logo->move(public_path('user/logo/'), $logo2);
                    $array['logo'] = $logo2;
                }
            }
        }

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

        if($request->file('logo')){
            foreach($request->file('logo') as $logo){
                $logo2 = date('YmdHis').rand(999999999, 9999999999).$logo->getClientOriginalName();
                $logo->move(public_path('user/logo/'), $logo2);
                $vendor['logo'] = $logo2;
            }
        }

        $vendor->update([
            'nama_panjang' => $request['nama_panjang'],
            'email' => $request['email'],
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.vendor.index')->with('success', 'Data has been updated at '.$vendor->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
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

    public function pulihkan($id){
        $vendor = User::find(Crypt::decrypt($id));
        
        $vendor->update([
            'status_aktif' => 'Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.vendor.index')->with('success', 'Data has been deleted at '.$vendor->updated_at);
        }if(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.vendor.index')->with('success', 'Data has been deleted at '.$vendor->updated_at);
        }
    }

    public function foodAndBeverage(){
        $seatings = Seating::select('id', 'seating')->where('status_aktif', 'Aktif')->get();
        $features = Feature::select('id', 'feature')->where('status_aktif', 'Aktif')->get();
        $entertaiments = Entertaiment::select('id', 'entertaiment')->where('status_aktif', 'Aktif')->get();
        $provinsis = DB::table('m_provinsi')->get();
        return view('food-and-beverage.create', compact(
            'seatings',
            'provinsis',
            'features',
            'entertaiments',
        ));
    }

    public function lodging(){
        $fasilitasies = Fasilitas::select('id', 'fasilitas')->where('status_aktif', 'Aktif')->get();
        $provinsis = DB::table('m_provinsi')->get();
        return view('lodging.create', compact(
            'fasilitasies',
            'provinsis',
        ));
    }

    public function publicArea(){
        $provinsis = DB::table('m_provinsi')->get();
        return view('public-area.create', compact(
            'provinsis',
        ));
    }

    public function activityManajemen(){
        $users = User::where('level', 'Vendor')->where('status_aktif', 'Aktif')->get();
        $kategoris = Kategori::select('id', 'kategori')->where('status_aktif', 'Aktif')->get();
        $provinsis = DB::table('m_provinsi')->get();
        return view('activity-manajemen.create', compact(
            'users',
            'kategoris',
            'provinsis',
        ));
    }
}
