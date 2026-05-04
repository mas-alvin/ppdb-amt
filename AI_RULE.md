🧱 1. Core Architecture: Service Pattern
- Dilarang keras menulis logika bisnis, kueri database, atau integrasi API di dalam Controller.
- Flow: Request → FormRequest (Validation) → Controller → Service → Model → Response.
- Service Layer (app/Services/):
  - Satu method harus atomik (satu tugas spesifik).
  - Wajib Type Hinting (parameter & return).
  - Gunakan DB::transaction untuk operasi multi-tabel demi integritas data.

🛡️ 2. Strict Security & Validation
Setiap fitur wajib melewati filter keamanan berikut:
  - Authorization: Gunakan Laravel Policy atau Gate untuk setiap aksi (view, create, update, delete).
  - Validation: Wajib menggunakan FormRequest.
  - Gunakan Rule::unique, exists, dan prohibited_if untuk kontrol data yang ketat.
  - Sanitasi input: Gunakan strip_tags() atau Purifier jika menerima input HTML.
  - Protection: * Cegah Mass Assignment dengan $fillable.
  - Gunakan Secure Password Hashing dan Rate Limiting pada endpoint sensitif.
  - Wajib proteksi CSRF dan XSS.

🔔 3. Frontend Interaction: SweetAlert2
Setiap response dari Controller harus menyertakan feedback untuk SweetAlert2:
  - Format Session: Kirim data via with('success', '...') atau with('error', '...').
  - Standard Alert:
    - success: Untuk operasi berhasil.
    - error: Untuk kegagalan validasi atau sistem.
  - warning: Untuk konfirmasi penghapusan (wajib tanya user sebelum eksekusi).
  - AJAX Response: Jika menggunakan API/Axios, kirim JSON dengan struktur: { "status": "success", "message": "..." }.

💻 4. Code Style & Standards
- DRY & Clean Code: Gunakan Early Return (hindari if-else bertumpuk).
- Error Handling: try-catch wajib ada di Service. Log error menggunakan Log::error() dan kembalikan pesan user-friendly ke UI.
- Reusable Logic: Logika yang dipakaiulang wajib masuk ke Trait atau BaseService.

Untuk menjalankan artisan gunakan perintah seperti ini "sudo docker exex -it ppdb-app php artisan %command%". contohnya "sudo docker exex -it ppdb-app php artisan migrate".
