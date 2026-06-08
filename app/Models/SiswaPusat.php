<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaPusat extends Model
{
    // Paksa model ini menggunakan koneksi 'datacenter' dari config/database.php
    protected $connection = 'datacenter';
    
    // Sesuaikan dengan nama tabel siswa yang ada di database Data Center Anda
    protected $table = 'students'; 

    // Daftarkan field apa saja yang wajib diisi di database Data Center
    protected $fillable = [
        'nisn',
        'nama_lengkap',
        'email',
        // ... tambahkan field lain sesuai kebutuhan database pusat Anda
    ];
}