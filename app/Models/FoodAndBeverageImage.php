<?php

namespace App\Models;

use App\Models\FoodAndBeverage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FoodAndBeverageImage extends Model
{
    use HasFactory;

    protected $table = 'food_and_beverage_images';

    protected $primaryKey = 'id';

    protected $fillable = [
        'food_and_beverage_id',
        'image',
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
        return $this->belongsTo(FoodAndBeverage::class, 'foon_and_beverage_id');
    }
}
