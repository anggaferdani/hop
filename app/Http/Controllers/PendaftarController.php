<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class PendaftarController extends Controller
{
    public function postRegister(Request $request){
        $request->validate([
            'nama_panjang' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'no_telepon' => 'required',
            'email' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
        ]);
    
        $token = hash('sha256', $this->generateNumber());
    
        $array = array(
            'token' => $token,
            'nama_panjang' => $request['nama_panjang'],
            'tanggal_lahir' => $request['tanggal_lahir'],
            'jenis_kelamin' => $request['jenis_kelamin'],
            'no_telepon' => $request['no_telepon'],
            'email' => $request['email'],
            'provinsi' => $request['provinsi'],
            'kabupaten_kota' => $request['kabupaten_kota'],
            'kecamatan' => $request['kecamatan'],
            'pekerjaan' => $request['pekerjaan'],
        );
    
        $pendaftar = Pendaftar::create($array);
    
        $agenda = Agenda::find($request->agenda_id);

        $nama_panjang = 'Nama panjang : '.$pendaftar->nama_panjang;
        $judul = 'Judul : '.$agenda->judul;
        $deskripsi = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta enim fugiat mollitia sit cupiditate, ea quisquam impedit qui ipsa est, tenetur eligendi ipsam labore reiciendis ullam non dolorem? Nesciunt, doloremque.';
        $lokasi = 'Lokasi : '.$agenda->provinsi.', '.$agenda->kabupaten_kota.', '.$agenda->kecamatan;
        $tanggal_mulai_dan_berakhir = 'Tanggal mulai dan berakhir : '.$agenda->tanggal_mulai.' sampai '.$agenda->tanggal_berakhir;

        $mail = [
            'kepada' => $pendaftar->email,
            'email' => 'hangoutproject@gmail.com',
            'dari' => 'Hangout Project',
            'subject' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'nama_panjang' => $nama_panjang,
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'lokasi' => $lokasi,
            'tanggal_mulai_dan_berakhir' => $tanggal_mulai_dan_berakhir,
            'token' => $pendaftar->token,
        ];

        Mail::send('email.email', $mail, function($message) use ($mail){
            $message->to($mail['kepada'])
            ->from($mail['email'], $mail['dari'])
            ->subject($mail['subject']);
        });

        return redirect()->route('agenda', Crypt::encrypt($request->agenda_id))->with('success', 'Data has been created at '.$pendaftar->created_at);
    }

    public function generateNumber(){
        do{
            $token = mt_rand(999999999, 9999999999);
        }while(Pendaftar::where("token", "=", $token)->first());

        return $token;
    }
}