<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\DocumentService;
use Illuminate\Http\Request;
use Exception;

class DocumentController extends Controller
{
    protected $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    /**
     * Tampilkan halaman dokumen siswa.
     */
    public function index()
    {
        $user = auth()->user();
        
        // Cek apakah siswa sudah menyelesaikan wizard
        if (!$user->registration) {
            return redirect()->route('student.pendaftaran.wizard')
                ->with('warning', 'Anda harus menyelesaikan pengisian formulir pendaftaran terlebih dahulu sebelum dapat mengunggah dokumen.');
        }

        $documents = $user->documents()->get()->keyBy('document_type');
        
        return view('pages.students.documents', compact('documents'));
    }

    /**
     * Tangani proses unggah dokumen.
     */
    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            
            if (!$user->registration) {
                throw new Exception('Anda harus menyelesaikan pengisian formulir pendaftaran terlebih dahulu.');
            }

            $request->validate([
                'document_type' => 'required|in:ijazah,skhun,kk,akta,pasfoto',
                'file' => 'required|file|mimes:pdf,jpg,jpeg,png', // Ukuran divalidasi di Service
            ]);

            $this->documentService->uploadDocument(
                $user->id,
                $request->document_type,
                $request->file('file')
            );

            return back()->with('success', 'Dokumen berhasil diunggah dan sedang menunggu verifikasi.');
            
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
