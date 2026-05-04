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

                    @if($registration)
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('student.pendaftaran.download') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-green-900 text-white text-[10px] sm:text-xs font-black uppercase tracking-widest hover:bg-green-800 transition-all shadow-xl shadow-green-900/10 border border-green-800">
                            <iconify-icon icon="lucide:file-down" class="text-base"></iconify-icon> 
                            UNDUH BUKTI PENDAFTARAN (PDF)
                        </a>
                        <a href="{{ route('student.status') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-white text-green-900 text-[10px] sm:text-xs font-black uppercase tracking-widest hover:bg-slate-50 transition-all border border-slate-200">
                            <iconify-icon icon="lucide:eye" class="text-base"></iconify-icon> 
                            LIHAT STATUS
                        </a>
                    </div>
                    @endif
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

                <!-- Sisa Kuota -->
                <div
                    class="lg:col-span-4 bg-white rounded-lg p-6 sm:p-8 border border-slate-100 shadow-sm flex flex-col justify-between"
                    data-aos="fade-up"
                    data-aos-delay="100">

                    <div>
                        <div
                            class="size-12 bg-green-900 text-white rounded-lg flex items-center justify-center mb-6 shadow-lg shadow-green-900/20">
                            <iconify-icon icon="lucide:users"
                                class="text-2xl"></iconify-icon>
                        </div>

                        <h4 class="text-xl sm:text-2xl font-black text-green-950 mb-2">
                            Sisa Kuota
                        </h4>

                        @if($activeWave)
                            <p class="text-slate-500 text-sm leading-relaxed mb-4">
                                Kesempatan pendaftaran untuk <span class="font-bold text-green-900 uppercase">{{ $activeWave->name }}</span>:
                            </p>

                            <div class="flex items-baseline gap-2">
                                <p class="text-4xl sm:text-5xl font-black text-green-900 mt-3">
                                    {{ $remainingQuota }}
                                </p>
                                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">
                                    / {{ $activeWave->quota }} Kursi
                                </p>
                            </div>
                        @else
                            <div class="py-4 px-6 bg-red-50 border border-red-100 rounded-lg">
                                <p class="text-sm font-bold text-red-600">Pendaftaran ditutup</p>
                                <p class="text-[10px] text-red-400 uppercase mt-1">Nantikan gelombang berikutnya</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">
                            Periode Aktif
                        </p>
                        <p class="font-bold text-green-950 mt-1 uppercase text-sm">
                            {{ $activeWave ? $activeWave->start_date->format('d M') . ' - ' . $activeWave->end_date->format('d M Y') : 'Tidak Ada' }}
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
                            Pengumuman Pendaftaran
                        </h3>

                        <div class="px-3 py-1 bg-slate-50 rounded-lg border border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            TOTAL {{ $announcements->count() }} PENGUMUMAN
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-h-[500px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-slate-200">
                        @forelse($announcements as $announcement)
                            <div class="flex gap-4 p-4 rounded-xl border border-slate-50 hover:border-green-100 hover:bg-green-50/30 transition-all">
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
                                    <h5 class="font-bold text-green-950 uppercase tracking-tight text-sm">
                                        {{ $announcement->title }}
                                    </h5>

                                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                        {{ $announcement->content }}
                                    </p>

                                    <div class="flex items-center gap-4 mt-3">
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                                            {{ $announcement->created_at->diffForHumans() }}
                                        </p>
                                        @if($announcement->document_path)
                                        <a href="{{ Storage::url($announcement->document_path) }}" target="_blank" class="flex items-center gap-1.5 text-[10px] font-black text-green-700 uppercase tracking-widest hover:text-green-900 bg-white px-2 py-1 rounded border border-green-100 shadow-sm">
                                            <iconify-icon icon="lucide:file-text"></iconify-icon>
                                            PDF
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 py-12 text-center bg-slate-50 rounded-xl border-2 border-dashed border-slate-200">
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