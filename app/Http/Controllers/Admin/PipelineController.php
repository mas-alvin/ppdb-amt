<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stage;
use App\Services\PipelineService;
use App\Http\Requests\Admin\UpdateStageRequest;
use App\Http\Requests\Admin\StoreStageRequest;
use Illuminate\Http\Request;
use Exception;

class PipelineController extends Controller
{
    protected $pipelineService;

    public function __construct(PipelineService $pipelineService)
    {
        $this->pipelineService = $pipelineService;
    }

    public function index()
    {
        $stages = Stage::orderBy('order')->get();
        return view('pages.admin.pipeline.index', compact('stages'));
    }

    public function store(StoreStageRequest $request)
    {
        try {
            $this->pipelineService->storeStage($request->validated());
            return back()->with('success', 'Alur baru berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(UpdateStageRequest $request, Stage $stage)
    {
        try {
            $this->pipelineService->updateStage($stage, $request->validated());
            return back()->with('success', 'Konfigurasi tahap berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function toggleStatus(Stage $stage)
    {
        $this->pipelineService->toggleStatus($stage);
        return back()->with('success', 'Status tahap berhasil diubah.');
    }
}
