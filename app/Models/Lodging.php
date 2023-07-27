<?php

namespace App\Models;

use App\Models\Agenda;
use App\Models\Fasilitas;
use App\Models\LodgingImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lodging extends Model
{
    use HasFactory;

    protected $table = 'lodgings';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_tempat',
        'deskripsi_tempat',
        'lokasi',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'harga',
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

    public function agendas(){
        return $this->hasMany(Agenda::class);
    }

    public function lodging_images(){
        return $this->hasMany(LodgingImage::class);
    }

    public function fasilitas(){
        return $this->belongsToMany(Fasilitas::class, 'lodging_fasilitas', 'lodging_id', 'fasilitas_id');
    }
}
