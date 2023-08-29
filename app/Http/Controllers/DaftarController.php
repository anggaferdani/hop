<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Milon\Barcode\DNS2D;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            'agenda_id' => $request->agenda_id,
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
    
        $pendaftar2 = Pendaftar::create($array);
        $pendaftar = Pendaftar::with('jenis_tikets')->find($pendaftar2->id);
    
        $agenda = Agenda::find($request->agenda_id);

        $judul = $agenda->judul;
        $tanggal_mulai = $agenda->tanggal_mulai;
        $tanggal_berakhir = $agenda->tanggal_berakhir;
        $jenis_tiket = $agenda->tiket;
        $nama_panjang = $pendaftar->nama_panjang;
        $email = $pendaftar->email;
        $tanggal_pemesanan = $pendaftar->created_at;
        if(!empty($pendaftar->jenis_tiket_id)){
            $tiket = $pendaftar->jenis_tikets->tiket;
            $harga = $pendaftar->jenis_tikets->harga;
        }

        $imagePath = public_path('front/img/logo.png');
        $imageContent = file_get_contents($imagePath);

        if(!empty($pendaftar->jenis_tiket_id)){
            $mail = [
                'kepada' => $pendaftar->email,
                'email' => 'contact.hangoutproject@gmail.com',
                'dari' => 'Hangout Project',
                'subject' => 'Terima kasih anda telah melakukan pemesanan tiket '.$judul,
                'imageContent' => $imageContent,
                'judul' => $judul,
                'tanggal_mulai' => $tanggal_mulai,
                'tanggal_berakhir' => $tanggal_berakhir,
                'jenis_tiket' => $jenis_tiket,
                'nama_panjang' => $nama_panjang,
                'email' => $email,
                'tanggal_pemesanan' => $tanggal_pemesanan,
                'tiket' => $tiket,
                'harga' => 'Rp. '.strrev(implode('.', str_split(strrev(strval($harga)), 3))),
            ];
        }else{
            $mail = [
                'kepada' => $pendaftar->email,
                'email' => 'contact.hangoutproject@gmail.com',
                'dari' => 'Hangout Project',
                'subject' => 'Terima kasih anda telah melakukan pemesanan tiket '.$judul,
                'imageContent' => $imageContent,
                'judul' => $judul,
                'tanggal_mulai' => $tanggal_mulai,
                'tanggal_berakhir' => $tanggal_berakhir,
                'jenis_tiket' => $jenis_tiket,
                'nama_panjang' => $nama_panjang,
                'email' => $email,
                'tanggal_pemesanan' => $tanggal_pemesanan,
            ];
        }

        Mail::send('email.email', $mail, function($message) use ($mail){
            $message->to($mail['kepada'])
            ->from($mail['email'], $mail['dari'])
            ->subject($mail['subject']);
        });

        return back()->with('success', 'Berhasil melakukan pemesanan tiket '.$agenda->judul.' pada '.$pendaftar->created_at.'. Bukti transaksi akan dikirim ke email '.$pendaftar->email.'. QR-Code akan dikirim ke alamat email yang sama setelah admin mengapproved pemesanan');
    }

    public function generateNumber(){
        do{
            $token = mt_rand(999999999, 9999999999);
        }while(Pendaftar::where("token", "=", $token)->first());

        return $token;
    }
}
