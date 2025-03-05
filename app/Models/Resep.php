<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'reseps'; // Sesuaikan dengan nama tabel di database

    protected $fillable = ['judul', 'bahan', 'langkah', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
