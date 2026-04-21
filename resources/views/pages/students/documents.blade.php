<x-layout title="Dokumen Pendaftaran">
    <div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            
            {{-- Header --}}
            <div class="mb-10" data-aos="fade-down">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-green-100 text-green-800 text-xs font-black mb-4 border border-green-200 uppercase tracking-widest">
                    DOCUMENTS VERIFICATION
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-green-950 tracking-tight leading-tight">Dokumen Persyaratan</h1>
                <p class="mt-2 text-slate-500 text-lg">Unggah dokumen pendukung untuk memverifikasi data pendaftaran Anda.</p>
            </div>

            <div class="grid grid-cols-1 gap-6">
                <!-- Document Cards -->
                @php
                    $docs = [
                        [
                            'id' => 'ijazah',
                            'name' => 'Ijazah Terakhir',
                            'status' => 'Pending',
                            'desc' => 'Scan Ijazah asli bagian depan dan belakang.',
                            'icon' => 'file-text',
                        ],
                        [
                            'id' => 'skhun',
                            'name' => 'SKHUN / Surat Keterangan Lulus',
                            'status' => 'Uploaded',
                            'desc' => 'Scan asli atau fotokopi legalisir.',
                            'icon' => 'file-check',
                        ],
                        [
                            'id' => 'kk',
                            'name' => 'Kartu Keluarga',
                            'status' => 'Uploaded',
                            'desc' => 'Scan asli Kartu Keluarga terbaru.',
                            'icon' => 'users',
                        ],
                        [
                            'id' => 'akta',
                            'name' => 'Akta Kelahiran',
                            'status' => 'Pending',
                            'desc' => 'Scan asli Akta Kelahiran.',
                            'icon' => 'file-digit',
                        ],
                        [
                            'id' => 'pasfoto',
                            'name' => 'Pas Foto 3x4',
                            'status' => 'Pending',
                            'desc' => 'Foto terbaru dengan latar belakang merah.',
                            'icon' => 'image',
                        ],
                    ];
                @endphp

                @foreach ($docs as $index => $doc)
                    <div
                        class="group bg-white p-6 rounded-lg shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-6 transition-all hover:shadow-xl hover:shadow-slate-200 hover:-translate-y-1"
                        data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                        <div class="flex gap-6">
                            <div @class([
                                'size-16 rounded-lg flex items-center justify-center shrink-0 shadow-lg',
                                'bg-green-900 text-white shadow-green-900/20' => $doc['status'] == 'Uploaded',
                                'bg-yellow-500 text-green-950 shadow-yellow-500/20' => $doc['status'] == 'Pending',
                            ])>
                                <iconify-icon icon="lucide:{{ $doc['status'] == 'Uploaded' ? 'check-circle' : 'upload' }}"
                                    class="text-3xl"></iconify-icon>
                            </div>
                            <div>
                                <h3 class="font-black text-xl text-green-950 mb-1">{{ $doc['name'] }}</h3>
                                <p class="text-sm text-slate-500 max-w-xs">{{ $doc['desc'] }}</p>
                                <div class="mt-3 flex items-center gap-3">
                                    <span @class([
                                        'px-2 py-0.5 rounded-lg text-[10px] font-black uppercase tracking-widest',
                                        'bg-green-100 text-green-700' => $doc['status'] == 'Uploaded',
                                        'bg-yellow-100 text-yellow-700' => $doc['status'] == 'Pending',
                                    ])>
                                        {{ $doc['status'] == 'Uploaded' ? 'VERIFIED' : 'WAITING UPLOAD' }}
                                    </span>
                                    @if ($doc['status'] == 'Uploaded')
                                        <span class="text-[10px] font-bold text-slate-400 uppercase italic">Diunggah 2 jam lalu</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            @if ($doc['status'] == 'Uploaded')
                                <button
                                    class="px-5 py-2.5 text-sm font-black text-green-900 bg-white border-2 border-green-900/10 hover:bg-slate-50 rounded-lg transition-all flex items-center gap-2">
                                    <iconify-icon icon="lucide:eye" class="text-lg"></iconify-icon> PREVIEW
                                </button>
                            @endif
                            <button
                                class="px-8 py-2.5 text-sm font-black bg-green-900 text-white rounded-lg shadow-xl shadow-green-900/20 hover:bg-green-800 transition-all flex items-center gap-2">
                                <iconify-icon icon="lucide:{{ $doc['status'] == 'Uploaded' ? 'refresh-cw' : 'plus-circle' }}" class="text-lg"></iconify-icon>
                                {{ $doc['status'] == 'Uploaded' ? 'GANTI' : 'UNGGAH' }}
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Important Note -->
            <div class="mt-12 bg-green-900 rounded-lg p-8 text-white relative overflow-hidden" data-aos="zoom-in">
                {{-- Batik Pattern --}}
                <div class="absolute inset-0 opacity-5 pointer-events-none mix-blend-overlay"
                    style="background-image: url('{{ asset('batik-pattern.png') }}'); background-size: 200px; background-repeat: repeat;">
                </div>
                
                <div class="relative z-10 flex gap-6">
                    <div class="size-12 bg-white/20 rounded-lg flex items-center justify-center shrink-0">
                        <iconify-icon icon="lucide:alert-triangle" class="text-2xl text-yellow-500"></iconify-icon>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-white mb-2 uppercase tracking-wide">Pemberitahuan Penting</h4>
                        <p class="text-green-100/70 text-sm leading-relaxed">
                            Pastikan semua dokumen yang diunggah terbaca dengan jelas (tidak buram/gelap). Format yang diizinkan adalah <span class="text-yellow-500 font-bold">PDF, JPG, atau PNG</span> dengan ukuran file maksimal <span class="text-yellow-500 font-bold">2MB</span> per dokumen. Dokumen yang tidak terbaca akan menghambat proses verifikasi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
