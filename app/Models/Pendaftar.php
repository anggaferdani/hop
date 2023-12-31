<?php

namespace App\Models;

use App\Models\Agenda;
use App\Models\JenisTiket;
use App\Models\OptionalAnswer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftar extends Model
{
    use HasFactory;

    protected $table = 'pendaftars';

    protected $primaryKey = 'id';

    protected $fillable = [
        'token',
        'agenda_id',
        'nama_panjang',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_telepon',
        'email',
        'jenis_tiket_id',
        'bukti_transfer',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'pekerjaan',
        'status_aktif',
        'status_approved',
        'created_by',
        'updated_by',
    ];

    protected static function booted(){
        static::creating(function($model){
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });

        static::saving(function($model){
            $model->updated_by = Auth::id();
        });
    }

    public function Provinsi(){
        return $this->belongsTo(Provinsi::class, 'provinsi');
    }

    public function Kabupaten(){
        return $this->belongsTo(Kabupaten::class, 'kabupaten_kota');
    }

    public function Kecamatan(){
        return $this->belongsTo(Kecamatan::class, 'kecamatan');
    }

    public function agendas(){
        return $this->belongsTo(Agenda::class, 'agenda_id');
    }

    public function jenis_tikets(){
        return $this->belongsTo(JenisTiket::class, 'jenis_tiket_id');
    }

    public function optionalAnswers(){
        return $this->hasMany(OptionalAnswer::class);
    }
}
