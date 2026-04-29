<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\StudentDocument;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class DocumentService
{
    /**
     * Handle the upload of a student document.
     * 
     * @param int $userId
     * @param string $documentType
     * @param UploadedFile $file
     * @return StudentDocument
     * @throws Exception
     */
    public function uploadDocument(int $userId, string $documentType, UploadedFile $file): StudentDocument
    {
        // Pengecekan ukuran file maksimal dari tabel Setting (default 2048 KB = 2MB)
        $maxSizeKB = Setting::getValue('max_upload_size', 2048);
        $fileSizeKB = $file->getSize() / 1024;

        if ($fileSizeKB > $maxSizeKB) {
            throw new Exception("Ukuran file maksimal yang diizinkan adalah {$maxSizeKB} KB.");
        }

        return DB::transaction(function () use ($userId, $documentType, $file) {
            try {
                // Hapus file lama jika ada
                $existingDoc = StudentDocument::where('user_id', $userId)
                                              ->where('document_type', $documentType)
                                              ->first();
                if ($existingDoc && Storage::disk('public')->exists($existingDoc->file_path)) {
                    Storage::disk('public')->delete($existingDoc->file_path);
                }

                // Simpan file baru
                $filename = "{$userId}_{$documentType}_" . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('documents', $filename, 'public');

                if (!$path) {
                    throw new Exception("Gagal menyimpan file ke storage.");
                }

                // Simpan/Update record di database
                return StudentDocument::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'document_type' => $documentType
                    ],
                    [
                        'file_path' => $path,
                        'status' => 'pending',
                        'admin_note' => null
                    ]
                );
            } catch (Exception $e) {
                Log::error("Upload Document Error (User: {$userId}, Type: {$documentType}): " . $e->getMessage());
                throw new Exception("Terjadi kesalahan saat menyimpan dokumen: " . $e->getMessage());
            }
        });
    }

    /**
     * Update status dokumen oleh admin.
     * 
     * @param int $documentId
     * @param string $status
     * @param string|null $note
     * @return bool
     * @throws Exception
     */
    public function updateDocumentStatus(int $documentId, string $status, ?string $note = null): bool
    {
        return DB::transaction(function () use ($documentId, $status, $note) {
            try {
                $document = StudentDocument::findOrFail($documentId);
                return $document->update([
                    'status' => $status,
                    'admin_note' => $note
                ]);
            } catch (Exception $e) {
                Log::error("Update Document Status Error (DocID: {$documentId}): " . $e->getMessage());
                throw $e;
            }
        });
    }
}
