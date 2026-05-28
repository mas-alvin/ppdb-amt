<x-admin-layout title="Kelola Jurusan" :breadcrumbs="[['label' => 'Jurusan']]">
    <div class="space-y-6" x-data="{ modalOpen: false, isEdit: false, activeJurusan: { id: '', nama_jurusan: '', kode_jurusan: '', deskripsi: '', is_active: '1' } }">
        
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-black text-green-950">Daftar Jurusan</h2>
                <p class="text-slate-500 text-sm">Kelola kompetensi keahlian yang tersedia untuk pendaftaran.</p>
            </div>
            <button type="button" @click="activeJurusan = { id: '', nama_jurusan: '', kode_jurusan: '', deskripsi: '', is_active: '1' }; isEdit = false; modalOpen = true" 
                    class="px-6 py-3 bg-emerald-900 text-white font-black rounded-lg shadow-xl shadow-emerald-900/20 hover:bg-emerald-800 transition-all flex items-center gap-2">
                <iconify-icon icon="lucide:plus"></iconify-icon>
                TAMBAH JURUSAN
            </button>
        </div>

        {{-- Notification Flash Messages --}}
        @if(session('success'))
            <div class="p-4 bg-green-50 border border-green-200 text-green-900 rounded-lg text-sm font-bold flex items-center gap-3">
                <iconify-icon icon="lucide:check-circle" class="text-xl"></iconify-icon>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Kode</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Jurusan</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($jurusans as $jurusan)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-black text-emerald-900 bg-emerald-50 px-2.5 py-1 rounded text-xs">
                                        {{ $jurusan->kode_jurusan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800">{{ $jurusan->nama_jurusan }}</div>
                                    <div class="text-xs text-slate-400 mt-1 line-clamp-1">{{ $jurusan->deskripsi ?: 'Tidak ada deskripsi' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span @class([
                                        'px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider',
                                        'bg-emerald-100 text-emerald-800' => $jurusan->is_active,
                                        'bg-slate-100 text-slate-500' => !$jurusan->is_active,
                                    ])>
                                        {{ $jurusan->is_active ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button type="button" @click="activeJurusan = { id: '{{ $jurusan->id }}', nama_jurusan: '{{ $jurusan->nama_jurusan }}', kode_jurusan: '{{ $jurusan->kode_jurusan }}', deskripsi: '{{ addslashes($jurusan->deskripsi) }}', is_active: '{{ $jurusan->is_active ? '1' : '0' }}' }; isEdit = true; modalOpen = true" 
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                            <iconify-icon icon="lucide:edit-3" class="text-lg"></iconify-icon>
                                        </button>
                                        <form action="{{ route('admin.jurusan.destroy', $jurusan) }}" method="POST" onsubmit="return confirmDelete(event, 'Apakah Anda yakin ingin menghapus jurusan ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                                <iconify-icon icon="lucide:trash-2" class="text-lg"></iconify-icon>
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

        {{-- MODAL EDITOR JURUSAN --}}
        <div x-show="modalOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-green-950/20 backdrop-blur-sm" x-cloak>
            
            <div @click.away="modalOpen = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden border border-slate-100">
                <div class="px-6 py-4 border-b border-slate-50 bg-slate-50/50 flex items-center justify-between">
                    <h3 class="text-sm font-black text-green-950 uppercase tracking-widest" x-text="isEdit ? 'Ubah Informasi Jurusan' : 'Tambah Jurusan Baru'"></h3>
                    <button @click="modalOpen = false" class="text-slate-400 hover:text-slate-600">
                        <iconify-icon icon="lucide:x" class="text-xl"></iconify-icon>
                    </button>
                </div>
                
                <form :action="isEdit ? `{{ url('admin/jurusan') }}/${activeJurusan.id}` : `{{ route('admin.jurusan.index') }}`" method="POST" class="p-6 space-y-6">
                    @csrf
                    <template x-if="isEdit">
                        @method('PUT')
                    </template>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Jurusan</label>
                            <input type="text" name="nama_jurusan" x-model="activeJurusan.nama_jurusan" placeholder="Contoh: Pengembangan Perangkat Lunak & Gim" required
                                   class="w-full text-sm border border-slate-200 rounded-lg focus:border-green-800 focus:ring-4 focus:ring-green-800/10 transition-all duration-200 outline-none text-slate-700 font-medium px-4 py-3 bg-white hover:border-slate-300">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Kode Jurusan</label>
                            <input type="text" name="kode_jurusan" x-model="activeJurusan.kode_jurusan" placeholder="Contoh: PPLG" required
                                   class="w-full text-sm border border-slate-200 rounded-lg focus:border-green-800 focus:ring-4 focus:ring-green-800/10 transition-all duration-200 outline-none text-slate-700 font-medium px-4 py-3 bg-white hover:border-slate-300">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Deskripsi</label>
                            <textarea name="deskripsi" x-model="activeJurusan.deskripsi" rows="3" placeholder="Masukkan deskripsi kompetensi keahlian..."
                                      class="w-full text-sm border border-slate-200 rounded-lg focus:border-green-800 focus:ring-4 focus:ring-green-800/10 transition-all duration-200 outline-none text-slate-700 font-medium px-4 py-3 bg-white hover:border-slate-300"></textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Status</label>
                            <select name="is_active" x-model="activeJurusan.is_active" class="w-full text-sm border border-slate-200 rounded-lg focus:border-green-800 focus:ring-4 focus:ring-green-800/10 transition-all duration-200 outline-none text-slate-700 font-medium px-4 py-3 bg-white hover:border-slate-300">
                                <option value="1">Aktif</option>
                                <option value="0">Non-Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                        <button type="button" @click="modalOpen = false" class="px-6 py-2.5 rounded-lg bg-slate-100 text-slate-600 text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all">BATAL</button>
                        <button type="submit" class="px-8 py-2.5 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all" x-text="isEdit ? 'SIMPAN PERUBAHAN' : 'TAMBAHKAN'"></button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-admin-layout>
