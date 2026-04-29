<x-admin-layout title="Detail Pendaftar" :breadcrumbs="[
    ['label' => 'Pendaftaran', 'url' => route('admin.registrations.index')],
    ['label' => 'Detail Siswa']
]">
    <div class="space-y-6">
        {{-- Header Detail --}}
        <div class="bg-emerald-900 rounded-sm p-8 text-white relative overflow-hidden shadow-sm">
            <div class="absolute inset-0 opacity-10 pointer-events-none mix-blend-overlay"
                style="background-color: #064e3b"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div class="size-20 rounded-sm bg-yellow-500 text-green-950 flex items-center justify-center font-black text-3xl shadow-xl shadow-yellow-500/20">
                        {{ substr($registration->nama_lengkap, 0, 1) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <h2 class="text-3xl font-black uppercase tracking-tight">{{ $registration->nama_lengkap }}</h2>
                            <span class="px-2.5 py-1 rounded-sm text-[10px] font-black uppercase tracking-widest bg-emerald-800 text-emerald-100 border border-emerald-700">
                                {{ $registration->nisn }}
                            </span>
                        </div>
                        <p class="text-emerald-100/70 font-medium text-sm flex items-center gap-2">
                            <iconify-icon icon="lucide:school"></iconify-icon>
                            Asal Sekolah: <strong class="text-white uppercase tracking-tight">{{ $registration->asal_sekolah }}</strong>
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    @if($registration->status == 'pending')
                        <form action="{{ route('admin.registrations.update-status', $registration->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="verified">
                            <button type="submit" class="px-6 py-2.5 bg-yellow-500 hover:bg-yellow-400 text-green-950 font-black text-sm rounded-sm transition-all shadow-lg shadow-yellow-500/20 flex items-center gap-2">
                                <iconify-icon icon="lucide:check-square"></iconify-icon> TERIMA PENDAFTARAN
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            {{-- Bagian Kiri: Data Pendaftaran --}}
            <div class="xl:col-span-2 space-y-6">
                {{-- Data Pribadi --}}
                <div class="bg-white p-6 rounded-sm border border-slate-100 shadow-sm">
                    <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2 border-b border-slate-100 pb-3">
                        <iconify-icon icon="lucide:user" class="text-lg"></iconify-icon> Informasi Pribadi
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                        <div class="md:col-span-2">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jurusan Pilihan</p>
                            <p class="text-sm font-bold text-emerald-700 mt-1 uppercase">{{ $registration->jurusan ? $registration->jurusan->nama_jurusan : 'Belum Memilih' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis Kelamin</p>
                            <p class="text-sm font-bold text-slate-800 mt-1">{{ $registration->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">NIK</p>
                            <p class="text-sm font-bold text-slate-800 mt-1">{{ $registration->nik }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tempat, Tanggal Lahir</p>
                            <p class="text-sm font-bold text-slate-800 mt-1">{{ $registration->tempat_lahir }}, {{ \Carbon\Carbon::parse($registration->tanggal_lahir)->format('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Agama</p>
                            <p class="text-sm font-bold text-slate-800 mt-1">{{ $registration->agama }}</p>
                        </div>
                        <div class="md:col-span-2 mt-2">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Alamat Lengkap</p>
                            <p class="text-sm font-bold text-slate-800 mt-1">{{ $registration->alamat }} RT {{ $registration->rt }}/RW {{ $registration->rw }}, Kel. {{ $registration->kelurahan }}, Kec. {{ $registration->kecamatan }}, {{ $registration->kode_pos }}</p>
                        </div>
                    </div>
                </div>

                {{-- Data Fisik & Jarak --}}
                <div class="bg-white p-6 rounded-sm border border-slate-100 shadow-sm">
                    <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2 border-b border-slate-100 pb-3">
                        <iconify-icon icon="lucide:ruler" class="text-lg"></iconify-icon> Fisik & Jarak Tempuh
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-slate-50 p-4 rounded-sm border border-slate-100 text-center">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tinggi</p>
                            <p class="text-xl font-black text-green-950 mt-1">{{ $registration->tinggi_badan }} <span class="text-xs text-slate-400 font-bold">cm</span></p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-sm border border-slate-100 text-center">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Berat</p>
                            <p class="text-xl font-black text-green-950 mt-1">{{ $registration->berat_badan }} <span class="text-xs text-slate-400 font-bold">kg</span></p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-sm border border-slate-100 text-center">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jarak</p>
                            <p class="text-xl font-black text-green-950 mt-1">{{ $registration->jarak_sekolah }} <span class="text-xs text-slate-400 font-bold">km</span></p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-sm border border-slate-100 text-center">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Waktu</p>
                            <p class="text-xl font-black text-green-950 mt-1">{{ $registration->waktu_jam }}h {{ $registration->waktu_menit }}m</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Kanan: Dokumen Unggahan --}}
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-sm border border-slate-100 shadow-sm sticky top-6">
                    <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2 border-b border-slate-100 pb-3">
                        <iconify-icon icon="lucide:folder-check" class="text-lg"></iconify-icon> Verifikasi Dokumen
                    </h3>

                    <div class="space-y-4">
                        @foreach($documentTypes as $type => $label)
                            @php
                                $doc = $registration->user->documents->where('document_type', $type)->first();
                            @endphp
                            <div class="p-4 rounded-sm border {{ $doc ? 'border-emerald-100 bg-emerald-50/30' : 'border-slate-100 bg-slate-50' }}">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <p class="text-xs font-black text-slate-700 uppercase tracking-tight">{{ $label }}</p>
                                        @if($doc)
                                            <p class="text-[10px] font-bold uppercase tracking-widest mt-1 {{ $doc->status == 'verified' ? 'text-emerald-600' : ($doc->status == 'rejected' ? 'text-red-500' : 'text-yellow-600') }}">
                                                STATUS: {{ $doc->status }}
                                            </p>
                                        @else
                                            <p class="text-[10px] font-bold text-red-500 uppercase tracking-widest mt-1">BELUM DIUNGGAH</p>
                                        @endif
                                    </div>
                                    @if($doc)
                                        <a href="{{ $doc->file_url }}" target="_blank" class="p-1.5 bg-white text-emerald-600 rounded-sm shadow-sm hover:bg-emerald-600 hover:text-white transition-all">
                                            <iconify-icon icon="lucide:external-link" class="text-sm"></iconify-icon>
                                        </a>
                                    @endif
                                </div>

                                @if($doc && $doc->status == 'pending')
                                    <div class="flex gap-2 mt-4 pt-4 border-t border-emerald-100">
                                        <form action="{{ route('admin.documents.update-status', $doc->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="verified">
                                            <button type="submit" class="w-full py-1.5 bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-sm hover:bg-emerald-700 transition-all">
                                                TERIMA
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.documents.update-status', $doc->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="w-full py-1.5 bg-red-100 text-red-600 text-[10px] font-black uppercase tracking-widest rounded-sm hover:bg-red-200 transition-all">
                                                TOLAK
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
