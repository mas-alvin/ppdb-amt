<x-admin-layout title="Kelola Jurusan" :breadcrumbs="[['label' => 'Jurusan']]">
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-black text-green-950">Daftar Jurusan</h2>
                <p class="text-slate-500 text-sm">Kelola kompetensi keahlian yang tersedia untuk pendaftaran.</p>
            </div>
            <a href="{{ route('admin.jurusan.create') }}" class="px-6 py-3 bg-emerald-900 text-white font-black rounded-lg shadow-xl shadow-emerald-900/20 hover:bg-emerald-800 transition-all flex items-center gap-2">
                <iconify-icon icon="lucide:plus"></iconify-icon>
                TAMBAH JURUSAN
            </a>
        </div>

        <div class="bg-white rounded-lg border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Kode</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Jurusan</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($jurusans as $jurusan)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-black text-emerald-900 bg-emerald-50 px-2 py-1 rounded text-xs">
                                        {{ $jurusan->kode_jurusan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800">{{ $jurusan->nama_jurusan }}</div>
                                    <div class="text-xs text-slate-400 mt-1 line-clamp-1">{{ $jurusan->deskripsi ?: 'Tidak ada deskripsi' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span @class([
                                        'px-2 py-1 rounded-full text-[10px] font-black uppercase tracking-wider',
                                        'bg-emerald-100 text-emerald-800' => $jurusan->is_active,
                                        'bg-slate-100 text-slate-500' => !$jurusan->is_active,
                                    ])>
                                        {{ $jurusan->is_active ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.jurusan.edit', $jurusan) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                            <iconify-icon icon="lucide:edit-3"></iconify-icon>
                                        </a>
                                        <form action="{{ route('admin.jurusan.destroy', $jurusan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                                <iconify-icon icon="lucide:trash-2"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="size-16 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                            <iconify-icon icon="lucide:book-open" class="text-3xl"></iconify-icon>
                                        </div>
                                        <div class="text-slate-500 font-bold">Belum ada data jurusan</div>
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
