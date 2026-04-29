<x-layout title="Status Pendaftaran">
    <div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-full sm:mx-auto md:mx-28">
            
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
                            <circle cx="50%" cy="50%" r="45%" class="fill-none stroke-green-600 stroke-[12] transition-all duration-1000" style="stroke-dasharray: 283; stroke-dashoffset: {{ 283 - (283 * $progress / 100) }};"></circle>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-4xl font-black text-green-950">{{ $progress }}%</span>
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Progres</span>
                        </div>
                    </div>

                    <div class="text-center md:text-left flex-1">
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 {{ $registration && $registration->status == 'verified' ? 'bg-emerald-100 text-emerald-800' : 'bg-yellow-500 text-green-950' }} rounded-lg text-[10px] font-black uppercase tracking-widest mb-6">
                            @if(!$registration || $registration->status != 'verified')
                                <span class="size-2 bg-green-950 rounded-lg animate-ping"></span>
                            @endif
                            {{ $registration ? ($registration->status == 'verified' ? 'Pendaftaran Diterima' : 'Tahap Verifikasi Dokumen') : 'Belum Mendaftar' }}
                        </div>
                        <h2 class="text-3xl font-black text-green-950 leading-tight mb-4">
                            {{ $registration ? ($registration->status == 'verified' ? 'Selamat! Anda Diterima' : 'Berkas Sedang Ditinjau') : 'Ayo Mulai Mendaftar' }}
                        </h2>
                        <p class="text-slate-600 leading-relaxed max-w-md">
                            {{ $registration ? ($registration->status == 'verified' ? 'Proses verifikasi dokumen Anda telah selesai. Silakan tunggu pengumuman jadwal ujian seleksi.' : 'Panitia sedang memeriksa keabsahan dokumen yang Anda unggah. Proses ini biasanya memakan waktu 1-3 hari kerja. Harap periksa portal atau email Anda secara berkala.') : 'Silakan isi formulir pendaftaran dan unggah dokumen pendukung untuk memulai proses seleksi.' }}
                        </p>
                    </div>
                </div>

                {{-- Status Meta --}}
                <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-6 pt-10 border-t border-slate-100">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">ID Pendaftaran</p>
                        <p class="font-bold text-green-950">{{ $registration ? '#REG-'.date('Y').'-'.str_pad($registration->id, 6, '0', STR_PAD_LEFT) : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Jurusan Utama</p>
                        <p class="font-bold text-green-950">{{ $registration && $registration->jurusan ? $registration->jurusan->nama_jurusan : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal Update</p>
                        <p class="font-bold text-green-950">{{ $registration ? \Carbon\Carbon::parse($registration->updated_at)->format('d F Y, H:i') . ' WIB' : '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Timeline Section -->
            <div class="bg-white rounded-lg p-8 md:p-10 border border-slate-100 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                <h3 class="font-black text-2xl text-green-950 mb-10">Riwayat Perjalanan</h3>
                
                <div class="relative space-y-12 before:absolute before:left-5 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-100">
                    @foreach($stages as $i => $stage)
                        @php
                            $isCompleted = false;
                            $isActive = false;
                            
                            switch($stage->key) {
                                case 'account':
                                    $isCompleted = true;
                                    break;
                                case 'form':
                                    $isCompleted = $registration != null;
                                    $isActive = !$isCompleted;
                                    break;
                                case 'verify':
                                    $isCompleted = $registration && $registration->status == 'verified';
                                    $isActive = $registration && $registration->status != 'verified' && $registration->status != 'rejected';
                                    break;
                                case 'selection':
                                    $isCompleted = $registration && $registration->status == 'selection_passed';
                                    $isActive = $registration && $registration->status == 'verified';
                                    break;
                                case 'announce':
                                    $isCompleted = $registration && $registration->status == 'accepted';
                                    $isActive = $registration && $registration->status == 'selection_passed';
                                    break;
                            }
                        @endphp

                        <div class="relative pl-14 {{ !$isCompleted && !$isActive ? 'opacity-40' : '' }}">
                            <div @class([
                                'absolute left-0 top-0 size-10 rounded-lg flex items-center justify-center shadow-lg z-10 border-4 border-white',
                                'bg-green-900 text-white shadow-green-900/20' => $isCompleted,
                                'bg-yellow-500 text-green-950 shadow-yellow-500/20' => $isActive,
                                'bg-slate-100 text-slate-400' => !$isCompleted && !$isActive,
                            ])>
                                <iconify-icon icon="{{ $isCompleted ? 'lucide:check' : ($isActive ? 'lucide:loader-2' : 'lucide:circle') }}" 
                                    @class(['text-xl', 'animate-spin' => $isActive])></iconify-icon>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-1">
                                <h4 @class([
                                    'text-lg font-black',
                                    'text-green-950' => $isCompleted || $isActive,
                                    'text-slate-400' => !$isCompleted && !$isActive,
                                ])>{{ $stage->label }}</h4>
                                
                                @if($isCompleted)
                                    <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-lg uppercase tracking-wider">Selesai</span>
                                @elseif($isActive)
                                    <span class="text-xs font-bold text-yellow-600 bg-yellow-50 px-2 py-1 rounded-lg uppercase tracking-wider italic animate-pulse">Sedang Berjalan</span>
                                @else
                                    <span class="text-xs font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-lg uppercase tracking-wider">Belum</span>
                                @endif
                            </div>
                            <p @class([
                                'text-sm mb-2',
                                'text-slate-500' => $isCompleted || $isActive,
                                'text-slate-400 italic' => !$isCompleted && !$isActive,
                            ])>
                                {{ $stage->description }}
                            </p>
                            @if($stage->start_date && $stage->end_date)
                            <div class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-50 w-fit px-2 py-1 rounded">
                                <iconify-icon icon="lucide:calendar"></iconify-icon>
                                <span>{{ \Carbon\Carbon::parse($stage->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($stage->end_date)->format('d M Y') }}</span>
                            </div>
                            @endif
                        </div>
                    @endforeach
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
    <x-footer></x-footer>
</x-layout>
