<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'bahan', 'langkah', 'gambar', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Di app/Models/Resep.php
    public function getGambarUrlAttribute()
    {
        return asset('storage/' . $this->gambar);
    }
}