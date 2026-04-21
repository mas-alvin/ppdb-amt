@php
    $tabs = [
        ['id' => 'general', 'label' => 'Umum'],
        ['id' => 'documents', 'label' => 'Jenis dokumen'],
        ['id' => 'notifications', 'label' => 'Notifikasi'],
        ['id' => 'security', 'label' => 'Keamanan'],
    ];
@endphp

<x-admin-layout title="Konfigurasi Sistem" :breadcrumbs="[['label' => 'Pengaturan']]">
    <div class="mb-8" data-aos="fade-down">
        <h2 class="text-2xl font-black text-green-950 uppercase tracking-tight">Konfigurasi Sistem PPDB</h2>
        <p class="text-sm text-slate-500 mt-1 max-w-2xl">Atur identitas lembaga, parameter dokumen, kanal notifikasi, dan kebijakan keamanan aplikasi secara terpusat.</p>
    </div>

    <div class="bg-white rounded-lg border border-slate-100 shadow-sm overflow-hidden" x-data="{ tab: 'general' }" data-aos="fade-up">
        <div class="border-b border-slate-100 flex overflow-x-auto bg-slate-50/50">
            @foreach ($tabs as $t)
                <button type="button" @click="tab = '{{ $t['id'] }}'"
                    :class="tab === '{{ $t['id'] }}'
                        ? 'border-b-2 border-green-900 text-green-900 bg-white'
                        : 'text-slate-400 hover:text-slate-600'"
                    class="px-8 py-4 text-xs font-black uppercase tracking-widest whitespace-nowrap transition-all border-b-2 border-transparent">
                    {{ $t['label'] }}
                </button>
            @endforeach
        </div>

        <div class="p-6 space-y-6">
            <div x-show="tab === 'general'" x-transition>
                <h3 class="text-sm font-bold text-gray-900 mb-4">Identitas & batasan</h3>
                <form class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-3xl"
                    onsubmit="event.preventDefault(); showToast('Pengaturan umum disimpan.', 'success');">
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Nama Lembaga</label>
                        <input type="text" value="SMK AL-MUJTAMA'"
                            class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Zona Waktu</label>
                        <select
                            class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                            <option>WIB</option>
                            <option>WITA</option>
                            <option>WIT</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Ukuran Unggah Maks (MB)</label>
                        <input type="number" value="2" min="1"
                            class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                    </div>
                    <div class="md:col-span-2 pt-4">
                        <button type="submit"
                            class="px-8 py-3 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 transition-all shadow-xl shadow-green-900/20">
                            SIMPAN KONFIGURASI
                        </button>
                    </div>
                </form>
            </div>

            <div x-show="tab === 'documents'" x-transition style="display: none;">
                <h3 class="text-sm font-bold text-gray-900 mb-4">Tipe dokumen wajib</h3>
                <p class="text-sm text-gray-500 mb-4">Selaras dengan kartu dokumen di halaman unggah pendaftar.</p>
                <ul class="space-y-2 max-w-xl">
                    @foreach (['Ijazah', 'SKHUN / keterangan lulus', 'Kartu Keluarga', 'Akta kelahiran', 'Pas foto 3×4'] as $doc)
                        <li class="flex items-center gap-3 text-sm">
                            <input type="checkbox" checked class="rounded border-gray-300 text-emerald-600">
                            <span>{{ $doc }}</span>
                        </li>
                    @endforeach
                </ul>
                <button type="button" onclick="showToast('Daftar dokumen diperbarui.', 'success')"
                    class="mt-6 px-8 py-3 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all">SIMPAN DAFTAR</button>
            </div>

            <div x-show="tab === 'notifications'" x-transition style="display: none;">
                <h3 class="text-sm font-bold text-gray-900 mb-4">Kanal pemberitahuan</h3>
                <form class="space-y-3 max-w-xl"
                    onsubmit="event.preventDefault(); showToast('Preferensi notifikasi disimpan.', 'success');">
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" checked class="rounded border-gray-300 text-emerald-600"> Email
                        transaksional
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" class="rounded border-gray-300 text-emerald-600"> WhatsApp (gateway
                        eksternal)
                    </label>
                    <button type="submit"
                        class="px-8 py-3 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all">SIMPAN PREFERENSI</button>
                </form>
            </div>

            <div x-show="tab === 'security'" x-transition style="display: none;">
                <h3 class="text-sm font-bold text-gray-900 mb-4">Kebijakan sesi</h3>
                <p class="text-sm text-gray-500 mb-4">TTL sesi admin, 2FA, dan pembatasan IP dapat dihubungkan di
                    lapisan auth.</p>
                <button type="button" onclick="showToast('Panel keamanan lanjutan belum terhubung.', 'warning')"
                    class="px-4 py-2 rounded-lg border border-gray-200 text-sm font-semibold text-gray-700">Buka
                    konfigurasi lanjutan</button>
            </div>
        </div>
    </div>
</x-admin-layout>
