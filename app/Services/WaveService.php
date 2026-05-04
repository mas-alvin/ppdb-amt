<?php

namespace App\Services;

use App\Models\Wave;
use Illuminate\Support\Facades\Log;
use Exception;

class WaveService
{
    public function getAllWaves()
    {
        return Wave::withCount('registrations')->latest()->get();
    }

    public function storeWave(array $data)
    {
        try {
            return Wave::create($data);
        } catch (Exception $e) {
            Log::error('Error storing wave: ' . $e->getMessage());
            throw new Exception('Gagal membuat gelombang baru.');
        }
    }

    public function updateWave(Wave $wave, array $data)
    {
        try {
            return $wave->update($data);
        } catch (Exception $e) {
            Log::error('Error updating wave: ' . $e->getMessage());
            throw new Exception('Gagal memperbarui data gelombang.');
        }
    }

    public function deleteWave(Wave $wave)
    {
        try {
            return $wave->delete();
        } catch (Exception $e) {
            Log::error('Error deleting wave: ' . $e->getMessage());
            throw new Exception('Gagal menghapus gelombang.');
        }
    }
}
