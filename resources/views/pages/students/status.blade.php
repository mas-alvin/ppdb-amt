<x-layout title="Status Pendaftaran">
    <div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            
            {{-- Header --}}
            <div class="mb-12" data-aos="fade-down">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-green-100 text-green-800 text-xs font-black mb-4 border border-green-200">
                    REGISTRATION TRACKING
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-green-950 tracking-tight leading-tight">Status Pendaftaran</h1>
                <p class="mt-2 text-slate-500 text-lg">Pantau perkembangan proses seleksi Anda secara real-time.</p>
            </div>

            <!-- Main Status Card -->
            <div class="bg-white rounded-lg p-8 md:p-12 shadow-2xl shadow-slate-200 border border-slate-100 mb-10 overflow-hidden relative" data-aos="fade-up">
                
                <div class="flex flex-col md:flex-row items-center gap-10 relative z-10">
                    {{-- Circular Progress --}}
                    <div class="relative size-40 md:size-48 flex items-center justify-center shrink-0">
                        <svg class="size-full -rotate-90">
                            <circle cx="50%" cy="50%" r="45%" class="fill-none stroke-slate-100 stroke-[12]"></circle>
                            <circle cx="50%" cy="50%" r="45%" class="fill-none stroke-green-600 stroke-[12]" style="stroke-dasharray: 283; stroke-dashoffset: 155.65;"></circle>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-4xl font-black text-green-950">45%</span>
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Verified</span>
                        </div>
                    </div>

                    <div class="text-center md:text-left flex-1">
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-yellow-500 text-green-950 rounded-lg text-[10px] font-black uppercase tracking-widest mb-6">
                            <span class="size-2 bg-green-950 rounded-lg animate-ping"></span>
                            Tahap Verifikasi Dokumen
                        </div>
                        <h2 class="text-3xl font-black text-green-950 leading-tight mb-4">Berkas Sedang Ditinjau</h2>
                        <p class="text-slate-600 leading-relaxed max-w-md">
                            Panitia sedang memeriksa keabsahan dokumen yang Anda unggah. Proses ini biasanya memakan waktu 1-3 hari kerja. Harap periksa portal atau email Anda secara berkala.
                        </p>
                    </div>
                </div>

                {{-- Status Meta --}}
                <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-6 pt-10 border-t border-slate-100">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">ID Pendaftaran</p>
                        <p class="font-bold text-green-950">#REG-2026-000124</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Jurusan Utama</p>
                        <p class="font-bold text-green-950">Rekayasa Perangkat Lunak</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal Update</p>
                        <p class="font-bold text-green-950">20 April 2026, 09:12 WIB</p>
                    </div>
                </div>
            </div>

            <!-- Timeline Section -->
            <div class="bg-white rounded-lg p-8 md:p-10 border border-slate-100 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                <h3 class="font-black text-2xl text-green-950 mb-10">Riwayat Perjalanan</h3>
                
                <div class="relative space-y-12 before:absolute before:left-5 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-100">
                    
                    {{-- Step 1 (Completed) --}}
                    <div class="relative pl-14">
                        <div class="absolute left-0 top-0 size-10 rounded-lg bg-green-900 text-white flex items-center justify-center shadow-lg shadow-green-900/20 z-10 border-4 border-white">
                            <iconify-icon icon="lucide:check" class="text-xl"></iconify-icon>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-1">
                            <h4 class="text-lg font-black text-green-950">Pembuatan Akun Portal</h4>
                            <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-lg uppercase">Selesai</span>
                        </div>
                        <p class="text-slate-500 text-sm">Akun berhasil diverifikasi melalui email.</p>
                        <time class="text-[10px] font-black text-slate-300 uppercase mt-2 block">12 Mei 2026, 14:20</time>
                    </div>

                    {{-- Step 2 (Completed) --}}
                    <div class="relative pl-14">
                        <div class="absolute left-0 top-0 size-10 rounded-lg bg-green-900 text-white flex items-center justify-center shadow-lg shadow-green-900/20 z-10 border-4 border-white">
                            <iconify-icon icon="lucide:user-plus" class="text-xl"></iconify-icon>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-1">
                            <h4 class="text-lg font-black text-green-950">Pengisian Formulir Pendaftaran</h4>
                            <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-lg uppercase">Selesai</span>
                        </div>
                        <p class="text-slate-500 text-sm">Data pribadi, orang tua, dan dokumen pendukung berhasil dikirim.</p>
                        <time class="text-[10px] font-black text-slate-300 uppercase mt-2 block">13 Mei 2026, 09:45</time>
                    </div>

                    {{-- Step 3 (Active) --}}
                    <div class="relative pl-14">
                        <div class="absolute left-0 top-0 size-10 rounded-lg bg-yellow-500 text-green-950 flex items-center justify-center shadow-lg shadow-yellow-500/20 z-10 border-4 border-white">
                            <iconify-icon icon="lucide:loader-2" class="text-xl animate-spin"></iconify-icon>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-1">
                            <h4 class="text-lg font-black text-green-950">Verifikasi Berkas Kolektif</h4>
                            <span class="text-xs font-bold text-yellow-600 bg-yellow-50 px-2 py-1 rounded-lg uppercase italic">Sedang Berjalan</span>
                        </div>
                        <p class="text-slate-500 text-sm italic">Menunggu validasi oleh tim panitia PPDB SMK AL-MUJTAMA'.</p>
                    </div>

                    {{-- Step 4 (Future) --}}
                    <div class="relative pl-14 opacity-40">
                        <div class="absolute left-0 top-0 size-10 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center z-10 border-4 border-white">
                            <iconify-icon icon="lucide:star" class="text-xl"></iconify-icon>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-1">
                            <h4 class="text-lg font-black text-slate-400">Pengumuman Kelulusan</h4>
                            <span class="text-xs font-bold text-slate-300 bg-slate-50 px-2 py-1 rounded-lg uppercase">Mendatang</span>
                        </div>
                        <p class="text-slate-400 text-sm italic">Hasil seleksi akan diumumkan pada bulan Juli 2026.</p>
                    </div>

                </div>
            </div>

            <!-- Action Grid -->
            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 gap-4" data-aos="fade-up" data-aos-delay="200">
                <a href="/pendaftaran" class="p-6 bg-green-900 text-white rounded-lg font-black text-center hover:bg-green-800 transition-all shadow-xl shadow-green-900/20 flex flex-col items-center justify-center gap-3 group">
                    <iconify-icon icon="lucide:edit-3" class="text-3xl text-yellow-500 group-hover:scale-110 transition-transform"></iconify-icon>
                    <div>
                        <p class="text-lg">LENGKAPI DATA</p>
                        <p class="text-[10px] font-black text-green-400 uppercase tracking-widest">Update Informasi</p>
                    </div>
                </a>
                <a href="/dashboard" class="p-6 bg-white text-green-950 rounded-lg font-black text-center border-2 border-green-900/10 hover:bg-slate-50 transition-all flex flex-col items-center justify-center gap-3 group">
                    <iconify-icon icon="lucide:layout-dashboard" class="text-3xl text-green-900 group-hover:scale-110 transition-transform"></iconify-icon>
                    <div>
                        <p class="text-lg">DASHBOARD</p>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kembali ke Portal</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-layout>
