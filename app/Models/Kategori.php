<?php

namespace App\Models;

use App\Models\ActivityManajemen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'kategoris';

    protected $primaryKey = 'id';

    protected $fillable = [
        'kategori',
        'slug',
        'status_aktif',
        'created_by',
        'updated_by',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'kategori'
            ]
        ];
    }

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
        return $this->hasMany(ActivityManajemen::class);
    }
}
