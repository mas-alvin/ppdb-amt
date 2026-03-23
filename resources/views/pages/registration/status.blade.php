<x-layout title="Status Pendaftaran">
    <div class="min-h-screen bg-slate-50 dark:bg-background-dark py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-10 text-center">
                <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Status Pendaftaran</h1>
                <p class="mt-2 text-slate-500">Pantau perkembangan proses seleksi Anda di sini.</p>
            </div>

            <!-- Status Card -->
            <div
                class="bg-white dark:bg-slate-900 rounded-3xl p-8 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 mb-8 overflow-hidden relative">
                <!-- Decorative background -->
                <div class="absolute top-0 right-0 p-8 opacity-5">
                    <iconify-icon icon="lucide:verified" class="text-[120px]"></iconify-icon>
                </div>

                <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
                    <div class="relative size-32">
                        <svg class="size-full" viewBox="0 0 36 36">
                            <path class="text-slate-100 dark:text-slate-800" stroke-width="3" stroke="currentColor"
                                fill="none"
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="text-primary" stroke-dasharray="45, 100" stroke-width="3"
                                stroke-linecap="round" stroke="currentColor" fill="none"
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-2xl font-black text-slate-900 dark:text-white">45%</span>
                            <span class="text-[8px] uppercase font-bold text-slate-400">Lengkap</span>
                        </div>
                    </div>
                    <div class="text-center md:text-left">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 bg-amber-100 text-amber-600 rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                            <span class="size-2 bg-amber-500 rounded-full animate-pulse"></span>
                            Tahap Verifikasi Dokumen
                        </div>
                        <h2 class="text-2xl font-black text-slate-900 dark:text-white leading-tight">Proses Sedang
                            Berjalan</h2>
                        <p class="text-slate-500 mt-2 max-w-md">Panitia sedang memeriksa kelengkapan dokumen yang Anda
                            unggah. Harap periksa email secara berkala untuk informasi lebih lanjut.</p>
                    </div>
                </div>
            </div>

            <!-- Timeline -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-100 dark:border-slate-800">
                <h3 class="font-black text-xl mb-8">Riwayat Pendaftaran</h3>
                <div
                    class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-linear-to-b before:from-primary before:via-slate-200 before:to-slate-200">

                    <!-- Item 1 -->
                    <div
                        class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-primary text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 transition-all">
                            <iconify-icon icon="lucide:check" class="text-xl"></iconify-icon>
                        </div>
                        <div
                            class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-4 rounded-xl bg-slate-50 dark:bg-slate-800 transition-all hover:bg-slate-100">
                            <div class="flex items-center justify-between space-x-2 mb-1">
                                <div class="font-bold text-slate-900 dark:text-white">Pembuatan Akun</div>
                                <time class="font-medium text-xs text-primary">12 Mei 2024</time>
                            </div>
                            <div class="text-slate-500 text-sm">Akun portal PPDB berhasil dibuat.</div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div
                        class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-primary text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 transition-all">
                            <iconify-icon icon="lucide:user" class="text-xl"></iconify-icon>
                        </div>
                        <div
                            class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-4 rounded-xl bg-slate-50 dark:bg-slate-800 transition-all hover:bg-slate-100">
                            <div class="flex items-center justify-between space-x-2 mb-1">
                                <div class="font-bold text-slate-900 dark:text-white">Pengisian Formulir</div>
                                <time class="font-medium text-xs text-primary">13 Mei 2024</time>
                            </div>
                            <div class="text-slate-500 text-sm">Data pribadi dan orang tua telah dilengkapi.</div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div
                        class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-slate-200 text-slate-400 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 transition-all">
                            <iconify-icon icon="lucide:file-text" class="text-xl"></iconify-icon>
                        </div>
                        <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-4 rounded-xl transition-all">
                            <div class="flex items-center justify-between space-x-2 mb-1">
                                <div class="font-bold text-slate-400">Verifikasi Berkas</div>
                                <time class="font-medium text-xs text-slate-400">Sedang Proses</time>
                            </div>
                            <div class="text-slate-400 text-sm">Menunggu pengecekan dokumen oleh admin.</div>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div
                        class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group text-slate-300">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-slate-100 text-slate-300 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2">
                            <iconify-icon icon="lucide:star" class="text-xl"></iconify-icon>
                        </div>
                        <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-4 rounded-xl">
                            <div class="flex items-center justify-between space-x-2 mb-1">
                                <div class="font-bold">Pengumuman Hasil</div>
                                <time class="font-medium text-xs">Juli 2024</time>
                            </div>
                            <div class="text-sm italic">Tahap belum dimulai.</div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-4">
                <a href="/pendaftaran"
                    class="flex-1 px-8 py-4 bg-primary text-white text-center rounded-2xl font-bold shadow-lg shadow-primary/20 hover:bg-emerald-600 transition-all flex items-center justify-center gap-2">
                    <iconify-icon icon="lucide:edit-3" class="text-xl"></iconify-icon> Lengkapi Data
                </a>
                <a href="/dashboard"
                    class="flex-1 px-8 py-4 bg-white dark:bg-slate-900 text-slate-700 dark:text-white text-center rounded-2xl font-bold border border-slate-200 dark:border-slate-800 hover:bg-slate-50 transition-all flex items-center justify-center gap-2">
                    <iconify-icon icon="lucide:layout-dashboard" class="text-xl"></iconify-icon> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</x-layout>
