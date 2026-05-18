<x-layout-public>
    <x-navbar-public />

    {{-- Hero Section --}}
    <section class="relative py-20 overflow-hidden bg-green-900 text-white">
        <div class="absolute inset-0 opacity-10 pointer-events-none"
            style="background-image: url('{{ asset('bg-amt.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center center;">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-black mb-4">Informasi Pendaftaran</h1>
            <p class="text-lg text-white/80 max-w-2xl mx-auto">
                Temukan informasi lengkap mengenai alur, syarat, dan jadwal pendaftaran peserta didik baru SMK Al-Mujtama'.
            </p>
        </div>
    </section>

    {{-- Alur Pendaftaran --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-sm font-black text-yellow-600 uppercase tracking-[0.3em] mb-4">Alur Pendaftaran</h2>
                <h3 class="text-3xl font-black text-green-950 mb-6">Langkah Mudah Mendaftar</h3>
                <p class="text-slate-600 text-lg">
                    Ikuti langkah-langkah berikut untuk menjadi bagian dari keluarga besar SMK Al-Mujtama'.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                {{-- Step 1 --}}
                <div class="relative text-center">
                    <div class="size-16 rounded-full bg-green-900 text-white flex items-center justify-center text-2xl font-bold mx-auto mb-6 shadow-lg shadow-green-900/20">
                        1
                    </div>
                    <h4 class="text-xl font-bold text-green-950 mb-2">Buat Akun</h4>
                    <p class="text-slate-600 text-sm">Calon siswa membuat akun pendaftaran di website PPDB ini.</p>
                    {{-- Connector --}}
                    <div class="hidden md:block absolute top-8 left-[60%] right-0 h-0.5 bg-slate-200"></div>
                </div>

                {{-- Step 2 --}}
                <div class="relative text-center">
                    <div class="size-16 rounded-full bg-green-900 text-white flex items-center justify-center text-2xl font-bold mx-auto mb-6 shadow-lg shadow-green-900/20">
                        2
                    </div>
                    <h4 class="text-xl font-bold text-green-950 mb-2">Isi Formulir</h4>
                    <p class="text-slate-600 text-sm">Melengkapi data diri, data orang tua, dan nilai rapor.</p>
                    {{-- Connector --}}
                    <div class="hidden md:block absolute top-8 left-[60%] right-0 h-0.5 bg-slate-200"></div>
                </div>

                {{-- Step 3 --}}
                <div class="relative text-center">
                    <div class="size-16 rounded-full bg-green-900 text-white flex items-center justify-center text-2xl font-bold mx-auto mb-6 shadow-lg shadow-green-900/20">
                        3
                    </div>
                    <h4 class="text-xl font-bold text-green-950 mb-2">Unggah Berkas</h4>
                    <p class="text-slate-600 text-sm">Mengunggah dokumen persyaratan seperti KK, Akta, dll.</p>
                    {{-- Connector --}}
                    <div class="hidden md:block absolute top-8 left-[60%] right-0 h-0.5 bg-slate-200"></div>
                </div>

                {{-- Step 4 --}}
                <div class="text-center">
                    <div class="size-16 rounded-full bg-yellow-500 text-green-950 flex items-center justify-center text-2xl font-bold mx-auto mb-6 shadow-lg shadow-yellow-500/20">
                        4
                    </div>
                    <h4 class="text-xl font-bold text-green-950 mb-2">Verifikasi</h4>
                    <p class="text-slate-600 text-sm">Menunggu panitia memverifikasi berkas dan mengumumkan hasil.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Syarat & Jadwal --}}
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                {{-- Syarat Pendaftaran --}}
                <div class="bg-white p-8 rounded-lg shadow-sm border border-slate-100">
                    <h3 class="text-2xl font-black text-green-950 mb-6 flex items-center gap-3">
                        <iconify-icon icon="lucide:file-check" class="text-green-900 text-3xl"></iconify-icon>
                        Syarat Pendaftaran
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-bold text-green-950 mb-2">Persyaratan Umum</h4>
                            <ul class="list-disc list-inside text-slate-600 text-sm space-y-1">
                                <li>Lulusan SMP/MTs sederajat.</li>
                                <li>Berusia maksimal 21 tahun pada awal tahun pelajaran baru.</li>
                                <li>Berkelakuan baik dan tidak terlibat narkoba.</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-bold text-green-950 mb-2">Dokumen yang Harus Diunggah</h4>
                            <ul class="list-disc list-inside text-slate-600 text-sm space-y-1">
                                <li>Scan Kartu Keluarga (KK).</li>
                                <li>Scan Akta Kelahiran.</li>
                                <li>Scan Rapor semester 1-5.</li>
                                <li>Pas foto terbaru ukuran 3x4.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Jadwal Pendaftaran --}}
                <div class="bg-white p-8 rounded-lg shadow-sm border border-slate-100">
                    <h3 class="text-2xl font-black text-green-950 mb-6 flex items-center gap-3">
                        <iconify-icon icon="lucide:calendar" class="text-green-900 text-3xl"></iconify-icon>
                        Jadwal Pendaftaran
                    </h3>
                    <div class="space-y-6">
                        @forelse($waves as $wave)
                        <div class="flex justify-between items-center border-b border-slate-100 pb-4">
                            <div>
                                <h4 class="font-bold text-green-950">{{ $wave->name }}</h4>
                                <p class="text-slate-500 text-sm">{{ $wave->description ?? 'Pendaftaran Online' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-green-900 font-bold">
                                    {{ $wave->start_date->translatedFormat('d F') }} - {{ $wave->end_date->translatedFormat('d F Y') }}
                                </p>
                                @if($wave->isOpen())
                                    <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-900 font-bold">Buka</span>
                                @elseif($wave->isClosed())
                                    <span class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-900 font-bold">Tutup</span>
                                @else
                                    <span class="text-xs px-2 py-1 rounded-full bg-slate-100 text-slate-500 font-bold">Belum Buka</span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-slate-500 py-4">
                            Belum ada jadwal pendaftaran yang diatur.
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    <section class="py-20 bg-green-900 text-white text-center">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-black mb-4">Siap Bergabung?</h3>
            <p class="text-white/80 mb-8">Daftarkan dirimu sekarang juga dan raih masa depan gemilang bersama SMK Al-Mujtama'.</p>
            <a href="/register" class="inline-block px-8 py-4 rounded-lg bg-yellow-500 hover:bg-yellow-400 text-green-950 font-black text-lg transition-all shadow-xl shadow-yellow-500/30 hover:-translate-y-1">
                Mulai Pendaftaran
            </a>
        </div>
    </section>
</x-layout-public>
