<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Type;
use App\Models\Agenda;
use App\Models\AgendaImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class AgendaController extends Controller
{
    public function index(){
        $agendas = Agenda::with('agenda_images')->where('status_aktif', 'Aktif')->latest()->paginate(10);
        return view('agenda.index', compact(
            'agendas',
        ));
    }

    public function create(){
        $types = Type::select('id', 'type')->where('status_aktif', 'Aktif')->get();
        return view('agenda.create', compact(
            'types',
        ));
    }

    public function store(Request $request){
        $request->validate([
            'penyelenggara' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'jenis' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'tanggal_berakhir' => 'required',
            'image.*' => 'required',
            'type.*' => 'required',
        ]);

        $array = array(
            'penyelenggara' => $request['penyelenggara'],
            'judul' => $request['judul'],
            'deskripsi' => $request['deskripsi'],
            'jenis' => $request['jenis'],
            'provinsi' => $request['provinsi'],
            'kabupaten_kota' => $request['kabupaten_kota'],
            'kecamatan' => $request['kecamatan'],
            'tanggal_mulai' => $request['tanggal_mulai'],
            'tanggal_berakhir' => $request['tanggal_berakhir'],
        );

        $agenda = Agenda::create($array);

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

        if(auth()->user()->level == 'Superadmin'){
            return redirect()->route('superadmin.agenda.index')->with('success', 'Data has been created at '.$agenda->created_at);
        }elseif(auth()->user()->level == 'Admin'){
            return redirect()->route('admin.agenda.index')->with('success', 'Data has been created at '.$agenda->created_at);
        }
    }

    public function show($id){
        $agenda = Agenda::with('agenda_images')->find(Crypt::decrypt($id));
        $type_id = $agenda->types->pluck('id');
        $types = Type::select('id', 'type')->where('status_aktif', 'Aktif')->get();
        return view('agenda.show', compact(
            'agenda',
            'type_id',
            'types',
        ));
    }

    public function edit($id){
        $agenda = Agenda::with('agenda_images')->find(Crypt::decrypt($id));
        $type_id = $agenda->types->pluck('id');
        $types = Type::select('id', 'type')->where('status_aktif', 'Aktif')->get();
        return view('agenda.edit', compact(
            'agenda',
            'type_id',
            'types',
        ));
    }

    public function update(Request $request, $id){
        $agenda = Agenda::with('agenda_images', 'types')->find(Crypt::decrypt($id));

        $request->validate([
            'penyelenggara' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'jenis' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_berakhir' => 'required',
        ]);

        $agenda->update([
            'penyelenggara' => $request['penyelenggara'],
            'judul' => $request['judul'],
            'deskripsi' => $request['deskripsi'],
            'jenis' => $request['jenis'],
            'provinsi' => $request['provinsi'],
            'kabupaten_kota' => $request['kabupaten_kota'],
            'kecamatan' => $request['kecamatan'],
            'tanggal_mulai' => $request['tanggal_mulai'],
            'tanggal_berakhir' => $request['tanggal_berakhir'],
        ]);

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
}
