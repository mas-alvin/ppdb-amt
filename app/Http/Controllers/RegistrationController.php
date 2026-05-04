<?php

namespace App\Http\Controllers;

use App\Http\Requests\Students\StoreRegistrationRequest;
use App\Services\RegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class RegistrationController extends Controller
{
    protected $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * Download registration proof as PDF.
     */
    public function downloadProof()
    {
        $user = auth()->user();
        $registration = $this->registrationService->getRegistrationByUserId($user->id);

        if (!$registration) {
            return back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $registration->load(['jurusan', 'wave']);

        $pdf = Pdf::loadView('pages.students.registration-proof', compact('registration'));
        
        return $pdf->download('Bukti-Pendaftaran-' . $registration->nisn . '.pdf');
    }

    /**
     * Show the form for creating a new registration or display existing data.
     */
    public function create()
    {
        $user = auth()->user();
        $registration = $this->registrationService->getRegistrationByUserId($user->id);
        
        // Find Active Wave
        $activeWave = \App\Models\Wave::where('status', 'open')
            ->whereDate('start_date', '<=', today())
            ->whereDate('end_date', '>=', today())
            ->first();

        // Fetch active majors
        $jurusans = \App\Models\Jurusan::where('is_active', true)->get();

        return view('pages.students.wizard', compact('registration', 'jurusans', 'activeWave'));
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

    public function exportPdf()
    {
        $registrations = $this->registrationService->getAllRegistrations();
        $pdf = Pdf::loadView('pages.admin.registrations.export-pdf', compact('registrations'))
            ->setPaper('a4', 'landscape');
            
        return $pdf->download('Daftar-Pendaftar-PPDB-' . now()->format('Y-m-d') . '.pdf');
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

            return back()->with('success', 'Status pendaftaran berhasil diperbarui.')
                ->with('active_tab', 'identitas');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage())
                ->with('active_tab', 'identitas');
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

            return back()->with('success', 'Status dokumen berhasil diperbarui.')
                ->with('active_tab', 'dokumen');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memperbarui dokumen: ' . $e->getMessage())
                ->with('active_tab', 'dokumen');
        }
    }
}
