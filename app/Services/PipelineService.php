<?php

namespace App\Services;

use App\Models\Stage;
use Illuminate\Support\Facades\Log;
use Exception;

class PipelineService
{
    /**
     * Update stage configuration.
     * 
     * @param Stage $stage
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function updateStage(Stage $stage, array $data): bool
    {
        try {
            return $stage->update($data);
        } catch (Exception $e) {
            Log::error('Error updating stage: ' . $e->getMessage());
            throw new Exception('Gagal memperbarui konfigurasi alur.');
        }
    }

    /**
     * Create a new stage.
     * 
     * @param array $data
     * @return Stage
     * @throws Exception
     */
    public function storeStage(array $data): Stage
    {
        try {
            if (!isset($data['order'])) {
                $data['order'] = Stage::max('order') + 1;
            }
            return Stage::create($data);
        } catch (Exception $e) {
            Log::error('Error storing stage: ' . $e->getMessage());
            throw new Exception('Gagal menambah alur baru.');
        }
    }

    /**
     * Toggle stage active status.
     * 
     * @param Stage $stage
     * @return bool
     */
    public function toggleStatus(Stage $stage): bool
    {
        return $stage->update(['is_active' => !$stage->is_active]);
    }
}
