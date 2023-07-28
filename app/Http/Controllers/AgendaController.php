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
use App\Models\AgendaImage;
use Illuminate\Http\Request;
use App\Models\FoodAndBeverage;
use App\Models\ActivityManajemen;
use App\Models\HangoutPlace;
use App\Models\PublicArea;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class AgendaController extends Controller
{
    public function index(){
        $agendas = Agenda::with('agenda_images', 'hangout_places')->where('status_aktif', 'Aktif')->latest()->paginate(10);
        return view('agenda.index', compact(
            'agendas',
        ));
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
            'tiket' => 'required',
            'image.*' => 'required',
            'type.*' => 'required',
        ]);

        $hangout_place = HangoutPlace::find($request->hangout_place_id);

        $array = array(
            'hangout_place_id' => $request['hangout_place_id'],
            'judul' => $request['judul'],
            'deskripsi' => $request['deskripsi'],
            'jenis' => $request['jenis'],
            'provinsi' => $hangout_place->provinsi,
            'kabupaten_kota' => $hangout_place->kabupaten_kota,
            'kecamatan' => $hangout_place->kecamatan,
            'tiket' => $request['tiket'],
            'tanggal_mulai' => $request['tanggal_mulai'],
            'tanggal_berakhir' => $request['tanggal_berakhir'],
        );

        try{
            DB::beginTransaction();

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

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.agenda.index')->with('success', 'Data has been created at '.$agenda->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.agenda.index')->with('success', 'Data has been created at '.$agenda->created_at);
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
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_berakhir' => 'required',
            'tiket' => 'required',
        ]);

        try{
            DB::beginTransaction();

            $agenda->update([
                'hangout_place_id' => $request['hangout_place_id'],
                'judul' => $request['judul'],
                'deskripsi' => $request['deskripsi'],
                'jenis' => $request['jenis'],
                'provinsi' => $request['provinsi'],
                'kabupaten_kota' => $request['kabupaten_kota'],
                'kecamatan' => $request['kecamatan'],
                'tiket' => $request['tiket'],
                'tanggal_mulai' => $request['tanggal_mulai'],
                'tanggal_berakhir' => $request['tanggal_berakhir'],
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
}
