<?php

namespace App\Models;

use App\Models\Agenda;
use App\Models\PublicAreaImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublicArea extends Model
{
    use HasFactory;

    protected $table = 'public_areas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_tempat',
        'deskripsi_tempat',
        'lokasi',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
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

    public function public_area_images(){
        return $this->hasMany(PublicAreaImage::class);
    }
}
