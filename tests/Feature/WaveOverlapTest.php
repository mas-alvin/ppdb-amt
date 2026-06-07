<?php

namespace Tests\Feature;

use App\Models\Wave;
use App\Services\WaveService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Exception;

class WaveOverlapTest extends TestCase
{
    use RefreshDatabase;

    protected $waveService;

    protected function setUp(): void
    {
        parent::setUp();
        // Pastikan tabel settings ada jika view welcome dimuat, atau jalankan seeder
        $this->artisan('db:seed');
        $this->waveService = app(WaveService::class);
    }

    public function test_cannot_create_overlapping_wave_periods(): void
    {
        // 1. Buat gelombang pertama
        $this->waveService->storeWave([
            'name' => 'Gelombang 1',
            'start_date' => '2026-03-01',
            'end_date' => '2026-04-30',
            'quota' => 100,
            'status' => 'open',
            'description' => 'Test',
        ]);

        // 2. Coba buat gelombang kedua yang bertabrakan (2026-04-15 s/d 2026-05-15)
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Tanggal periode bertabrakan dengan gelombang 'Gelombang 1'");

        $this->waveService->storeWave([
            'name' => 'Gelombang 2',
            'start_date' => '2026-04-15',
            'end_date' => '2026-05-15',
            'quota' => 100,
            'status' => 'draft',
            'description' => 'Test Overlap',
        ]);
    }

    public function test_can_update_current_wave_without_overlap_trigger(): void
    {
        // 1. Buat gelombang
        $wave = $this->waveService->storeWave([
            'name' => 'Gelombang 1',
            'start_date' => '2026-03-01',
            'end_date' => '2026-04-30',
            'quota' => 100,
            'status' => 'open',
            'description' => 'Test',
        ]);

        // 2. Perbarui gelombang tersebut dengan tanggal baru (tidak boleh memicu error tabrakan dengan dirinya sendiri)
        $updated = $this->waveService->updateWave($wave, [
            'name' => 'Gelombang 1 Updated',
            'start_date' => '2026-03-05',
            'end_date' => '2026-04-25',
            'quota' => 120,
            'status' => 'open',
            'description' => 'Updated Test',
        ]);

        $this->assertTrue($updated);
        $this->assertEquals('Gelombang 1 Updated', $wave->fresh()->name);
    }
}
