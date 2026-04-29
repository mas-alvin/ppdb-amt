<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusans = [
            [
                'nama_jurusan' => 'Rekayasa Perangkat Lunak',
                'kode_jurusan' => 'RPL',
                'deskripsi' => 'Mempelajari pengembangan perangkat lunak, aplikasi mobile, dan web.',
                'is_active' => true,
            ],
            [
                'nama_jurusan' => 'Teknik Komputer dan Jaringan',
                'kode_jurusan' => 'TKJ',
                'deskripsi' => 'Mempelajari perakitan komputer, instalasi jaringan, dan administrasi server.',
                'is_active' => true,
            ],
            [
                'nama_jurusan' => 'Multimedia',
                'kode_jurusan' => 'MM',
                'deskripsi' => 'Mempelajari desain grafis, fotografi, videografi, dan animasi.',
                'is_active' => true,
            ],
            [
                'nama_jurusan' => 'Akuntansi',
                'kode_jurusan' => 'AK',
                'deskripsi' => 'Mempelajari pembukuan, pelaporan keuangan, dan audit.',
                'is_active' => true,
            ],
        ];

        foreach ($jurusans as $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}
