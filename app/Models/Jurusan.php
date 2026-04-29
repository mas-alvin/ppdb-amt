<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jurusan',
        'kode_jurusan',
        'deskripsi',
        'is_active',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
