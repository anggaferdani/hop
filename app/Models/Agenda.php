<?php

namespace App\Models;

use App\Models\Type;
use App\Models\JenisTiket;
use App\Models\AgendaImage;
use App\Models\HangoutPlace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'agendas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'hangout_place_id',
        'judul',
        'deskripsi',
        'jenis',
        'tiket',
        'tanggal_mulai',
        'tanggal_berakhir',
        'redirect_link_pendaftaran',
        'link_pendaftaran',
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

    public function hangout_places(){
        return $this->belongsTo(HangoutPlace::class, 'hangout_place_id');
    }

    public function agenda_images(){
        return $this->hasMany(AgendaImage::class);
    }

    public function jenis_tikets(){
        return $this->hasMany(JenisTiket::class);
    }

    public function types(){
        return $this->belongsToMany(Type::class, 'agenda_types', 'agenda_id', 'type_id');
    }
}
