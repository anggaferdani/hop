<?php

namespace App\Models;

use App\Models\HangoutPlace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seating extends Model
{
    use HasFactory;

    protected $table = 'seatings';

    protected $primaryKey = 'id';

    protected $fillable = [
        'seating',
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

    public function hangout_places(){
        return $this->belongsToMany(HangoutPlace::class, 'hangout_place_seatings', 'seating_id', 'hangout_place_id');
    }
}
