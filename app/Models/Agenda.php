<?php

namespace App\Models;

use App\Models\Type;
use App\Models\AgendaImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'penyelenggara',
        'judul',
        'deskripsi',
        'jenis',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'tiket',
        'harga_mulai',
        'harga_akhir',
        'tanggal_mulai',
        'tanggal_berakhir',
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

    public function agenda_images(){
        return $this->hasMany(AgendaImage::class);
    }

    public function types(){
        return $this->belongsToMany(Type::class, 'agenda_types', 'agenda_id', 'type_id');
    }
}
