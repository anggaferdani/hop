<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\Type;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Lodging;
use App\Models\Pendaftar;
use App\Models\JenisTiket;
use App\Models\PublicArea;
use App\Models\AgendaImage;
use App\Models\HangoutPlace;
use Illuminate\Http\Request;
use App\Models\FoodAndBeverage;
use App\Models\ActivityManajemen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class AgendaController extends Controller
{
    public function index(){
        if(auth()->user()->level == 'Admin'){
            if(!empty(auth()->user()->level_admin == 'Activity Manajemen' || auth()->user()->level_admin == 'Food And Beverage' || auth()->user()->level_admin == 'Lodging' || auth()->user()->level_admin == 'Public Area')){
                $agendas = Agenda::with('agenda_images', 'hangout_places', 'pendaftars')->orderBy('status_approved', 'DESC')->orderBy('created_at', 'DESC')->where('created_by', Auth::id())->where('status_aktif', 'Aktif')->latest()->paginate(10);
            }else{
                $agendas = Agenda::with('agenda_images', 'hangout_places', 'pendaftars')->orderBy('status_approved', 'DESC')->orderBy('created_at', 'DESC')->where('status_aktif', 'Aktif')->latest()->paginate(10);
            }
            return view('agenda.index', compact(
                'agendas',
            ));
        }elseif(auth()->user()->level == 'Superadmin'){
            $agendas = Agenda::with('agenda_images', 'hangout_places', 'pendaftars')->orderBy('status_approved', 'DESC')->orderBy('created_at', 'DESC')->where('status_aktif', 'Aktif')->latest()->paginate(10);
            return view('agenda.index', compact(
                'agendas',
            ));
        }
    }

    public function create(){
        $hangout_places = HangoutPlace::where('status_aktif', 'Aktif')->get();
        $types = Type::select('id', 'type')->where('status_aktif', 'Aktif')->get();
        return view('agenda.create', compact(
            'types',
            'hangout_places',
        ));
    }

    public function store(Request $request){
        $request->validate([
            'hangout_place_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'jenis' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_berakhir' => 'required',
            'image' => 'required',
            'type' => 'required',
            'tiket' => 'required',
            'redirect_link_pendaftaran' => 'required_if:tiket,Aktif',
            'link_pendaftaran' => 'required_if:redirect_link_pendaftaran,Aktif',
            'qris' => 'required_if:redirect_link_pendaftaran, Tidak Aktif',
            'jenis_tiket' => 'required_if:redirect_link_pendaftaran, Tidak Aktif',
            'harga' => 'required_if:redirect_link_pendaftaran, Tidak Aktif',
        ]);

        $array = array(
            'hangout_place_id' => $request['hangout_place_id'],
            'judul' => $request['judul'],
            'deskripsi' => $request['deskripsi'],
            'jenis' => $request['jenis'],
            'tiket' => $request['tiket'],
            'tanggal_mulai' => $request['tanggal_mulai'],
            'tanggal_berakhir' => $request['tanggal_berakhir'],
            'redirect_link_pendaftaran' => $request['redirect_link_pendaftaran'],
            'link_pendaftaran' => $request['link_pendaftaran'],
        );

        try{
            DB::beginTransaction();

            if(Auth::check()){
                $array['status_approved'] = 'Approved';
                if($request['qris'] == null){
                    $array['qris'] = 'DEFAULT.jpeg';
                }else{
                    if($request->has('qris')){
                        foreach($request->file('qris') as $qris){
                            $qris2 = date('YmdHis').rand(999999999, 9999999999).$qris->getClientOriginalName();
                            $qris->move(public_path('agenda/qris/'), $qris2);
                            $array['qris'] = $qris2;
                        }
                    }
                }
            }else{
                if($request->has('qris')){
                    foreach($request->file('qris') as $qris){
                        $qris2 = date('YmdHis').rand(999999999, 9999999999).$qris->getClientOriginalName();
                        $qris->move(public_path('agenda/qris/'), $qris2);
                        $array['qris'] = $qris2;
                    }
                }
            }

            $agenda = Agenda::create($array);

            if($request->jenis_tiket){
                foreach($request['jenis_tiket'] as $a => $b){
                    $harga = preg_replace('/\D/', '', $request['harga']);
                    $harga2 = array_map('trim', $harga);

                    $array2 = array(
                        'agenda_id' => $agenda->id,
                        'tiket' => $request['jenis_tiket'][$a],
                        'harga' => $harga2[$a],
                    );

                    JenisTiket::create($array2);
                }
            }

            if($request->has('image')){
                foreach($request->file('image') as $image){
                    $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                    $image->move(public_path('agenda/image/'), $image2);
                    AgendaImage::create([
                        'agenda_id' => $agenda->id,
                        'image' => $image2,
                    ]);
                }
            }
            
            $agenda->types()->attach($request->type);

            DB::commit();
        }catch(Throwable $th){
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }

        if(Auth::check()){
            if(auth()->user()->level == 'Superadmin'){
                return redirect()->route('superadmin.agenda.index')->with('success', 'Data has been created at '.$agenda->created_at);
            }elseif(auth()->user()->level == 'Admin'){
                return redirect()->route('admin.agenda.index')->with('success', 'Data has been created at '.$agenda->created_at);
            }
        }else{
            return back()->with('success', 'Data has been created at '.$agenda->created_at);
        }
    }

    public function show($id){
        $agenda = Agenda::with('agenda_images', 'jenis_tikets')->find(Crypt::decrypt($id));
        $type_id = $agenda->types->pluck('id');
        $types = Type::select('id', 'type')->where('status_aktif', 'Aktif')->get();
        $hangout_places = HangoutPlace::where('status_aktif', 'Aktif')->get();
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('agenda.show', compact(
            'agenda',
            'type_id',
            'types',
            'hangout_places',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function edit($id){
        $agenda = Agenda::with('agenda_images', 'jenis_tikets')->find(Crypt::decrypt($id));
        $type_id = $agenda->types->pluck('id');
        $types = Type::select('id', 'type')->where('status_aktif', 'Aktif')->get();
        $hangout_places = HangoutPlace::where('status_aktif', 'Aktif')->get();
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('agenda.edit', compact(
            'agenda',
            'type_id',
            'types',
            'hangout_places',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function update(Request $request, $id){
        $agenda = Agenda::with('agenda_images', 'types', 'jenis_tikets')->find(Crypt::decrypt($id));
        JenisTiket::where('agenda_id', Crypt::decrypt($id))->delete();

        $request->validate([
            'hangout_place_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'jenis' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_berakhir' => 'required',
            'tiket' => 'required',
            'redirect_link_pendaftaran' => 'required',
        ]);

        try{
            DB::beginTransaction();

            if($request->has('qris')){
                foreach($request->file('qris') as $qris){
                    $qris2 = date('YmdHis').rand(999999999, 9999999999).$qris->getClientOriginalName();
                    $qris->move(public_path('agenda/qris/'), $qris2);
                    $agenda['qris'] = $qris2;
                }
            }

            $agenda->update([
                'hangout_place_id' => $request['hangout_place_id'],
                'judul' => $request['judul'],
                'deskripsi' => $request['deskripsi'],
                'jenis' => $request['jenis'],
                'tiket' => $request['tiket'],
                'tanggal_mulai' => $request['tanggal_mulai'],
                'tanggal_berakhir' => $request['tanggal_berakhir'],
                'redirect_link_pendaftaran' => $request['redirect_link_pendaftaran'],
                'link_pendaftaran' => $request['link_pendaftaran'],
            ]);

            if($request->jenis_tiket){
                foreach($request['jenis_tiket'] as $a => $b){
                    $harga = preg_replace('/\D/', '', $request['harga']);
                    $harga2 = array_map('trim', $harga);
    
                    $array2 = array(
                        'agenda_id' => $agenda->id,
                        'tiket' => $request['jenis_tiket'][$a],
                        'harga' => $harga2[$a],
                    );
    
                    JenisTiket::create($array2);
                }
            }
    
            if($request->has('image')){
                foreach($request->file('image') as $image){
                    $image2 = date('YmdHis').rand(999999999, 9999999999).$image->getClientOriginalName();
                    $image->move(public_path('agenda/image/'), $image2);
                    AgendaImage::create([
                        'agenda_id' => $agenda->id,
                        'image' => $image2,
                    ]);
                }
            }
    
            $agenda->types()->sync($request->type);

            DB::commit();
        }catch(Throwable $th){
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.agenda.index')->with('success', 'Data has been updated at '.$agenda->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.agenda.index')->with('success', 'Data has been updated at '.$agenda->updated_at);
        }
    }

    public function destroy($id){
        $agenda = Agenda::find(Crypt::decrypt($id));
        
        $agenda->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.agenda.index')->with('success', 'Data has been deleted at '.$agenda->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.agenda.index')->with('success', 'Data has been deleted at '.$agenda->updated_at);
        }
    }

    public function deleteImage($id){
        $image = AgendaImage::find(Crypt::decrypt($id));
        
        if(file_exists(public_path("agenda/image/".$image->image))){
            File::delete("agenda/image/".$image->image);
        }

        $image->delete();
        
        return back()->with('success', 'Data has been deleted at '.Carbon::now()->toDateTimeString());
    }

    public function pendaftar($agenda_id){
        $agenda = Agenda::find(Crypt::decrypt($agenda_id));
        $pendaftars = Pendaftar::latest()->paginate(10);
        return view('agenda.pendaftar', compact(
            'agenda',
            'pendaftars',
        ));
    }

    public function approved($id){
        $agenda = Agenda::find(Crypt::decrypt($id));
        
        $agenda->update([
            'status_approved' => 'Approved',
        ]);

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.agenda.index')->with('success', 'Data has been approved at '.$agenda->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.agenda.index')->with('success', 'Data has been approved at '.$agenda->updated_at);
        }
    }

    public function deletePermanently($id){
        $agenda = Agenda::find(Crypt::decrypt($id));
        
        $agenda->delete();

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.agenda.index')->with('success', 'Data has been deleted permanently at '.$agenda->updated_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.agenda.index')->with('success', 'Data has been deleted permanently at '.$agenda->updated_at);
        }
    }
}
