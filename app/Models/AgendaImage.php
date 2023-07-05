<?php

namespace App\Models;

use App\Models\Agenda;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgendaImage extends Model
{
    use HasFactory;

    protected $table = 'agenda_images';

    protected $primaryKey = 'id';

    protected $fillable = [
        'agenda_id',
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

    public function agendas(){
        return $this->belongsTo(Agenda::class, 'agenda_id');
    }
}
