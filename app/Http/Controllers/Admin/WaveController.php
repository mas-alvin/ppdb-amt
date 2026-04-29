<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wave;
use App\Services\WaveService;
use App\Http\Requests\Admin\StoreWaveRequest;
use App\Http\Requests\Admin\UpdateWaveRequest;
use Exception;

class WaveController extends Controller
{
    protected $waveService;

    public function __construct(WaveService $waveService)
    {
        $this->waveService = $waveService;
    }

    public function index()
    {
        $waves = $this->waveService->getAllWaves();
        return view('pages.admin.schedule.index', compact('waves'));
    }

    public function store(StoreWaveRequest $request)
    {
        try {
            $this->waveService->storeWave($request->validated());
            return back()->with('success', 'Gelombang baru berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(UpdateWaveRequest $request, Wave $wave)
    {
        try {
            $this->waveService->updateWave($wave, $request->validated());
            return back()->with('success', 'Data gelombang berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Wave $wave)
    {
        try {
            $this->waveService->deleteWave($wave);
            return back()->with('success', 'Gelombang berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
