<?php

namespace App\Models;

use App\Models\Type;
use App\Models\User;
use App\Models\Lodging;
use App\Models\JenisTiket;
use App\Models\PublicArea;
use App\Models\AgendaImage;
use App\Models\FoodAndBeverage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'food_and_beverage_id',
        'lodging_id',
        'public_area_id',
        'judul',
        'deskripsi',
        'jenis',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'tiket',
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

    public function food_and_beverages(){
        return $this->belongsTo(FoodAndBeverage::class, 'food_and_beverage_id');
    }

    public function lodgings(){
        return $this->belongsTo(Lodging::class, 'lodging_id');
    }

    public function public_areas(){
        return $this->belongsTo(PublicArea::class, 'public_area_id');
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
