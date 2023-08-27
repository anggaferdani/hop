<?php

namespace App\Models;

use App\Models\Agenda;
use App\Models\Feature;
use App\Models\Fasilitas;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Entertaiment;
use App\Models\HangoutPlaceLogo;
use App\Models\HangoutPlaceImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HangoutPlace extends Model
{
    use HasFactory;
    use Sluggable;

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
        'status',
        'instagram',
        'tiktok',
        'slug',
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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_tempat',
                'onUpdate'=> true,
            ]
        ];
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
        return $this->hasMany(Agenda::class);
    }

    public function hangout_place_images(){
        return $this->hasMany(HangoutPlaceImage::class);
    }

    public function hangout_place_logos(){
        return $this->hasMany(HangoutPlaceLogo::class);
    }

    public function seatings(){
        return $this->belongsToMany(Seating::class, 'hangout_place_seatings', 'hangout_place_id', 'seating_id');
    }

    public function features(){
        return $this->belongsToMany(Feature::class, 'hangout_place_features', 'hangout_place_id', 'feature_id');
    }

    public function entertaiments(){
        return $this->belongsToMany(Entertaiment::class, 'hangout_place_entertaiments', 'hangout_place_id', 'entertaiment_id');
    }

    public function fasilitas(){
        return $this->belongsToMany(Fasilitas::class, 'hangout_place_fasilitas', 'hangout_place_id', 'fasilitas_id');
    }
}
