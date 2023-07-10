<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityManajemenImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityManajemen extends Model
{
    use HasFactory;

    protected $table = 'activity_manajemens';

    protected $primaryKey = 'id';

    protected $fillable = [
        'kategori_id',
        'judul',
        'deskripsi',
        'tanggal_publikasi',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'lokasi',
        'whatsapp',
        'instagram',
        'twitter',
        'harga_mulai',
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

    public function kategoris(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function activity_manajemen_images(){
        return $this->hasMany(ActivityManajemenImage::class);
    }

    public function types(){
        return $this->belongsToMany(Type::class, 'activity_manajemen_types', 'activity_manajemen_id', 'type_id');
    }
}
