<x-admin-layout title="Jadwal Gelombang" :breadcrumbs="[['label' => 'Jadwal']]">
    <div class="space-y-8" x-data="{ waveOpen: false, activeWave: null, mode: 'add' }">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4" data-aos="fade-down">
            <div>
                <h2 class="text-2xl font-black text-green-950 uppercase tracking-tight">Manajemen Gelombang & Jadwal</h2>
                <p class="text-sm text-slate-500 mt-1 max-w-2xl">Atur pembukaan gelombang pendaftaran, tentukan batas waktu, dan kelola kuota penerimaan siswa untuk setiap periode.</p>
            </div>
            <button type="button" @click="mode = 'add'; activeWave = { name: '', start_date: '', end_date: '', quota: 0, status: 'draft', description: '' }; waveOpen = true"
                class="px-6 py-2.5 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 transition-all shadow-xl shadow-green-900/20 flex items-center gap-2">
                <iconify-icon icon="lucide:plus" class="text-lg"></iconify-icon> TAMBAH GELOMBANG
            </button>
        </div>

        <div class="bg-white rounded-lg border border-slate-100 shadow-sm overflow-hidden" data-aos="fade-up">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">
                        <tr>
                            <th class="px-6 py-4">Nama Gelombang</th>
                            <th class="px-6 py-4">Tanggal Buka</th>
                            <th class="px-6 py-4">Tanggal Tutup</th>
                            <th class="px-6 py-4 text-right">Kuota</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($waves as $w)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="font-black text-green-950 uppercase tracking-tight">{{ $w->name }}</div>
                                    @if($w->description)
                                        <div class="text-[10px] text-slate-400 line-clamp-1">{{ $w->description }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-500 text-sm tabular-nums">{{ $w->start_date->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-slate-500 text-sm tabular-nums">{{ $w->end_date->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-right tabular-nums">
                                    <div class="flex flex-col items-end">
                                        <div class="text-sm font-black {{ $w->registrations_count >= $w->quota ? 'text-red-600' : 'text-green-900' }}">
                                            {{ $w->registrations_count }} / {{ $w->quota }}
                                        </div>
                                        <div class="text-[9px] text-slate-400 uppercase tracking-widest mt-0.5">Terisi / Total</div>
                                        @if($w->registrations_count >= $w->quota)
                                            <span class="mt-1 px-1.5 py-0.5 bg-red-100 text-red-700 text-[8px] font-black rounded uppercase">Penuh</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        @class([
                                            'inline-flex px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest',
                                            'bg-green-100 text-green-800' => $w->status === 'open',
                                            'bg-slate-100 text-slate-600' => $w->status === 'draft',
                                            'bg-red-100 text-red-600' => $w->status === 'closed',
                                        ])>{{ $w->status }}</span>
                                </td>
                                <td class="px-6 py-4 text-right flex items-center justify-end gap-2">
                                    <button type="button" @click="mode = 'edit'; activeWave = @js($w); waveOpen = true"
                                        class="p-2 text-green-700 hover:text-green-900 transition-colors">
                                        <iconify-icon icon="lucide:edit-3" class="text-lg"></iconify-icon>
                                    </button>
                                    <form action="{{ route('admin.schedule.destroy', $w) }}" method="POST" onsubmit="return confirm('Hapus gelombang ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 transition-colors">
                                            <iconify-icon icon="lucide:trash-2" class="text-lg"></iconify-icon>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-400 italic text-sm">Belum ada data gelombang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
 
        {{-- MODAL GELOMBANG --}}
        <div x-show="waveOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-green-950/20 backdrop-blur-sm" x-cloak>
            
            <div @click.away="waveOpen = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden border border-slate-100">
                <div class="px-6 py-4 border-b border-slate-50 bg-slate-50/50 flex items-center justify-between">
                    <h3 class="text-sm font-black text-green-950 uppercase tracking-widest" x-text="mode === 'add' ? 'Tambah Gelombang Baru' : 'Ubah Konfigurasi Gelombang'"></h3>
                    <button @click="waveOpen = false" class="text-slate-400 hover:text-slate-600">
                        <iconify-icon icon="lucide:x" class="text-xl"></iconify-icon>
                    </button>
                </div>
                
                <form :action="mode === 'edit' ? `{{ url('admin/schedule') }}/${activeWave.id}` : `{{ route('admin.schedule.index') }}`" method="POST" class="p-6 space-y-6">
                    @csrf
                    <template x-if="mode === 'edit'">
                        @method('PUT')
                    </template>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Gelombang</label>
                            <input type="text" name="name" x-model="activeWave.name" placeholder="Contoh: Gelombang III" required
                                   class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tanggal Buka</label>
                            <input type="date" name="start_date" x-model="activeWave.start_date" required
                                   class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tanggal Tutup</label>
                            <input type="date" name="end_date" x-model="activeWave.end_date" required
                                   class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Kuota Pendaftar</label>
                            <input type="number" name="quota" x-model="activeWave.quota" required
                                   class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Status</label>
                            <select name="status" x-model="activeWave.status" class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white font-bold uppercase tracking-wider">
                                <option value="draft">DRAF</option>
                                <option value="open">BUKA</option>
                                <option value="closed">TUTUP</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Deskripsi / Catatan</label>
                            <textarea name="description" x-model="activeWave.description" rows="2" placeholder="Catatan tambahan untuk gelombang ini..."
                                class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                        <button type="button" @click="waveOpen = false" class="px-6 py-2.5 rounded-lg bg-slate-100 text-slate-600 text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all">BATAL</button>
                        <button type="submit" class="px-8 py-2.5 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all">SIMPAN KONFIGURASI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
