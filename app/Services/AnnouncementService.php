<?php

namespace App\Services;

use App\Models\Announcement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class AnnouncementService
{
    /**
     * Store a new announcement.
     * 
     * @param array $data
     * @return Announcement
     * @throws Exception
     */
    public function storeAnnouncement(array $data): Announcement
    {
        try {
            if (isset($data['document'])) {
                $data['document_path'] = $data['document']->store('announcements', 'public');
            }

            return Announcement::create($data);
        } catch (Exception $e) {
            Log::error('Error storing announcement: ' . $e->getMessage());
            throw new Exception('Gagal menyimpan pengumuman.');
        }
    }

    /**
     * Update an announcement.
     * 
     * @param Announcement $announcement
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function updateAnnouncement(Announcement $announcement, array $data): bool
    {
        try {
            if (isset($data['document'])) {
                // Delete old document
                if ($announcement->document_path) {
                    Storage::disk('public')->delete($announcement->document_path);
                }
                $data['document_path'] = $data['document']->store('announcements', 'public');
            }

            return $announcement->update($data);
        } catch (Exception $e) {
            Log::error('Error updating announcement: ' . $e->getMessage());
            throw new Exception('Gagal memperbarui pengumuman.');
        }
    }

    /**
     * Delete an announcement.
     * 
     * @param Announcement $announcement
     * @return bool
     * @throws Exception
     */
    public function deleteAnnouncement(Announcement $announcement): bool
    {
        try {
            if ($announcement->document_path) {
                Storage::disk('public')->delete($announcement->document_path);
            }
            return $announcement->delete();
        } catch (Exception $e) {
            Log::error('Error deleting announcement: ' . $e->getMessage());
            throw new Exception('Gagal menghapus pengumuman.');
        }
    }

    /**
     * Toggle active status.
     * 
     * @param Announcement $announcement
     * @return bool
     */
    public function toggleStatus(Announcement $announcement): bool
    {
        return $announcement->update(['is_active' => !$announcement->is_active]);
    }
}
