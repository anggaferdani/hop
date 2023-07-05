<?php

namespace App\Models;

use App\Models\Lodging;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LodgingImage extends Model
{
    use HasFactory;

    protected $table = 'lodging_images';

    protected $primaryKey = 'id';

    protected $fillable = [
        'lodging_id',
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

    public function lodgings(){
        return $this->belongsTo(Lodging::class, 'lodging_id');
    }
}
