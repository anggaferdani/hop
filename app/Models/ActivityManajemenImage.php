<?php

namespace App\Models;

use App\Models\ActivityManajemen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityManajemenImage extends Model
{
    use HasFactory;

    protected $table = 'activity_manajemen_images';

    protected $primaryKey = 'id';

    protected $fillable = [
        'activity_manajemen_id',
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

    public function activity_manajemens(){
        return $this->belongsTo(ActivityManajemen::class, 'activity_manajemen_id');
    }
}
