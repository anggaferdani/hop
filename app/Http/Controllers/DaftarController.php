<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\JenisTiket;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class DaftarController extends Controller
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
            'jenis_tiket_id' => $request['jenis_tiket_id'],
            'provinsi' => $request['provinsi'],
            'kabupaten_kota' => $request['kabupaten_kota'],
            'kecamatan' => $request['kecamatan'],
            'pekerjaan' => $request['pekerjaan'],
        );
        
        if($bukti_transfer = $request->file('bukti_transfer')){
            $destination_path = 'pendaftar/bukti-transfer/';
            $bukti_transfer2 = date('YmdHis').rand(999999999, 9999999999).$bukti_transfer->getClientOriginalName();
            $bukti_transfer->move($destination_path, $bukti_transfer2);
            $array['bukti_transfer'] = $bukti_transfer2;
        }
    
        $pendaftar = Pendaftar::create($array);
    
        $agenda = Agenda::find($request->agenda_id);

        $nama_panjang = $pendaftar->nama_panjang;
        $judul = $agenda->judul;

        $mail = [
            'kepada' => $pendaftar->email,
            'email' => 'info@mixnetwork.id',
            'dari' => 'Hangout Project',
            'subject' => 'Terima kasih anda telah melakukan pemesanan tiket' .$judul,
            'nama_panjang' => $nama_panjang,
            'judul' => $judul,
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
