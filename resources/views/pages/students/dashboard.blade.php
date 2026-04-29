<x-layout title="Dashboard - Portal PPDB">
    <div class="min-h-screen bg-slate-50">
        <main class="relative max-w-auto px-4 sm:mx-auto md:mx-28 sm:px-6 lg:px-8 py-6 sm:py-8">

            <!-- Header -->
            <div class="mb-8 sm:mb-10 flex flex-col lg:flex-row lg:items-end justify-between gap-6">
                <div data-aos="fade-right">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-green-100 text-green-800 text-xs font-black mb-4 border border-green-200">
                        STUDENT PORTAL
                    </div>

                    <h2
                        class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-green-950 leading-tight">
                        Selamat Datang,
                        <br class="sm:hidden">
                        <span
                            class="text-transparent bg-clip-text bg-linear-to-r from-green-700 to-green-900">
                            {{ auth()->user()->name }}!
                        </span>
                    </h2>

                    <p class="text-slate-500 mt-3 text-sm sm:text-base lg:text-lg">
                        Kelola pendaftaran dan pantau status Anda di sini.
                    </p>
                </div>

                <div class="flex items-center gap-4" data-aos="fade-left">
                    <div class="flex items-center gap-3">
                        <div
                            class="size-12 rounded-lg bg-yellow-500 flex items-center justify-center text-green-950 shadow-lg shadow-yellow-500/20">
                            <iconify-icon icon="lucide:user" class="text-2xl"></iconify-icon>
                        </div>
                        <div class="text-right sm:block">
                            <p class="text-[10px] sm:text-xs font-black text-slate-400 uppercase tracking-widest">
                                No. Registrasi
                            </p>
                            <p class="text-base sm:text-lg font-bold text-green-900">
                                {{ $registration ? '#' . str_pad($registration->id, 6, '0', STR_PAD_LEFT) : 'Belum Terdaftar' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- Main Progress Card -->
                <div
                    class="lg:col-span-8 relative overflow-hidden bg-green-900 rounded-lg p-6 sm:p-8 text-white shadow-2xl shadow-green-900/20"
                    data-aos="fade-up">

                    <div class="relative z-10 flex flex-col h-full justify-between">

                        <div class="flex flex-col xl:flex-row justify-between gap-8 mb-10">
                            <div class="max-w-xl">
                                <h3 class="text-2xl sm:text-3xl font-black mb-4">
                                    {{ $progress == 100 ? 'Pendaftaran Selesai' : 'Selesaikan Pendaftaran Anda' }}
                                </h3>

                                <p class="text-green-100/80 leading-relaxed mb-6 text-sm sm:text-base">
                                    {{ $progress == 100 ? 'Terima kasih, berkas Anda sedang dalam proses verifikasi oleh tim pendaftaran.' : 'Dokumen pendaftaran Anda baru mencapai ' . $progress . '%. Segera lengkapi persyaratan untuk melanjutkan ke tahap verifikasi.' }}
                                </p>

                                @if($progress < 100)
                                <a href="{{ $registration ? route('student.documents.index') : route('student.pendaftaran.wizard') }}"
                                    class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-yellow-500 text-green-950 font-black hover:bg-yellow-400 transition-all shadow-xl shadow-yellow-500/20">
                                    LENGKAPI SEKARANG
                                    <iconify-icon icon="lucide:chevron-right"></iconify-icon>
                                </a>
                                @endif
                            </div>

                            <div class="flex items-center justify-center">
                                <div
                                    class="relative size-36 sm:size-44 md:size-48 flex items-center justify-center">
                                    <svg class="size-full -rotate-90">
                                        <circle cx="50%" cy="50%" r="45%"
                                            class="fill-none stroke-white/10 stroke-[10]"></circle>
                                        <circle cx="50%" cy="50%" r="45%"
                                            class="fill-none stroke-yellow-500 stroke-[10] transition-all duration-1000"
                                            style="stroke-dasharray: 283; stroke-dashoffset: {{ 283 - (283 * $progress / 100) }};">
                                        </circle>
                                    </svg>

                                    <div
                                        class="absolute inset-0 flex flex-col items-center justify-center">
                                        <span class="text-3xl sm:text-4xl font-black">
                                            {{ $progress }}%
                                        </span>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-widest text-yellow-500">
                                            Progress
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 pt-8 border-t border-white/10">

                            <div class="flex items-center gap-3 {{ $registration ? '' : 'text-white/50' }}">
                                <iconify-icon icon="{{ $registration ? 'lucide:check-circle' : 'lucide:circle' }}"
                                    class="{{ $registration ? 'text-yellow-500' : '' }} text-xl"></iconify-icon>
                                <span class="text-sm font-medium">
                                    Biodata Diri
                                </span>
                            </div>

                            <div class="flex items-center gap-3 {{ $progress > 50 ? '' : 'text-white/50' }}">
                                <iconify-icon icon="{{ $progress > 50 ? 'lucide:check-circle' : 'lucide:circle' }}"
                                    class="{{ $progress > 50 ? 'text-yellow-500' : '' }} text-xl"></iconify-icon>
                                <span class="text-sm font-medium">
                                    Dokumen Wajib
                                </span>
                            </div>

                            <div class="flex items-center gap-3 {{ $progress == 100 ? '' : 'text-white/50' }}">
                                <iconify-icon icon="{{ $progress == 100 ? 'lucide:check-circle' : 'lucide:circle' }}"
                                    class="{{ $progress == 100 ? 'text-yellow-500' : '' }} text-xl"></iconify-icon>
                                <span class="text-sm font-medium">
                                    Selesai
                                </span>
                            </div>

                            <div class="flex items-center gap-3 {{ $registration && $registration->status == 'verified' ? '' : 'text-white/50' }}">
                                <iconify-icon icon="{{ $registration && $registration->status == 'verified' ? 'lucide:check-circle' : 'lucide:circle' }}"
                                    class="{{ $registration && $registration->status == 'verified' ? 'text-yellow-500' : '' }} text-xl"></iconify-icon>
                                <span class="text-sm font-medium">
                                    Terverifikasi
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Ujian -->
                <div
                    class="lg:col-span-4 bg-yellow-500 rounded-lg p-6 sm:p-8 shadow-xl shadow-yellow-500/20 flex flex-col justify-between"
                    data-aos="fade-up"
                    data-aos-delay="100">

                    <div>
                        <div
                            class="size-12 bg-green-950 text-white rounded-lg flex items-center justify-center mb-6">
                            <iconify-icon icon="lucide:calendar"
                                class="text-2xl"></iconify-icon>
                        </div>

                        <h4 class="text-xl sm:text-2xl font-black text-green-950 mb-2">
                            Ujian Seleksi
                        </h4>

                        <p class="text-green-950/70 text-sm leading-relaxed">
                            Jadwal ujian seleksi Anda dijadwalkan pada:
                        </p>

                        <p class="text-2xl sm:text-3xl font-black text-green-950 mt-3">
                            15 Mei 2026
                        </p>
                    </div>

                    <div class="mt-8 pt-6 border-t border-green-950/10">
                        <p class="text-xs font-black text-green-950/60 uppercase">
                            Lokasi
                        </p>
                        <p class="font-bold text-green-950 mt-1">
                            Lab Komputer SMK AL-MUJTAMA'
                        </p>
                    </div>
                </div>

                <!-- Pengumuman -->
                <div
                    class="lg:col-span-12 bg-white rounded-lg p-6 sm:p-8 border border-slate-100 shadow-sm"
                    data-aos="fade-up"
                    data-aos-delay="200">

                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                        <h3 class="text-lg sm:text-xl font-black text-green-950">
                            Pengumuman Terbaru
                        </h3>

                        <a href="#"
                            class="text-sm font-bold text-green-700">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="space-y-6">
                        @forelse($announcements as $announcement)
                            <div class="flex gap-4">
                                <div
                                    @class([
                                        'size-10 rounded-lg flex items-center justify-center shrink-0',
                                        'bg-blue-50 text-blue-600' => $announcement->type == 'info',
                                        'bg-amber-50 text-amber-600' => $announcement->type == 'warning',
                                        'bg-red-50 text-red-600' => $announcement->type == 'danger',
                                    ])>
                                    <iconify-icon icon="lucide:{{ $announcement->type == 'info' ? 'megaphone' : ($announcement->type == 'warning' ? 'alert-triangle' : 'alert-circle') }}"
                                        class="text-xl"></iconify-icon>
                                </div>

                                <div>
                                    <h5 class="font-bold text-green-950">
                                        {{ $announcement->title }}
                                    </h5>

                                    <p class="text-sm text-slate-500 mt-1 leading-relaxed">
                                        {{ $announcement->content }}
                                    </p>

                                    <div class="flex items-center gap-4 mt-2">
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                                            {{ $announcement->created_at->diffForHumans() }}
                                        </p>
                                        @if($announcement->document_path)
                                        <a href="{{ Storage::url($announcement->document_path) }}" target="_blank" class="flex items-center gap-1.5 text-[10px] font-black text-green-700 uppercase tracking-widest hover:text-green-900">
                                            <iconify-icon icon="lucide:file-text"></iconify-icon>
                                            LIHAT DOKUMEN PDF
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-8 text-center bg-slate-50 rounded-xl border-2 border-dashed border-slate-200">
                                <iconify-icon icon="lucide:bell-off" class="text-3xl text-slate-300 mb-2"></iconify-icon>
                                <p class="text-sm font-bold text-slate-400">Belum ada pengumuman baru</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Logout?',
                text: "Anda akan keluar dari portal pendaftaran.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#064e3b',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'YA, KELUAR',
                cancelButtonText: 'BATAL'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            })
        }
    </script>

    <x-footer></x-footer>
</x-layout>