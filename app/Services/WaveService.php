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
        // Validasi bentrokan tanggal periode gelombang
        $overlapping = Wave::where(function ($query) use ($data) {
            $query->where('start_date', '<=', $data['end_date'])
                  ->where('end_date', '>=', $data['start_date']);
        })->first();

        if ($overlapping) {
            throw new Exception("Tanggal periode bertabrakan dengan gelombang '{$overlapping->name}' ({$overlapping->start_date->format('d-m-Y')} s/d {$overlapping->end_date->format('d-m-Y')}).");
        }

        try {
            return Wave::create($data);
        } catch (Exception $e) {
            Log::error('Error storing wave: ' . $e->getMessage());
            throw new Exception('Gagal membuat gelombang baru.');
        }
    }

    public function updateWave(Wave $wave, array $data)
    {
        // Validasi bentrokan tanggal periode gelombang (abaikan data diri sendiri)
        $overlapping = Wave::where('id', '!=', $wave->id)
            ->where(function ($query) use ($data) {
                $query->where('start_date', '<=', $data['end_date'])
                      ->where('end_date', '>=', $data['start_date']);
            })->first();

        if ($overlapping) {
            throw new Exception("Tanggal periode bertabrakan dengan gelombang '{$overlapping->name}' ({$overlapping->start_date->format('d-m-Y')} s/d {$overlapping->end_date->format('d-m-Y')}).");
        }

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
