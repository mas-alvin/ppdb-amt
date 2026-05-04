<x-admin-layout title="Detail Pendaftar" :breadcrumbs="[
    ['label' => 'Pendaftaran', 'url' => route('admin.registrations.index')],
    ['label' => 'Detail Siswa']
]">
    <div class="space-y-6" x-data="{ tab: '{{ session('active_tab', 'identitas') }}' }">
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

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
            {{-- Tabs Navigation --}}
            <div class="xl:col-span-12">
                <div class="flex flex-wrap gap-2 p-1 bg-slate-100 rounded-sm border border-slate-200">
                    <button @click="tab = 'identitas'" :class="tab === 'identitas' ? 'bg-white text-green-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-6 py-2.5 text-xs font-black uppercase tracking-widest transition-all rounded-sm">IDENTITAS</button>
                    <button @click="tab = 'orangtua'" :class="tab === 'orangtua' ? 'bg-white text-green-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-6 py-2.5 text-xs font-black uppercase tracking-widest transition-all rounded-sm">ORANG TUA</button>
                    <button @click="tab = 'periodik'" :class="tab === 'periodik' ? 'bg-white text-green-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-6 py-2.5 text-xs font-black uppercase tracking-widest transition-all rounded-sm">PERIODIK</button>
                    <button @click="tab = 'prestasi'" :class="tab === 'prestasi' ? 'bg-white text-green-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-6 py-2.5 text-xs font-black uppercase tracking-widest transition-all rounded-sm">PRESTASI</button>
                    <button @click="tab = 'sekolah'" :class="tab === 'sekolah' ? 'bg-white text-green-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-6 py-2.5 text-xs font-black uppercase tracking-widest transition-all rounded-sm">SEKOLAH</button>
                    <button @click="tab = 'dokumen'" :class="tab === 'dokumen' ? 'bg-white text-green-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-6 py-2.5 text-xs font-black uppercase tracking-widest transition-all rounded-sm">DOKUMEN</button>
                </div>
            </div>

            {{-- Tab Content --}}
            <div class="xl:col-span-12">
                {{-- IDENTITAS --}}
                <div x-show="tab === 'identitas'" class="bg-white p-8 rounded-sm border border-slate-100 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Lengkap</p>
                            <p class="text-sm font-black text-slate-800 mt-1 uppercase">{{ $registration->nama_lengkap }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">NISN</p>
                            <p class="text-sm font-black text-slate-800 mt-1">{{ $registration->nisn }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">NIK</p>
                            <p class="text-sm font-black text-slate-800 mt-1">{{ $registration->nik }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tempat, Tgl Lahir</p>
                            <p class="text-sm font-black text-slate-800 mt-1 uppercase">{{ $registration->tempat_lahir }}, {{ $registration->tanggal_lahir }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis Kelamin</p>
                            <p class="text-sm font-black text-slate-800 mt-1 uppercase">{{ $registration->jenis_kelamin == 'L' ? 'LAKI-LAKI' : 'PEREMPUAN' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Agama</p>
                            <p class="text-sm font-black text-slate-800 mt-1 uppercase">{{ $registration->agama }}</p>
                        </div>
                        <div class="md:col-span-3">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Alamat</p>
                            <p class="text-sm font-black text-slate-800 mt-1 uppercase">{{ $registration->alamat }} RT {{ $registration->rt }} RW {{ $registration->rw }}, Kel. {{ $registration->kelurahan }}, Kec. {{ $registration->kecamatan }}, {{ $registration->kode_pos }}</p>
                        </div>
                    </div>
                </div>

                {{-- ORANG TUA --}}
                <div x-show="tab === 'orangtua'" class="bg-white p-8 rounded-sm border border-slate-100 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div class="space-y-6">
                            <h4 class="text-xs font-black text-green-900 uppercase tracking-[0.2em] border-b border-slate-100 pb-2">Data Ayah</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ayah_nama }}</p></div>
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">NIK</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ayah_nik }}</p></div>
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pendidikan</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ayah_pendidikan }}</p></div>
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pekerjaan</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ayah_pekerjaan }}</p></div>
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Penghasilan</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ayah_penghasilan }}</p></div>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <h4 class="text-xs font-black text-green-900 uppercase tracking-[0.2em] border-b border-slate-100 pb-2">Data Ibu</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ibu_nama }}</p></div>
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">NIK</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ibu_nik }}</p></div>
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pendidikan</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ibu_pendidikan }}</p></div>
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pekerjaan</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ibu_pekerjaan }}</p></div>
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Penghasilan</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ibu_penghasilan }}</p></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PERIODIK --}}
                <div x-show="tab === 'periodik'" class="bg-white p-8 rounded-sm border border-slate-100 shadow-sm">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tinggi Badan</p><p class="text-xl font-black text-slate-800">{{ $registration->tinggi_badan }} cm</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Berat Badan</p><p class="text-xl font-black text-slate-800">{{ $registration->berat_badan }} kg</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Lingkar Kepala</p><p class="text-xl font-black text-slate-800">{{ $registration->lingkar_kepala }} cm</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jumlah Saudara</p><p class="text-xl font-black text-slate-800">{{ $registration->jumlah_saudara }}</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jarak ke Sekolah</p><p class="text-sm font-black text-slate-800">{{ $registration->jarak_sekolah }} KM</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Waktu Tempuh</p><p class="text-sm font-black text-slate-800">{{ $registration->waktu_jam }} jam {{ $registration->waktu_menit }} menit</p></div>
                    </div>
                </div>

                {{-- PRESTASI --}}
                <div x-show="tab === 'prestasi'" class="bg-white p-8 rounded-sm border border-slate-100 shadow-sm">
                    @if($registration->prestasi_nama)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Prestasi</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->prestasi_nama }}</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->prestasi_jenis }}</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tingkat</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->prestasi_tingkat }}</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tahun</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->prestasi_tahun }}</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Penyelenggara</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->prestasi_penyelenggara }}</p></div>
                    </div>
                    @else
                    <div class="text-center py-12 text-slate-400 italic">Tidak ada data prestasi yang diunggah.</div>
                    @endif
                </div>

                {{-- SEKOLAH --}}
                <div x-show="tab === 'sekolah'" class="bg-white p-8 rounded-sm border border-slate-100 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Asal Sekolah</p><p class="text-xl font-black text-slate-800 uppercase">{{ $registration->asal_sekolah }}</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">No UN / Ijazah</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->no_un ?? '-' }} / {{ $registration->no_ijazah ?? '-' }}</p></div>
                        <div class="md:col-span-2">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jurusan Pilihan</p>
                            <p class="text-2xl font-black text-green-900 uppercase mt-2">{{ $registration->jurusan->nama_jurusan ?? 'BELUM MEMILIH' }}</p>
                        </div>
                    </div>
                </div>

                {{-- DOKUMEN --}}
                <div x-show="tab === 'dokumen'" class="bg-white p-8 rounded-sm border border-slate-100 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
