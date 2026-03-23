<x-layout title="Dashboard - Portal PPDB">
    <div class="min-h-screen bg-background-light dark:bg-background-dark">
        <!-- Main Content -->
        <main class="max-w-7xl mx-auto w-full p-8">
            <div class="mb-8">
                <h2 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">Halo, Budi Santoso!</h2>
                <p class="text-slate-500 mt-1">Selamat datang di portal pendaftaran sekolah kami.</p>
            </div>

            <!-- Bento Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Status Card (Circular Progress) -->
                <div
                    class="bg-white dark:bg-slate-900 p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col items-center justify-center">
                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-6">Status Pendaftaran
                    </h3>
                    <div class="relative size-40 circular-progress rounded-full flex items-center justify-center">
                        <div class="text-center">
                            <span class="text-3xl font-bold text-slate-900 dark:text-white">45%</span>
                            <p class="text-[10px] text-slate-400 uppercase font-bold">Lengkap</p>
                        </div>
                    </div>
                    <p class="mt-6 text-sm text-center text-slate-600 dark:text-slate-400">
                        Hampir setengah jalan! Selesaikan dokumen Anda segera.
                    </p>
                </div>
                <!-- Action Card -->
                <div
                    class="md:col-span-2 bg-primary rounded-xl p-8 flex flex-col justify-between text-white relative overflow-hidden shadow-lg shadow-primary/20">
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold mb-2">Lengkapi Formulir Pendaftaran</h3>
                        <p class="text-white/80 max-w-md">Lengkapi data diri, nilai rapor, dan unggah dokumen
                            persyaratan untuk melanjutkan ke tahap verifikasi.</p>
                    </div>
                    <div class="mt-8 relative z-10 flex items-center gap-4">
                        <a href="/pendaftaran"
                            class="bg-white text-primary px-6 py-3 rounded-lg font-bold flex items-center gap-2 hover:bg-slate-50 transition-colors">
                            Lanjutkan Sekarang
                            <iconify-icon icon="lucide:arrow-right" class="text-xl"></iconify-icon>
                        </a>
                        <div class="flex items-center gap-2 text-white/90 text-sm">
                            <iconify-icon icon="lucide:clock" class="text-base"></iconify-icon>
                            Batas waktu: 30 Juni 2024
                        </div>
                    </div>
                    <!-- Decorative Icon Background -->
                    <iconify-icon icon="lucide:edit-3"
                        class="absolute -right-4 -bottom-4 text-[180px] opacity-10 rotate-12"></iconify-icon>
                </div>
                <!-- News Widget -->
                <div
                    class="md:col-span-2 bg-white dark:bg-slate-900 p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-800">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-lg">Berita Terbaru</h3>
                        <a class="text-primary text-sm font-semibold hover:underline" href="#">Lihat Semua</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex gap-4 items-center group cursor-pointer">
                            <div class="size-16 rounded-lg bg-slate-200 shrink-0 overflow-hidden">
                                <div
                                    class="w-full h-full bg-linear-to-br from-primary/40 to-primary/10 flex items-center justify-center">
                                    <iconify-icon icon="lucide:megaphone" class="text-primary/60 text-2xl"></iconify-icon>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold group-hover:text-primary transition-colors">Jadwal Seleksi
                                    Gelombang 1 Diumumkan</h4>
                                <p class="text-xs text-slate-500 mt-1">Diposting 2 jam yang lalu • Pengumuman</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-center group cursor-pointer">
                            <div class="size-16 rounded-lg bg-slate-200 shrink-0 overflow-hidden">
                                <div
                                    class="w-full h-full bg-linear-to-br from-blue-400/40 to-blue-400/10 flex items-center justify-center">
                                    <iconify-icon icon="lucide:trophy" class="text-blue-500/60 text-2xl"></iconify-icon>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold group-hover:text-primary transition-colors">Prestasi Gemilang
                                    Tim Basket di Kompetisi Nasional</h4>
                                <p class="text-xs text-slate-500 mt-1">Diposting Kemarin • Ekstrakurikuler</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-center group cursor-pointer">
                            <div class="size-16 rounded-lg bg-slate-200 shrink-0 overflow-hidden">
                                <div
                                    class="w-full h-full bg-linear-to-br from-orange-400/40 to-orange-400/10 flex items-center justify-center">
                                    <iconify-icon icon="lucide:book-open" class="text-orange-500/60 text-2xl"></iconify-icon>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold group-hover:text-primary transition-colors">Beasiswa Jalur
                                    Prestasi Masih Dibuka</h4>
                                <p class="text-xs text-slate-500 mt-1">Diposting 2 hari yang lalu • Beasiswa</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Checklist/Summary Card -->
                <div
                    class="bg-white dark:bg-slate-900 p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-800">
                    <h3 class="font-bold text-lg mb-4">Daftar Tugas</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 text-primary">
                                <iconify-icon icon="lucide:check-circle-2" class="text-xl"></iconify-icon>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Buat Akun Portal</p>
                                <p class="text-xs text-slate-400">Selesai pada 12 Mei 2024</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 text-slate-300">
                                <iconify-icon icon="lucide:circle" class="text-xl"></iconify-icon>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Isi Data Orang Tua</p>
                                <p class="text-xs text-slate-400">Belum diisi</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 text-slate-300">
                                <iconify-icon icon="lucide:circle" class="text-xl"></iconify-icon>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Unggah Rapor Semester 1-5</p>
                                <p class="text-xs text-slate-400">Menunggu dokumen</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 text-slate-300">
                                <iconify-icon icon="lucide:circle" class="text-xl"></iconify-icon>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Pilih Jurusan Utama</p>
                                <p class="text-xs text-slate-400">Belum dipilih</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <style>
        .circular-progress {
            background: radial-gradient(closest-side, white 79%, transparent 80% 100%),
                conic-gradient(#10b77f 45%, #e2e8f0 0);
        }
    </style>
</x-layout>
