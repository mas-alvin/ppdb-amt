<?php

namespace App\Services;

use App\Models\Registration;
use App\Models\Wave;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class RegistrationService
{
    protected PromoteStudentService $promoteService;

    public function __construct(PromoteStudentService $promoteService)
    {
        $this->promoteService = $promoteService;
    }

    /**
     * Create a new registration.
     * 
     * @param array $data
     * @param int $userId
     * @return Registration
     * @throws Exception
     */
    public function createRegistration(array $data, int $userId): Registration
    {
        return DB::transaction(function () use ($data, $userId) {
            try {
                // Find Active Wave
                $activeWave = Wave::where('status', 'open')
                    ->whereDate('start_date', '<=', today())
                    ->whereDate('end_date', '>=', today())
                    ->first();

                if (!$activeWave) {
                    throw new Exception('Pendaftaran saat ini sedang ditutup atau belum dibuka untuk tanggal hari ini.');
                }

                // Check Quota
                if ($activeWave->isFull()) {
                    throw new Exception('Maaf, kuota untuk gelombang ' . $activeWave->name . ' sudah penuh.');
                }

                // Check if user already has a registration
                $existing = Registration::where('user_id', $userId)->first();
                if ($existing) {
                    throw new Exception('Anda sudah melakukan pendaftaran.');
                }

                $data['user_id'] = $userId;
                $data['wave_id'] = $activeWave->id;
                $data['status'] = 'pending';

                return Registration::create($data);
            } catch (Exception $e) {
                Log::error('Registration Creation Error: ' . $e->getMessage());
                throw $e;
            }
        });
    }

    /**
     * Get registration by user ID.
     * 
     * @param int $userId
     * @return Registration|null
     */
    public function getRegistrationByUserId(int $userId): ?Registration
    {
        return Registration::where('user_id', $userId)->first();
    }

    /**
     * Get all registrations for admin.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRegistrations()
    {
        return Registration::with('user')->latest()->get();
    }

    /**
     * Update registration status.
     * 
     * Jika status = 'verified', akan langsung mencoba sinkronisasi ke Data Center.
     * Jika sinkronisasi gagal, status tetap verified dan admin bisa retry
     * melalui tombol "SINKRONKAN KE DATA CENTER".
     * 
     * @param int $id
     * @param string $status
     * @param string|null $catatanAdmin
     * @return array{status_updated: bool, sync_success: bool, sync_error: string|null}
     * @throws Exception
     */
    public function updateStatus(int $id, string $status, ?string $catatanAdmin): array
    {
        $result = [
            'status_updated' => false,
            'sync_success' => false,
            'sync_error' => null,
        ];

        // LANGKAH 1: Update status di PPDB (commit langsung)
        $registration = Registration::findOrFail($id);
        $registration->update([
            'status' => $status,
            'catatan_admin' => $catatanAdmin,
        ]);
        $result['status_updated'] = true;

        Log::info("Registration #{$id} status updated to '{$status}'");

        // LANGKAH 2: Jika verified, coba sinkronkan ke Data Center
        if ($status === 'verified') {
            try {
                $registration->refresh();
                $this->promoteService->promote($registration);
                $result['sync_success'] = true;
                Log::info("Registration #{$id} successfully synced to Data Center");
            } catch (Exception $e) {
                // Status tetap verified, tapi sync gagal.
                // Admin bisa retry via tombol "SINKRONKAN KE DATA CENTER"
                $result['sync_error'] = $e->getMessage();
                Log::error('Data Center Sync Error: ' . $e->getMessage(), [
                    'registration_id' => $id,
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        }

        return $result;
    }
}
