<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        $announcements = [
            [
                'title' => 'Pembukaan PPDB Gelombang 1',
                'content' => 'Pendaftaran siswa baru Gelombang 1 telah dibuka mulai tanggal 1 Maret hingga 30 April 2026. Segera lengkapi berkas Anda!',
                'type' => 'info',
                'user_id' => $admin?->id,
            ],
            [
                'title' => 'Peringatan: Batas Unggah Dokumen',
                'content' => 'Batas akhir unggah dokumen untuk Gelombang 1 adalah tanggal 1 Mei 2026. Dokumen yang tidak lengkap tidak akan diproses.',
                'type' => 'warning',
                'user_id' => $admin?->id,
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::create($announcement);
        }
    }
}
