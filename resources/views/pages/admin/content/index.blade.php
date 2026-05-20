<x-admin-layout title="Informasi & Pengumuman" :breadcrumbs="[['label' => 'Informasi']]">
    <div class="space-y-8" x-data="{ modalOpen: false, activeItem: null, isEdit: false }">
        <div class="flex flex-wrap items-center justify-between gap-6" data-aos="fade-down">
            <div>
                <h2 class="text-2xl font-black text-green-950 uppercase tracking-tight">Manajemen Informasi & Berita</h2>
                <p class="text-sm text-slate-500 mt-1 max-w-2xl">Kelola seluruh konten publik, berita, dan pengumuman resmi yang akan tampil pada dashboard portal siswa.</p>
            </div>
            <button @click="activeItem = { title: '', content: '', type: 'info' }; isEdit = false; modalOpen = true" 
                class="px-6 py-3 bg-green-900 text-white text-xs font-black uppercase tracking-widest rounded-lg hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all flex items-center gap-2">
                <iconify-icon icon="lucide:plus" class="text-lg"></iconify-icon> BUAT PENGUMUMAN
            </button>
        </div>

        <div class="grid grid-cols-1 gap-6" data-aos="fade-up">
            @foreach($announcements as $announcement)
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden group hover:border-green-200 transition-all">
                    <div class="p-6 flex flex-col md:flex-row gap-6">
                        <div @class([
                            'size-14 rounded-xl flex items-center justify-center shrink-0 shadow-lg',
                            'bg-blue-600 text-white shadow-blue-600/20' => $announcement->type == 'info',
                            'bg-yellow-500 text-green-950 shadow-yellow-500/20' => $announcement->type == 'warning',
                            'bg-red-600 text-white shadow-red-600/20' => $announcement->type == 'danger',
                        ])>
                            <iconify-icon icon="{{ $announcement->type == 'danger' ? 'lucide:alert-triangle' : ($announcement->type == 'warning' ? 'lucide:info' : 'lucide:megaphone') }}" class="text-2xl"></iconify-icon>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-3 mb-1">
                                <h3 class="text-lg font-black text-green-950 uppercase tracking-tight">{{ $announcement->title }}</h3>
                                <span @class([
                                    'text-[10px] px-2 py-0.5 rounded-full font-bold uppercase tracking-widest',
                                    'bg-blue-50 text-blue-600' => $announcement->type == 'info',
                                    'bg-yellow-50 text-yellow-700' => $announcement->type == 'warning',
                                    'bg-red-50 text-red-600' => $announcement->type == 'danger',
                                ])>{{ $announcement->type }}</span>
                            </div>
                            <p class="text-sm text-slate-500 line-clamp-2 mb-4">{{ $announcement->content }}</p>
                            
                            <div class="flex flex-wrap items-center gap-4">
                                <div class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    <iconify-icon icon="lucide:calendar"></iconify-icon>
                                    <span>{{ $announcement->created_at->format('d M Y') }}</span>
                                </div>
                                @if($announcement->document_path)
                                <a href="{{ Storage::url($announcement->document_path) }}" target="_blank" class="flex items-center gap-2 text-[10px] font-black text-green-700 uppercase tracking-widest bg-green-50 px-2 py-1 rounded hover:bg-green-100 transition-colors">
                                    <iconify-icon icon="lucide:file-text"></iconify-icon>
                                    <span>Lihat Dokumen PDF</span>
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-3 shrink-0">
                            <form action="{{ route('admin.content.toggle', $announcement) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" @class([
                                    'px-4 py-2 text-[10px] font-black rounded-lg transition-all uppercase tracking-widest border',
                                    'bg-green-50 text-green-700 border-green-200' => $announcement->is_active,
                                    'bg-slate-50 text-slate-400 border-slate-200' => !$announcement->is_active,
                                ])>
                                    {{ $announcement->is_active ? 'TAMPIL' : 'DISEMBUNYIKAN' }}
                                </button>
                            </form>
                            <button @click="activeItem = @js($announcement); isEdit = true; modalOpen = true" 
                                class="p-2 text-slate-400 hover:text-green-950 transition-colors">
                                <iconify-icon icon="lucide:edit-3" class="text-xl"></iconify-icon>
                            </button>
                            <form action="{{ route('admin.content.destroy', $announcement) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-600 transition-colors">
                                    <iconify-icon icon="lucide:trash-2" class="text-xl"></iconify-icon>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- MODAL EDITOR --}}
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
                    <h3 class="text-sm font-black text-green-950 uppercase tracking-widest" x-text="isEdit ? 'Ubah Pengumuman' : 'Buat Pengumuman Baru'"></h3>
                    <button @click="modalOpen = false" class="text-slate-400 hover:text-slate-600">
                        <iconify-icon icon="lucide:x" class="text-xl"></iconify-icon>
                    </button>
                </div>
                
                <form :action="isEdit ? `{{ url('admin/content') }}/${activeItem.id}` : `{{ route('admin.content.index') }}`" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf
                    <template x-if="isEdit">
                        @method('PUT')
                    </template>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Judul Pengumuman</label>
                            <input type="text" name="title" x-model="activeItem.title" placeholder="Judul informasi"
                                   class="w-full text-sm border border-slate-200 rounded-lg focus:border-green-800 focus:ring-4 focus:ring-green-800/10 transition-all duration-200 outline-none text-slate-700 font-medium px-4 py-3 bg-white hover:border-slate-300" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tipe / Kategori</label>
                            <select name="type" x-model="activeItem.type" class="w-full text-sm border border-slate-200 rounded-lg focus:border-green-800 focus:ring-4 focus:ring-green-800/10 transition-all duration-200 outline-none text-slate-700 font-medium px-4 py-3 bg-white hover:border-slate-300">
                                <option value="info">Informasi (Biru)</option>
                                <option value="warning">Peringatan (Kuning)</option>
                                <option value="danger">Penting / Mendesak (Merah)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Konten / Deskripsi</label>
                            <textarea name="content" rows="4" x-model="activeItem.content" placeholder="Tulis isi pengumuman di sini..."
                                class="w-full text-sm border border-slate-200 rounded-lg focus:border-green-800 focus:ring-4 focus:ring-green-800/10 transition-all duration-200 outline-none text-slate-700 font-medium px-4 py-3 bg-white hover:border-slate-300" required></textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Lampiran Dokumen (PDF, Maks 5MB)</label>
                            <input type="file" name="document" accept=".pdf"
                                   class="w-full text-sm border border-slate-200 rounded-lg focus:border-green-800 focus:ring-4 focus:ring-green-800/10 transition-all duration-200 outline-none text-slate-700 font-medium px-4 py-3 bg-white hover:border-slate-300 file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-black file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            <p class="mt-1 text-[10px] text-slate-400">Kosongkan jika tidak ada lampiran.</p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                        <button type="button" @click="modalOpen = false" class="px-6 py-2.5 rounded-lg bg-slate-100 text-slate-600 text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all">BATAL</button>
                        <button type="submit" class="px-8 py-2.5 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all" x-text="isEdit ? 'PERBARUI' : 'TERBITKAN'"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
