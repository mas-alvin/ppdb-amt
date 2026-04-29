<?php

namespace Database\Seeders;

use App\Models\Stage;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stages = [
            [
                'key' => 'account',
                'label' => 'Pembuatan Akun',
                'description' => 'Registrasi portal pendaftaran selesai.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'form',
                'label' => 'Pengisian Formulir',
                'description' => 'Data pribadi, orang tua, dan asal sekolah lengkap.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'verify',
                'label' => 'Verifikasi Berkas',
                'description' => 'Tinjauan dokumen oleh panitia PPDB.',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'key' => 'selection',
                'label' => 'Seleksi / Ujian',
                'description' => 'Tahapan tes masuk atau seleksi prestasi.',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'key' => 'announce',
                'label' => 'Pengumuman Hasil',
                'description' => 'Publikasi status kelulusan akhir.',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($stages as $stage) {
            Stage::updateOrCreate(['key' => $stage['key']], $stage);
        }
    }
}
