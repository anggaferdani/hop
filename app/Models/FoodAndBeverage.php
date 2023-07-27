<?php

namespace App\Models;

use App\Models\Seating;
use App\Models\FoodAndBeverageImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FoodAndBeverage extends Model
{
    use HasFactory;

    protected $table = 'food_and_beverages';

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

    public function food_and_beverage_images(){
        return $this->hasMany(FoodAndBeverageImage::class);
    }

    public function seatings(){
        return $this->belongsToMany(Seating::class, 'food_and_beverage_seatings', 'food_and_beverage_id', 'seating_id');
    }
}
