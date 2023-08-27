<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityManajemenImage;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityManajemen extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'activity_manajemens';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'tanggal_publikasi',
        'lokasi',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'whatsapp',
        'instagram',
        'tiktok',
        'harga_mulai',
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
                'source' => 'judul',
                'onUpdate'=> true,
            ]
        ];
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kategoris(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function activity_manajemen_images(){
        return $this->hasMany(ActivityManajemenImage::class);
    }
}
