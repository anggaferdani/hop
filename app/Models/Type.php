<?php

namespace App\Models;

use App\Models\Agenda;
use App\Models\ActivityManajemen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';

    protected $primaryKey = 'id';

    protected $fillable = [
        'type',
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

    public function agenadas(){
        return $this->belongsToMany(Agenda::class, 'agenda_types', 'type_id', 'agenda_id');
    }

    public function activity_manajemens(){
        return $this->belongsToMany(ActivityManajemen::class, 'activity_manajemen_types', 'type_id', 'activity_manajemen_id');
    }
}
