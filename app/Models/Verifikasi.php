<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Verifikasi extends Model
{
    use HasFactory;

    protected $table = 'verifikasis';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'status_verifikasi',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
