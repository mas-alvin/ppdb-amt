<x-layout title="Pengaturan Keamanan - Portal PPDB">
    <div class="min-h-screen bg-slate-50">
        <main class="relative max-w-2xl px-4 mx-auto py-8">
            
            <!-- Header -->
            <div class="mb-8" data-aos="fade-right">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-green-100 text-green-800 text-xs font-black mb-4 border border-green-200 uppercase tracking-wider">
                    Pengaturan
                </div>
                <h2 class="text-3xl font-black tracking-tight text-green-950">Keamanan Akun</h2>
                <p class="text-slate-500 mt-2 text-sm">Perbarui password Anda secara berkala untuk menjaga keamanan akun portal pendaftaran.</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-100 shadow-sm" data-aos="fade-up">
                <form action="{{ route('student.settings.update-password') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Current Password -->
                    <x-form-input
                        type="password"
                        name="current_password"
                        id="current_password"
                        label="Password Saat Ini"
                        icon="key-round"
                        placeholder="Masukkan password saat ini..."
                        required />

                    <!-- New Password -->
                    <x-form-input
                        type="password"
                        name="password"
                        id="password"
                        label="Password Baru"
                        icon="lock"
                        placeholder="Minimal 8 karakter..."
                        required />

                    <!-- Confirm Password -->
                    <x-form-input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        label="Konfirmasi Password Baru"
                        icon="check-square"
                        placeholder="Ulangi password baru..."
                        required />

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full sm:w-auto px-8 py-3.5 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 transition-all shadow-xl shadow-green-900/20 border border-green-800">
                            SIMPAN PERUBAHAN
                        </button>
                    </div>
                </form>
            </div>

        </main>
    </div>
    
    <x-footer></x-footer>
</x-layout>
