<?php

namespace App\Models;

use App\Models\Lodging;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fasilitas',
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

    public function lodgings(){
        return $this->belongsToMany(Lodging::class, 'lodging_fasilitas', 'fasilitas_id', 'lodging_id');
    }
}
