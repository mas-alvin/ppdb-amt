<x-admin-layout title="Detail Pendaftar" :breadcrumbs="[
    ['label' => 'Pendaftaran', 'url' => route('admin.registrations.index')],
    ['label' => 'Detail Siswa']
]">
    <div class="space-y-4 md:space-y-6" x-data="{ tab: '{{ session('active_tab', 'identitas') }}', rejectModalOpen: false }">
        {{-- Header Detail --}}
        <div class="bg-emerald-900 rounded-sm p-4 sm:p-6 md:p-8 text-white relative overflow-hidden shadow-sm">
            <div class="absolute inset-0 opacity-10 pointer-events-none mix-blend-overlay"
                style="background-color: #064e3b"></div>
            
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6">
                    <div class="size-16 sm:size-20 shrink-0 rounded-sm bg-yellow-500 text-green-950 flex items-center justify-center font-black text-2xl sm:text-3xl shadow-xl shadow-yellow-500/20">
                        {{ substr($registration->nama_lengkap, 0, 1) }}
                    </div>
                    <div class="space-y-1.5 w-full">
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <h2 class="text-xl sm:text-2xl md:text-3xl font-black uppercase tracking-tight break-all sm:break-normal">{{ $registration->nama_lengkap }}</h2>
                            <span class="px-2 py-0.5 rounded-sm text-[10px] font-black uppercase tracking-widest bg-emerald-800 text-emerald-100 border border-emerald-700">
                                {{ $registration->nisn }}
                            </span>
                            
                            @if($registration->status == 'verified')
                                <span class="px-2 py-0.5 rounded-sm text-[10px] font-black uppercase tracking-widest bg-green-600 text-white border border-green-500 flex items-center gap-1">
                                    <iconify-icon icon="lucide:check-circle"></iconify-icon> Lulus / Diterima
                                </span>
                            @elseif($registration->status == 'rejected')
                                <span class="px-2 py-0.5 rounded-sm text-[10px] font-black uppercase tracking-widest bg-red-600 text-white border border-red-500 flex items-center gap-1">
                                    <iconify-icon icon="lucide:x-circle"></iconify-icon> Ditolak
                                </span>
                            @else
                                <span class="px-2 py-0.5 rounded-sm text-[10px] font-black uppercase tracking-widest bg-yellow-500 text-green-950 border border-yellow-400 flex items-center gap-1">
                                    <iconify-icon icon="lucide:clock"></iconify-icon> Pending
                                </span>
                            @endif

                            @if($registration->is_synced_to_datacenter)
                                <span class="px-2 py-0.5 rounded-sm text-[10px] font-black uppercase tracking-widest bg-emerald-500 text-white border border-emerald-400 flex items-center gap-1">
                                    <iconify-icon icon="lucide:database"></iconify-icon> Tersinkron
                                </span>
                            @else
                                <span class="px-2 py-0.5 rounded-sm text-[10px] font-black uppercase tracking-widest bg-slate-700 text-slate-300 border border-slate-600 flex items-center gap-1">
                                    <iconify-icon icon="lucide:refresh-cw"></iconify-icon> Belum Sinkron
                                </span>
                            @endif
                        </div>
                        <p class="text-emerald-100/70 font-medium text-xs sm:text-sm flex items-center gap-2 flex-wrap">
                            <iconify-icon icon="lucide:school" class="shrink-0"></iconify-icon>
                            <span>Asal Sekolah: <strong class="text-white uppercase tracking-tight">{{ $registration->asal_sekolah }}</strong></span>
                        </p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 sm:gap-3 w-full lg:w-auto border-t border-emerald-800/60 lg:border-none pt-4 lg:pt-0">
                    @if($registration->status == 'pending')
                        <form action="{{ route('admin.registrations.update-status', $registration->id) }}" method="POST" class="w-full sm:w-auto" onsubmit="return confirmAccept(event, '{{ addslashes($registration->nama_lengkap) }}')">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="verified">
                            <button type="submit" class="w-full justify-center px-4 py-2.5 bg-yellow-500 hover:bg-yellow-400 text-green-950 font-black text-xs sm:text-sm rounded-lg transition-all shadow-lg shadow-yellow-500/20 flex items-center gap-2 active:scale-95">
                                <iconify-icon icon="lucide:check-circle" class="text-base"></iconify-icon> TERIMA PENDAFTARAN
                            </button>
                        </form>

                        <button @click="rejectModalOpen = true" type="button" class="w-full sm:w-auto justify-center px-4 py-2.5 bg-red-600 hover:bg-red-500 text-white font-black text-xs sm:text-sm rounded-lg transition-all shadow-lg shadow-red-600/20 flex items-center gap-2 active:scale-95">
                            <iconify-icon icon="lucide:x-circle" class="text-base"></iconify-icon> TOLAK PENDAFTARAN
                        </button>

                        <div x-show="rejectModalOpen" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-cloak>
                            
                            <div @click.away="rejectModalOpen = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden border border-red-100 mx-auto">
                                <div class="px-5 py-4 border-b border-red-50 bg-red-50/50 flex items-center justify-between text-left">
                                    <h3 class="text-xs sm:text-sm font-black text-red-700 uppercase tracking-widest flex items-center gap-2">
                                        <iconify-icon icon="lucide:alert-triangle" class="text-lg"></iconify-icon> Konfirmasi Penolakan
                                    </h3>
                                    <button @click="rejectModalOpen = false" type="button" class="text-red-400 hover:text-red-600">
                                        <iconify-icon icon="lucide:x" class="text-xl"></iconify-icon>
                                    </button>
                                </div>
                                
                                <div class="p-5 space-y-4 text-left">
                                    <p class="text-sm text-slate-600 leading-relaxed">
                                        Apakah Anda yakin ingin menolak pendaftaran calon siswa <strong class="text-slate-800 uppercase">{{ $registration->nama_lengkap }}</strong>?
                                    </p>
                                    <p class="text-xs text-red-500 bg-red-50 p-3 rounded-lg font-medium">
                                        Calon siswa yang ditolak hanya akan disimpan sebagai riwayat di sistem PPDB dan tidak akan disinkronkan ke Data Center.
                                    </p>
                                </div>

                                <div class="px-5 py-3.5 bg-slate-50 border-t border-slate-100 flex flex-col-reverse sm:flex-row items-stretch sm:items-center sm:justify-end gap-2.5">
                                    <button @click="rejectModalOpen = false" type="button" class="px-4 py-2 text-xs font-black uppercase tracking-widest text-slate-500 hover:text-slate-700 text-center">
                                        BATAL
                                    </button>
                                    <form action="{{ route('admin.registrations.update-status', $registration->id) }}" method="POST" class="w-full sm:w-auto">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="w-full justify-center px-4 py-2.5 bg-red-600 hover:bg-red-500 text-white font-black text-xs rounded-lg uppercase tracking-wider transition-all shadow-md shadow-red-600/10 active:scale-95">
                                            YA, TOLAK PENDAFTARAN
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($registration->status == 'verified' && !$registration->is_synced_to_datacenter)
                        <form action="{{ route('admin.registrations.promote', $registration->id) }}" method="POST" class="w-full sm:w-auto">
                            @csrf
                            <button type="submit" class="w-full justify-center px-4 py-2.5 bg-yellow-500 hover:bg-yellow-400 text-green-950 font-black text-xs sm:text-sm rounded-lg transition-all shadow-lg shadow-yellow-500/20 flex items-center gap-2 active:scale-95">
                                <iconify-icon icon="lucide:refresh-cw" class="text-base"></iconify-icon> SINKRONKAN KE DATA CENTER
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:gap-6">
            {{-- Tabs Navigation --}}
            <div class="w-full overflow-x-auto no-scrollbar scroll-smooth -mx-4 px-4 sm:mx-0 sm:px-0">
                <div class="flex gap-2 p-1 bg-slate-100 rounded-sm border border-slate-200 min-w-max">
                    <button @click="tab = 'identitas'" :class="tab === 'identitas' ? 'bg-white text-green-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-4 sm:px-6 py-2 text-[11px] sm:text-xs font-black uppercase tracking-widest transition-all rounded-sm">IDENTITAS</button>
                    <button @click="tab = 'orangtua'" :class="tab === 'orangtua' ? 'bg-white text-green-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-4 sm:px-6 py-2 text-[11px] sm:text-xs font-black uppercase tracking-widest transition-all rounded-sm">ORANG TUA</button>
                    <button @click="tab = 'periodik'" :class="tab === 'periodik' ? 'bg-white text-green-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-4 sm:px-6 py-2 text-[11px] sm:text-xs font-black uppercase tracking-widest transition-all rounded-sm">PERIODIK</button>
                    <button @click="tab = 'prestasi'" :class="tab === 'prestasi' ? 'bg-white text-green-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-4 sm:px-6 py-2 text-[11px] sm:text-xs font-black uppercase tracking-widest transition-all rounded-sm">PRESTASI</button>
                    <button @click="tab = 'sekolah'" :class="tab === 'sekolah' ? 'bg-white text-green-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-4 sm:px-6 py-2 text-[11px] sm:text-xs font-black uppercase tracking-widest transition-all rounded-sm">SEKOLAH</button>
                    <button @click="tab = 'dokumen'" :class="tab === 'dokumen' ? 'bg-white text-green-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-4 sm:px-6 py-2 text-[11px] sm:text-xs font-black uppercase tracking-widest transition-all rounded-sm">DOKUMEN</button>
                </div>
            </div>

            {{-- Tab Content --}}
            <div class="w-full">
                {{-- IDENTITAS --}}
                <div x-show="tab === 'identitas'" class="bg-white p-5 sm:p-8 rounded-sm border border-slate-100 shadow-sm">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Lengkap</p>
                            <p class="text-sm font-black text-slate-800 mt-1 uppercase break-words">{{ $registration->nama_lengkap }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">NISN</p>
                            <p class="text-sm font-black text-slate-800 mt-1 break-all">{{ $registration->nisn }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">NIK</p>
                            <p class="text-sm font-black text-slate-800 mt-1 break-all">{{ $registration->nik }}</p>
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
                        <div class="sm:col-span-2 md:col-span-3">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Alamat</p>
                            <p class="text-sm font-black text-slate-800 mt-1 uppercase leading-relaxed">
                                {{ $registration->alamat }} RT {{ $registration->rt }} RW {{ $registration->rw }}, Kel. {{ $registration->kelurahan }}, Kec. {{ $registration->kecamatan }}, {{ $registration->kode_pos }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- ORANG TUA --}}
                <div x-show="tab === 'orangtua'" class="bg-white p-5 sm:p-8 rounded-sm border border-slate-100 shadow-sm">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                        <div class="space-y-4 sm:space-y-6">
                            <h4 class="text-xs font-black text-green-900 uppercase tracking-[0.2em] border-b border-slate-100 pb-2">Data Ayah</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ayah_nama }}</p></div>
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">NIK</p><p class="text-sm font-black text-slate-800 uppercase break-all">{{ $registration->ayah_nik }}</p></div>
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pendidikan</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ayah_pendidikan }}</p></div>
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pekerjaan</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ayah_pekerjaan }}</p></div>
                                <div class="sm:col-span-2"><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Penghasilan</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ayah_penghasilan }}</p></div>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6 pt-6 lg:pt-0 border-t border-slate-100 lg:border-none">
                            <h4 class="text-xs font-black text-green-900 uppercase tracking-[0.2em] border-b border-slate-100 pb-2">Data Ibu</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ibu_nama }}</p></div>
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">NIK</p><p class="text-sm font-black text-slate-800 uppercase break-all">{{ $registration->ibu_nik }}</p></div>
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pendidikan</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ibu_pendidikan }}</p></div>
                                <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pekerjaan</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ibu_pekerjaan }}</p></div>
                                <div class="sm:col-span-2"><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Penghasilan</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->ibu_penghasilan }}</p></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PERIODIK --}}
                <div x-show="tab === 'periodik'" class="bg-white p-5 sm:p-8 rounded-sm border border-slate-100 shadow-sm">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8">
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tinggi Badan</p><p class="text-lg sm:text-xl font-black text-slate-800">{{ $registration->tinggi_badan }} cm</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Berat Badan</p><p class="text-lg sm:text-xl font-black text-slate-800">{{ $registration->berat_badan }} kg</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Lingkar Kepala</p><p class="text-lg sm:text-xl font-black text-slate-800">{{ $registration->lingkar_kepala }} cm</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jumlah Saudara</p><p class="text-lg sm:text-xl font-black text-slate-800">{{ $registration->jumlah_saudara }}</p></div>
                        <div class="col-span-2"><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jarak ke Sekolah</p><p class="text-sm font-black text-slate-800">{{ $registration->jarak_sekolah }} KM</p></div>
                        <div class="col-span-2"><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Waktu Tempuh</p><p class="text-sm font-black text-slate-800">{{ $registration->waktu_jam }} jam {{ $registration->waktu_menit }} menit</p></div>
                    </div>
                </div>

                {{-- PRESTASI --}}
                <div x-show="tab === 'prestasi'" class="bg-white p-5 sm:p-8 rounded-sm border border-slate-100 shadow-sm">
                    @if($registration->prestasi_nama)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8">
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Prestasi</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->prestasi_nama }}</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->prestasi_jenis }}</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tingkat</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->prestasi_tingkat }}</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tahun</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->prestasi_tahun }}</p></div>
                        <div class="sm:col-span-2"><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Penyelenggara</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->prestasi_penyelenggara }}</p></div>
                    </div>
                    @else
                    <div class="text-center py-12 text-slate-400 italic text-sm">Tidak ada data prestasi yang diunggah.</div>
                    @endif
                </div>

                {{-- SEKOLAH --}}
                <div x-show="tab === 'sekolah'" class="bg-white p-5 sm:p-8 rounded-sm border border-slate-100 shadow-sm">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 sm:gap-8">
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Asal Sekolah</p><p class="text-lg sm:text-xl font-black text-slate-800 uppercase break-words">{{ $registration->asal_sekolah }}</p></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">No UN / Ijazah</p><p class="text-sm font-black text-slate-800 uppercase">{{ $registration->no_un ?? '-' }} / {{ $registration->no_ijazah ?? '-' }}</p></div>
                        <div class="sm:col-span-2">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jurusan Pilihan</p>
                            <p class="text-xl sm:text-2xl font-black text-green-900 uppercase mt-2 break-words">{{ $registration->jurusan->nama_jurusan ?? 'BELUM MEMILIH' }}</p>
                        </div>
                    </div>
                </div>

                {{-- DOKUMEN --}}
                <div x-show="tab === 'dokumen'" class="bg-white p-5 sm:p-8 rounded-sm border border-slate-100 shadow-sm">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($documentTypes as $type => $label)
                            @php
                                $doc = $registration->user->documents->where('document_type', $type)->first();
                            @endphp
                            <div class="p-4 rounded-sm border flex flex-col justify-between {{ $doc ? 'border-emerald-100 bg-emerald-50/30' : 'border-slate-100 bg-slate-50' }}">
                                <div class="flex justify-between items-start gap-2 mb-3">
                                    <div class="space-y-1">
                                        <p class="text-xs font-black text-slate-700 uppercase tracking-tight leading-tight">{{ $label }}</p>
                                        @if($doc)
                                            <p class="text-[10px] font-bold uppercase tracking-widest {{ $doc->status == 'verified' ? 'text-emerald-600' : ($doc->status == 'rejected' ? 'text-red-500' : 'text-yellow-600') }}">
                                                STATUS: {{ $doc->status }}
                                            </p>
                                        @else
                                            <p class="text-[10px] font-bold text-red-500 uppercase tracking-widest">BELUM DIUNGGAH</p>
                                        @endif
                                    </div>
                                    @if($doc)
                                        <a href="{{ $doc->file_url }}" target="_blank" class="p-2 bg-white text-emerald-600 rounded-sm shadow-sm hover:bg-emerald-600 hover:text-white transition-all shrink-0">
                                            <iconify-icon icon="lucide:external-link" class="text-sm block"></iconify-icon>
                                        </a>
                                    @endif
                                </div>

                                @if($doc && $doc->status == 'pending')
                                    <div class="flex gap-2 mt-auto pt-4 border-t border-emerald-100">
                                        <form action="{{ route('admin.documents.update-status', $doc->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="verified">
                                            <button type="submit" class="w-full py-2 bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-sm hover:bg-emerald-700 transition-all text-center">
                                                TERIMA
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.documents.update-status', $doc->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="w-full py-2 bg-red-100 text-red-600 text-[10px] font-black uppercase tracking-widest rounded-sm hover:bg-red-200 transition-all text-center">
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

    <x-slot name="scripts">
        <script>
            function confirmAccept(event, name) {
                event.preventDefault();
                const form = event.currentTarget.closest('form') || event.target.closest('form');
                if (!form) return;
                Swal.fire({
                    title: 'Terima Pendaftaran?',
                    text: `Apakah Anda yakin ingin menyetujui/menerima pendaftaran calon siswa ${name}?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981', // green/emerald
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Terima!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
                return false;
            }
        </script>
    </x-slot>
</x-admin-layout>