@php
    $stages = [
        ['key' => 'account', 'label' => 'Pembuatan akun', 'desc' => 'Registrasi portal selesai.', 'active' => true],
        ['key' => 'form', 'label' => 'Pengisian formulir', 'desc' => 'Data pribadi & orang tua.', 'active' => true],
        ['key' => 'verify', 'label' => 'Verifikasi berkas', 'desc' => 'Tinjauan dokumen oleh panitia.', 'active' => true],
        ['key' => 'selection', 'label' => 'Seleksi / ujian', 'desc' => 'Opsional sesuai kebijakan.', 'active' => false],
        ['key' => 'announce', 'label' => 'Pengumuman hasil', 'desc' => 'Publikasi status akhir.', 'active' => false],
    ];
@endphp

<x-admin-layout title="Manajemen Kelulusan" :breadcrumbs="[['label' => 'Kelulusan']]">
    <div class="space-y-8" x-data="{ alurOpen: false, activeStage: null }">
        <div data-aos="fade-down">
            <h2 class="text-2xl font-black text-green-950 uppercase tracking-tight">Seleksi & Manajemen Kelulusan</h2>
            <p class="text-sm text-slate-500 mt-1 max-w-2xl">Atur tahapan seleksi dan tentukan status kelulusan akhir untuk setiap calon pendaftar di pipeline PPDB.</p>
        </div>

        <div class="bg-white rounded-lg border border-slate-100 shadow-sm overflow-hidden" data-aos="fade-up">
            <div class="px-6 py-4 border-b border-slate-50 flex flex-wrap gap-3 justify-between items-center bg-slate-50/50">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Urutan Pipeline PPDB</span>
                <button type="button" @click="showToast('Konfigurasi alur berhasil diperbarui', 'success')"
                    class="text-xs font-black text-green-900 hover:text-green-700 uppercase tracking-widest transition-colors">SIMPAN PERUBAHAN</button>
            </div>
            <ol class="divide-y divide-slate-50">
                @foreach ($stages as $i => $stage)
                    <li class="p-6 flex flex-col md:flex-row md:items-center gap-6 hover:bg-slate-50/30 transition-colors group">
                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg border-2 transition-all duration-300 {{ $stage['active'] ? 'border-green-900 bg-green-900 text-white shadow-lg shadow-green-900/20 scale-110' : 'border-slate-200 text-slate-400 group-hover:border-slate-300' }} font-black text-sm">
                            {{ $i + 1 }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-black text-green-950 uppercase tracking-tight text-lg mb-1">{{ $stage['label'] }}</p>
                            <p class="text-sm text-slate-500">{{ $stage['desc'] }}</p>
                        </div>
                        <div class="flex items-center gap-6 shrink-0">
                            <label class="flex items-center gap-3 text-xs font-bold text-slate-600 cursor-pointer">
                                <input type="checkbox" class="rounded-lg border-slate-300 text-green-900 focus:ring-green-900"
                                    {{ $stage['active'] ? 'checked' : '' }}>
                                <span class="uppercase tracking-widest text-[10px]">AKTIF</span>
                            </label>
                            <button type="button" @click="activeStage = @js($stage); alurOpen = true" 
                                class="px-4 py-2 text-[10px] font-black text-slate-400 border border-slate-200 rounded-lg hover:bg-slate-50 hover:text-green-950 transition-all uppercase tracking-widest">
                                UBAH LABEL
                            </button>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>

        {{-- MODAL UBAH LABEL --}}
        <x-admin.modal id="alur" title="Ubah Konfigurasi Tahap" size="md">
            <form @submit.prevent="alurOpen = false; showToast('Label tahap berhasil diubah', 'success')" class="space-y-6">
                <div x-show="activeStage">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Tahapan</label>
                            <input type="text" :value="activeStage?.label" 
                                   class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Deskripsi Keterangan</label>
                            <textarea rows="3" class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white" x-text="activeStage?.desc"></textarea>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                    <button type="button" @click="alurOpen = false" class="px-6 py-2.5 rounded-lg bg-slate-100 text-slate-600 text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all">BATAL</button>
                    <button type="submit" class="px-8 py-2.5 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all">SIMPAN</button>
                </div>
            </form>
        </x-admin.modal>
    </div>
</x-admin-layout>
