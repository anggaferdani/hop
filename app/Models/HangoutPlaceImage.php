<?php

namespace App\Models;

use App\Models\HangoutPlace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HangoutPlaceImage extends Model
{
    use HasFactory;

    protected $table = 'hangout_place_images';

    protected $primaryKey = 'id';

    protected $fillable = [
        'hangout_place_id',
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

    public function hangout_places(){
        return $this->belongsTo(HangoutPlace::class, 'hangout_place_id');
    }
}
