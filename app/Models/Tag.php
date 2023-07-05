<?php

namespace App\Models;

use App\Models\Update;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $primaryKey = 'id';

    protected $fillable = [
        'tag',
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

    public function updates(){
        return $this->belongsToMany(Update::class, 'update_tags', 'tag_id', 'update_id');
    }
}
