@php
    $waves = [
        ['nama' => 'Gelombang I', 'buka' => '2026-03-01', 'tutup' => '2026-04-15', 'kuota' => 120, 'status' => 'Buka'],
        ['nama' => 'Gelombang II', 'buka' => '2026-05-01', 'tutup' => '2026-06-30', 'kuota' => 80, 'status' => 'Draf'],
    ];
@endphp

<x-admin-layout title="Jadwal Gelombang" :breadcrumbs="[['label' => 'Jadwal']]">
    <div class="space-y-8" x-data="{ waveOpen: false, activeWave: null, mode: 'add' }">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4" data-aos="fade-down">
            <div>
                <h2 class="text-2xl font-black text-green-950 uppercase tracking-tight">Manajemen Gelombang & Jadwal</h2>
                <p class="text-sm text-slate-500 mt-1 max-w-2xl">Atur pembukaan gelombang pendaftaran, tentukan batas waktu, dan kelola kuota penerimaan siswa untuk setiap periode.</p>
            </div>
            <button type="button" @click="mode = 'add'; activeWave = null; waveOpen = true"
                class="px-6 py-2.5 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 transition-all shadow-xl shadow-green-900/20">
                TAMBAH GELOMBANG
            </button>
        </div>

        <div class="bg-white rounded-lg border border-slate-100 shadow-sm overflow-hidden" data-aos="fade-up">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
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
                        @foreach ($waves as $w)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4 font-black text-green-950 uppercase tracking-tight">{{ $w['nama'] }}</td>
                                <td class="px-6 py-4 text-slate-500 text-sm tabular-nums">{{ $w['buka'] }}</td>
                                <td class="px-6 py-4 text-slate-500 text-sm tabular-nums">{{ $w['tutup'] }}</td>
                                <td class="px-6 py-4 text-right tabular-nums font-bold text-green-900">{{ $w['kuota'] }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $w['status'] === 'Buka' ? 'bg-green-100 text-green-800' : 'bg-slate-100 text-slate-600' }}">{{ $w['status'] }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button type="button" @click="mode = 'edit'; activeWave = @js($w); waveOpen = true"
                                        class="text-green-700 hover:text-green-900 text-[10px] font-black uppercase tracking-widest transition-colors">EDIT</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- MODAL GELOMBANG --}}
        <x-admin.modal id="wave" :title="mode === 'add' ? 'Tambah Gelombang Baru' : 'Ubah Konfigurasi Gelombang'" size="lg">
            <form @submit.prevent="waveOpen = false; showToast(mode === 'add' ? 'Gelombang baru berhasil dibuat' : 'Perubahan jadwal disimpan', 'success')" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Gelombang</label>
                        <input type="text" :value="activeWave?.nama" placeholder="Contoh: Gelombang III"
                               class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tanggal Buka</label>
                        <input type="date" :value="activeWave?.buka" 
                               class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tanggal Tutup</label>
                        <input type="date" :value="activeWave?.tutup" 
                               class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Kuota Pendaftar</label>
                        <input type="number" :value="activeWave?.kuota" 
                               class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Status</label>
                        <select class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white font-bold uppercase tracking-wider">
                            <option value="Draf">DRAF</option>
                            <option value="Buka">BUKA</option>
                            <option value="Tutup">TUTUP</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                    <button type="button" @click="waveOpen = false" class="px-6 py-2.5 rounded-lg bg-slate-100 text-slate-600 text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all">BATAL</button>
                    <button type="submit" class="px-8 py-2.5 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all">SIMPAN KONFIGURASI</button>
                </div>
            </form>
        </x-admin.modal>
    </div>
</x-admin-layout>
