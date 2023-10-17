<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Milon\Barcode\DNS2D;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class PendaftarController extends Controller
{
    public function index($agenda_id){
        $agenda = Agenda::find(Crypt::decrypt($agenda_id));
        $pendaftars = Pendaftar::with('jenis_tikets', 'optionalAnswers')->where('agenda_id', Crypt::decrypt($agenda_id))
        ->orderBy('status_approved', 'DESC')->orderBy('created_at', 'DESC')
        ->where('status_aktif', 'Aktif')->latest()->paginate(10);
        $provinsis = DB::table('m_provinsi')->get();
        $kabupatens = DB::table('m_kabupaten')->get();
        $kecamatans = DB::table('m_kecamatan')->get();
        return view('pendaftar.index', compact(
            'agenda',
            'pendaftars',
            'provinsis',
            'kabupatens',
            'kecamatans',
        ));
    }

    public function approved($id){
        $pendaftar = Pendaftar::with('jenis_tikets')->find(Crypt::decrypt($id));
        
        $pendaftar->update([
            'status_approved' => 'Approved',
        ]);

        $agenda = Agenda::find($pendaftar->agenda_id);

        $qrCodeData = $pendaftar->token;
        $dns2d = new DNS2D();
        $qrCodeHTML = $dns2d->getBarcodeHTML($qrCodeData, 'QRCODE');

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
                'subject' => 'Approved. Berikut QR-Code untuk '.$judul,
                'imageContent' => $imageContent,
                'qrCodeHTML' => $qrCodeHTML,
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
                'subject' => 'Approved. Berikut QR-Code untuk '.$judul,
                'imageContent' => $imageContent,
                'qrCodeHTML' => $qrCodeHTML,
                'judul' => $judul,
                'tanggal_mulai' => $tanggal_mulai,
                'tanggal_berakhir' => $tanggal_berakhir,
                'jenis_tiket' => $jenis_tiket,
                'nama_panjang' => $nama_panjang,
                'email' => $email,
                'tanggal_pemesanan' => $tanggal_pemesanan,
            ];
        }

        Mail::send('email.email2', $mail, function($message) use ($mail){
            $message->to($mail['kepada'])
            ->from($mail['email'], $mail['dari'])
            ->subject($mail['subject']);
        });

        return back()->with('success', 'Data has been approved at '.$pendaftar->updated_at);
    }

    public function deletePermanently($id){
        $pendaftar = Pendaftar::find(Crypt::decrypt($id));
        
        $pendaftar->update([
            'status_aktif' => 'Tidak Aktif',
        ]);

        return back()->with('success', 'Data has been deleted at '.$pendaftar->updated_at);
    }
}
