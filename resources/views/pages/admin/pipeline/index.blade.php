<x-admin-layout title="Manajemen Kelulusan" :breadcrumbs="[['label' => 'Kelulusan']]">
    <div class="space-y-8" x-data="{ alurOpen: false, activeStage: null, isEdit: false }">
        <div class="flex flex-wrap items-center justify-between gap-6" data-aos="fade-down">
            <div>
                <h2 class="text-2xl font-black text-green-950 uppercase tracking-tight">Seleksi & Manajemen Kelulusan</h2>
                <p class="text-sm text-slate-500 mt-1 max-w-2xl">Atur tahapan seleksi dan tentukan status kelulusan akhir untuk setiap calon pendaftar di pipeline PPDB.</p>
            </div>
            <button @click="activeStage = { label: '', description: '', start_date: '', end_date: '', key: '' }; isEdit = false; alurOpen = true" 
                class="px-6 py-3 bg-green-900 text-white text-xs font-black uppercase tracking-widest rounded-lg hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all flex items-center gap-2">
                <iconify-icon icon="lucide:plus" class="text-lg"></iconify-icon> TAMBAH ALUR
            </button>
        </div>

        <div class="bg-white rounded-lg border border-slate-100 shadow-sm overflow-hidden" data-aos="fade-up">
            <div class="px-6 py-4 border-b border-slate-50 bg-slate-50/50">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Urutan Pipeline PPDB</span>
            </div>
            <ol class="divide-y divide-slate-50">
                @foreach ($stages as $i => $stage)
                    <li class="p-6 flex flex-col md:flex-row md:items-center gap-6 hover:bg-slate-50/30 transition-colors group">
                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg border-2 transition-all duration-300 {{ $stage->is_active ? 'border-green-900 bg-green-900 text-white shadow-lg shadow-green-900/20 scale-110' : 'border-slate-200 text-slate-400 group-hover:border-slate-300' }} font-black text-sm">
                            {{ $i + 1 }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-3 mb-1">
                                <p class="font-black text-green-950 uppercase tracking-tight text-lg">{{ $stage->label }}</p>
                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 text-slate-500 font-bold uppercase tracking-widest">{{ $stage->key }}</span>
                            </div>
                            <p class="text-sm text-slate-500 mb-2">{{ $stage->description }}</p>
                            @if($stage->start_date && $stage->end_date)
                            <div class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                <iconify-icon icon="lucide:calendar-range"></iconify-icon>
                                <span>{{ \Carbon\Carbon::parse($stage->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($stage->end_date)->format('d M Y') }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="flex items-center gap-6 shrink-0">
                            <form action="{{ route('admin.pipeline.toggle', $stage) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <label class="flex items-center gap-3 text-xs font-bold text-slate-600 cursor-pointer">
                                    <input type="checkbox" onchange="this.form.submit()" class="rounded-lg border-slate-300 text-green-900 focus:ring-green-900"
                                        {{ $stage->is_active ? 'checked' : '' }}>
                                    <span class="uppercase tracking-widest text-[10px]">{{ $stage->is_active ? 'AKTIF' : 'NONAKTIF' }}</span>
                                </label>
                            </form>
                            <button type="button" @click="activeStage = @js($stage); isEdit = true; alurOpen = true" 
                                class="px-4 py-2 text-[10px] font-black text-slate-400 border border-slate-200 rounded-lg hover:bg-slate-50 hover:text-green-950 transition-all uppercase tracking-widest">
                                KONFIGURASI
                            </button>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>

        {{-- MODAL UBAH / TAMBAH --}}
        <div x-show="alurOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-green-950/20 backdrop-blur-sm" x-cloak>
            
            <div @click.away="alurOpen = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden border border-slate-100">
                <div class="px-6 py-4 border-b border-slate-50 bg-slate-50/50 flex items-center justify-between">
                    <h3 class="text-sm font-black text-green-950 uppercase tracking-widest" x-text="isEdit ? 'Ubah Konfigurasi Tahap' : 'Tambah Alur Baru'"></h3>
                    <button @click="alurOpen = false" class="text-slate-400 hover:text-slate-600">
                        <iconify-icon icon="lucide:x" class="text-xl"></iconify-icon>
                    </button>
                </div>
                
                <form :action="isEdit ? `{{ url('admin/pipeline') }}/${activeStage.id}` : `{{ route('admin.pipeline.index') }}`" method="POST" class="p-6 space-y-6">
                    @csrf
                    <template x-if="isEdit">
                        @method('PUT')
                    </template>

                    <div class="space-y-4">
                        <div x-show="!isEdit">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Key Identifikasi (Unik)</label>
                            <input type="text" name="key" x-model="activeStage.key" placeholder="misal: seleksi_ujian"
                                   class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Tahapan</label>
                            <input type="text" name="label" x-model="activeStage.label" placeholder="Nama tahapan"
                                   class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Deskripsi Keterangan</label>
                            <textarea name="description" rows="2" x-model="activeStage.description" placeholder="Penjelasan singkat tahap ini"
                                class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white"></textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tanggal Mulai</label>
                                <input type="date" name="start_date" x-model="activeStage.start_date"
                                       class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tanggal Selesai</label>
                                <input type="date" name="end_date" x-model="activeStage.end_date"
                                       class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                        <button type="button" @click="alurOpen = false" class="px-6 py-2.5 rounded-lg bg-slate-100 text-slate-600 text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all">BATAL</button>
                        <button type="submit" class="px-8 py-2.5 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all" x-text="isEdit ? 'SIMPAN' : 'TAMBAH'"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
