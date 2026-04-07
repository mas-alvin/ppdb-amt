@php
    $tabs = [
        ['id' => 'general', 'label' => 'Umum'],
        ['id' => 'documents', 'label' => 'Jenis dokumen'],
        ['id' => 'notifications', 'label' => 'Notifikasi'],
        ['id' => 'security', 'label' => 'Keamanan'],
    ];
@endphp

<x-admin-layout title="Konfigurasi sistem" :breadcrumbs="[['label' => 'Pengaturan']]">
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden" x-data="{ tab: 'general' }">
        <div class="border-b border-gray-100 flex overflow-x-auto">
            @foreach ($tabs as $t)
                <button type="button" @click="tab = '{{ $t['id'] }}'"
                    :class="tab === '{{ $t['id'] }}'
                        ? 'border-b-2 border-emerald-600 text-emerald-700 bg-emerald-50/50'
                        : 'text-gray-500 hover:text-gray-800'"
                    class="px-4 py-3 text-sm font-semibold whitespace-nowrap transition-colors border-b-2 border-transparent">
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
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama lembaga</label>
                        <input type="text" value="PPDB SMA Contoh"
                            class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Zona waktu</label>
                        <select
                            class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                            <option>WIB</option>
                            <option>WITA</option>
                            <option>WIT</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Ukuran unggah maks
                            (MB)</label>
                        <input type="number" value="2" min="1"
                            class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit"
                            class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700">
                            Simpan
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
                    class="mt-4 px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-semibold">Simpan daftar</button>
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
                        class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-semibold">Simpan</button>
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
