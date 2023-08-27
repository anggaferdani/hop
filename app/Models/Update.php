<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\UpdateImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Update extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'updates';

    protected $primaryKey = 'id';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_publikasi',
        'user_id',
        'slug',
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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul',
                'onUpdate'=> true,
            ]
        ];
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function update_images(){
        return $this->hasMany(UpdateImage::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'update_tags', 'update_id', 'tag_id');
    }
}
