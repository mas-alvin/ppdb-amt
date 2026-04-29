<?php

namespace App\Services;

use App\Models\Registration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class RegistrationService
{
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
                // Check if user already has a registration
                $existing = Registration::where('user_id', $userId)->first();
                if ($existing) {
                    throw new Exception('Anda sudah melakukan pendaftaran.');
                }

                $data['user_id'] = $userId;
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
     * @param int $id
     * @param string $status
     * @param string|null $note
     * @return bool
     * @throws Exception
     */
    public function updateStatus(int $id, string $status, ?string $note = null): bool
    {
        return DB::transaction(function () use ($id, $status, $note) {
            try {
                $registration = Registration::findOrFail($id);
                return $registration->update([
                    'status' => $status,
                    'catatan_admin' => $note
                ]);
            } catch (Exception $e) {
                Log::error('Update Status Error: ' . $e->getMessage());
                throw $e;
            }
        });
    }
}
