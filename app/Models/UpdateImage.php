<?php

namespace App\Models;

use App\Models\Update;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UpdateImage extends Model
{
    use HasFactory;

    protected $table = 'update_images';

    protected $primaryKey = 'id';

    protected $fillable = [
        'update_id',
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

    public function updates(){
        return $this->belongsTo(Update::class, 'update_id');
    }
}
