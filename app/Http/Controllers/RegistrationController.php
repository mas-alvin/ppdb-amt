<?php

namespace App\Http\Controllers;

use App\Http\Requests\Students\StoreRegistrationRequest;
use App\Services\RegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Exception;

class RegistrationController extends Controller
{
    protected $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * Show the form for creating a new registration or display existing data.
     */
    public function create()
    {
        $user = auth()->user();
        $registration = $this->registrationService->getRegistrationByUserId($user->id);
        
        // Fetch active majors
        $jurusans = \App\Models\Jurusan::where('is_active', true)->get();

        return view('pages.students.wizard', compact('registration', 'jurusans'));
    }

    /**
     * Store a newly created registration in storage.
     */
    public function store(StoreRegistrationRequest $request): RedirectResponse
    {
        try {
            $this->registrationService->createRegistration(
                $request->validated(),
                auth()->id()
            );

            return redirect()->route('student.dashboard')
                ->with('success', 'Pendaftaran Anda berhasil dikirim! Silakan tunggu proses verifikasi.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified registration for admin.
     */
    public function index()
    {
        $registrations = $this->registrationService->getAllRegistrations();
        return view('pages.admin.registrations.index', compact('registrations'));
    }

    /**
     * Display the specified registration for admin.
     */
    public function show(int $id)
    {
        $registration = \App\Models\Registration::with('user.documents')->findOrFail($id);
        
        $documentTypes = [
            'ijazah' => 'Ijazah Terakhir',
            'skhun' => 'SKHUN / Surat Keterangan Lulus',
            'kk' => 'Kartu Keluarga',
            'akta' => 'Akta Kelahiran',
            'pasfoto' => 'Pas Foto 3x4',
        ];

        return view('pages.admin.registrations.show', compact('registration', 'documentTypes'));
    }

    /**
     * Update the status of a registration.
     */
    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        try {
            $request->validate([
                'status' => 'required|in:verified,rejected',
                'catatan_admin' => 'nullable|string'
            ]);

            // Cek kelengkapan dokumen jika admin mencoba menyetujui
            if ($request->status === 'verified') {
                $registration = \App\Models\Registration::findOrFail($id);
                $requiredDocs = ['ijazah', 'skhun', 'kk', 'akta', 'pasfoto'];
                $uploadedDocs = $registration->user->documents()->where('status', 'verified')->pluck('document_type')->toArray();
                
                $missing = array_diff($requiredDocs, $uploadedDocs);
                if (count($missing) > 0) {
                    return back()->with('error', 'Tidak dapat menyetujui pendaftaran. Ada dokumen yang belum diunggah atau belum diverifikasi: ' . implode(', ', $missing));
                }
            }

            $this->registrationService->updateStatus(
                $id,
                $request->status,
                $request->catatan_admin
            );

            return back()->with('success', 'Status pendaftaran berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }

    /**
     * Update the status of an individual document.
     */
    public function updateDocumentStatus(Request $request, int $documentId, \App\Services\DocumentService $documentService): RedirectResponse
    {
        try {
            $request->validate([
                'status' => 'required|in:verified,rejected',
                'admin_note' => 'nullable|string'
            ]);

            $documentService->updateDocumentStatus(
                $documentId,
                $request->status,
                $request->admin_note
            );

            return back()->with('success', 'Status dokumen berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memperbarui dokumen: ' . $e->getMessage());
        }
    }
}
