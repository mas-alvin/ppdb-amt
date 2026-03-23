<x-layout title="Dokumen Pendaftaran">
    <div class="min-h-screen bg-slate-50 dark:bg-background-dark py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Dokumen Persyaratan</h1>
                <p class="mt-2 text-slate-500">Unggah dokumen pendukung untuk memverifikasi data pendaftaran Anda.</p>
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
                        class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-6 transition-all hover:shadow-md">
                        <div class="flex gap-4">
                            <div @class([
                                'size-14 rounded-xl flex items-center justify-center shrink-0',
                                'bg-primary/10 text-primary' => $doc['status'] == 'Uploaded',
                                'bg-amber-100 text-amber-600' => $doc['status'] == 'Pending',
                            ])>
                                <iconify-icon icon="lucide:{{ $doc['status'] == 'Uploaded' ? 'check-circle-2' : 'clock' }}"
                                    class="text-3xl"></iconify-icon>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-slate-900 dark:text-white">{{ $doc['name'] }}</h3>
                                <p class="text-sm text-slate-500">{{ $doc['desc'] }}</p>
                                <div class="mt-2 flex items-center gap-2">
                                    <span @class([
                                        'px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider',
                                        'bg-emerald-100 text-emerald-600' => $doc['status'] == 'Uploaded',
                                        'bg-amber-100 text-amber-600' => $doc['status'] == 'Pending',
                                    ])>
                                        {{ $doc['status'] == 'Uploaded' ? 'Sudah Diunggah' : 'Belum Diunggah' }}
                                    </span>
                                    @if ($doc['status'] == 'Uploaded')
                                        <span class="text-[10px] text-slate-400">Diunggah pada 2 jam lalu</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            @if ($doc['status'] == 'Uploaded')
                                <button
                                    class="px-4 py-2 text-sm font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 transition-all flex items-center gap-2">
                                    <iconify-icon icon="lucide:eye" class="text-base"></iconify-icon> Lihat
                                </button>
                            @endif
                            <button
                                class="px-6 py-2 text-sm font-bold bg-primary text-white rounded-lg shadow-lg shadow-primary/20 hover:bg-emerald-600 transition-all flex items-center gap-2">
                                <iconify-icon icon="lucide:upload-cloud" class="text-base"></iconify-icon>
                                {{ $doc['status'] == 'Uploaded' ? 'Ganti' : 'Unggah' }}
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Warning Box -->
            <div
                class="mt-10 bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800 p-6 rounded-2xl flex gap-4">
                <iconify-icon icon="lucide:info" class="text-blue-500 text-2xl shrink-0"></iconify-icon>
                <p class="text-sm text-blue-800 dark:text-blue-300">
                    Pastikan semua dokumen yang diunggah terbaca dengan jelas. Format file yang didukung adalah PDF,
                    JPG, dan PNG dengan ukuran maksimal 2MB per file.
                </p>
            </div>
        </div>
    </div>
</x-layout>
