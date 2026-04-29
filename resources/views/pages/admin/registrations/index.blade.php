<x-admin-layout title="Manajemen Pendaftaran" :breadcrumbs="[['label' => 'Pendaftaran']]">
    <div class="space-y-6">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-sm border border-slate-100 shadow-sm">
            <div>
                <h2 class="text-xl font-black text-green-950 uppercase tracking-tight">Daftar Calon Siswa</h2>
                <p class="text-xs text-slate-500 mt-1 font-medium">Total {{ $registrations->count() }} pendaftar masuk ke dalam sistem.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-sm font-bold text-xs hover:bg-slate-200 transition-all">
                    <iconify-icon icon="lucide:download"></iconify-icon>
                    EKSPOR DATA
                </button>
            </div>
        </div>

        {{-- Main Table --}}
        <div class="bg-white rounded-sm border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Pendaftar</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">NISN / NIK</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Asal Sekolah</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($registrations as $reg)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="size-10 rounded-sm bg-green-900 flex items-center justify-center text-white font-black text-xs shadow-lg shadow-green-900/20">
                                            {{ substr($reg->nama_lengkap, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-green-950 uppercase tracking-tight">{{ $reg->nama_lengkap }}</p>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">{{ $reg->created_at->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-xs font-bold text-slate-700">NISN: {{ $reg->nisn }}</p>
                                    <p class="text-[10px] text-slate-400 font-medium mt-0.5">NIK: {{ $reg->nik }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-xs font-bold text-slate-700 uppercase tracking-tight">{{ $reg->asal_sekolah }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                            'verified' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                            'rejected' => 'bg-red-50 text-red-600 border-red-100',
                                        ][$reg->status];
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-sm border {{ $statusClasses }} text-[10px] font-black uppercase tracking-widest">
                                        {{ $reg->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.registrations.show', $reg->id) }}" class="p-2 text-slate-400 hover:text-green-900 hover:bg-green-50 rounded-sm transition-all" title="Detail">
                                            <iconify-icon icon="lucide:eye" class="text-lg"></iconify-icon>
                                        </a>
                                        <button class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-sm transition-all" title="Verifikasi">
                                            <iconify-icon icon="lucide:check-square" class="text-lg"></iconify-icon>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-slate-400">
                                        <iconify-icon icon="lucide:inbox" class="text-4xl mb-2"></iconify-icon>
                                        <p class="text-sm font-bold uppercase tracking-widest">Belum ada pendaftar</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
