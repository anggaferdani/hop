<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HangoutPlaceEntertaiment extends Model
{
    use HasFactory;

    protected $table = 'hangout_place_entertaiments';

    protected $primaryKey = 'id';

    protected $fillable = [
        'hangout_place_id',
        'entertaiment_id',
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
}
