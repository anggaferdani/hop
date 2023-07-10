<?php

namespace App\Models;

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
        'nama_panjang',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_telepon',
        'email',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'pekerjaan',
        'status_aktif',
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
}
