<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class SettingController extends Controller
{
    /**
     * Display configuration system panel.
     */
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return view('pages.admin.settings.index', compact('settings'));
    }

    /**
     * Update general settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'timezone' => 'required|string|in:WIB,WITA,WIT',
            'max_upload_size' => 'required|integer|min:1',
            'academic_year' => 'required|string|max:50',
            'school_address' => 'required|string|max:500',
        ]);

        try {
            Setting::updateOrCreate(
                ['key' => 'school_name'],
                ['value' => $request->school_name, 'type' => 'string']
            );

            Setting::updateOrCreate(
                ['key' => 'timezone'],
                ['value' => $request->timezone, 'type' => 'string']
            );

            Setting::updateOrCreate(
                ['key' => 'max_upload_size'],
                ['value' => $request->max_upload_size * 1024, 'type' => 'integer'] // stored in KB
            );

            Setting::updateOrCreate(
                ['key' => 'academic_year'],
                ['value' => $request->academic_year, 'type' => 'string']
            );

            Setting::updateOrCreate(
                ['key' => 'school_address'],
                ['value' => $request->school_address, 'type' => 'string']
            );

            return back()->with('success', 'Konfigurasi umum berhasil disimpan!');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menyimpan konfigurasi: ' . $e->getMessage());
        }
    }

    /**
     * Upload the school brochure.
     */
    public function uploadBrochure(Request $request)
    {
        $request->validate([
            'brochure' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // Max 5MB brochure
        ]);

        try {
            if ($request->hasFile('brochure')) {
                $file = $request->file('brochure');

                // Delete old brochure if exists
                $oldPath = Setting::getValue('school_brochure');
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }

                // Store the new brochure file
                $filename = 'brosur_ppdb_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('brochures', $filename, 'public');

                if (!$path) {
                    throw new Exception("Gagal menulis file brosur ke disk.");
                }

                // Update database setting
                Setting::updateOrCreate(
                    ['key' => 'school_brochure'],
                    [
                        'value' => $path,
                        'description' => 'File brosur pendaftaran PPDB resmi',
                        'type' => 'string'
                    ]
                );

                return back()->with('success', 'Brosur pendaftaran berhasil diunggah!');
            }

            return back()->with('error', 'Tidak ada file brosur yang diunggah.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal mengunggah brosur: ' . $e->getMessage());
        }
    }

    /**
     * Delete the school brochure.
     */
    public function deleteBrochure()
    {
        try {
            $path = Setting::getValue('school_brochure');
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            // Remove settings entry
            Setting::where('key', 'school_brochure')->delete();

            return back()->with('success', 'Brosur pendaftaran berhasil dihapus!');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menghapus brosur: ' . $e->getMessage());
        }
    }
}
