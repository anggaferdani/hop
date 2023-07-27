<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublicAreaImage extends Model
{
    use HasFactory;

    protected $table = 'public_area_images';

    protected $primaryKey = 'id';

    protected $fillable = [
        'public_area_id',
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

    public function public_areas(){
        return $this->belongsTo(PublicArea::class, 'public_area_id');
    }
}
