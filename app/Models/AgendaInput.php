<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaInput extends Model
{
    use HasFactory;

    protected $table = 'agenda_inputs';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function agenda()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id');
    }

    public function optionalAnswers(){
        return $this->hasMany(OptionalAnswer::class);
    }
}
