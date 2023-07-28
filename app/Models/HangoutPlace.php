<?php

namespace App\Models;

use App\Models\Agenda;
use App\Models\Fasilitas;
use App\Models\HangoutPlaceImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HangoutPlace extends Model
{
    use HasFactory;

    protected $table = 'hangout_places';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_tempat',
        'deskripsi_tempat',
        'lokasi',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'harga',
        'logo',
        'status',
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

    public function hangout_place_images(){
        return $this->hasMany(HangoutPlaceImage::class);
    }

    public function seatings(){
        return $this->belongsToMany(Seating::class, 'hangout_place_seatings', 'hangout_place_id', 'seating_id');
    }

    public function fasilitas(){
        return $this->belongsToMany(Fasilitas::class, 'hangout_place_fasilitas', 'hangout_place_id', 'fasilitas_id');
    }
}