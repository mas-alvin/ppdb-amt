@php
    $stages = [
        ['key' => 'account', 'label' => 'Pembuatan akun', 'desc' => 'Registrasi portal selesai.', 'active' => true],
        ['key' => 'form', 'label' => 'Pengisian formulir', 'desc' => 'Data pribadi & orang tua.', 'active' => true],
        ['key' => 'verify', 'label' => 'Verifikasi berkas', 'desc' => 'Tinjauan dokumen oleh panitia.', 'active' => true],
        ['key' => 'selection', 'label' => 'Seleksi / ujian', 'desc' => 'Opsional sesuai kebijakan.', 'active' => false],
        ['key' => 'announce', 'label' => 'Pengumuman hasil', 'desc' => 'Publikasi status akhir.', 'active' => false],
    ];
@endphp

<x-admin-layout title="Tahap & alur seleksi" :breadcrumbs="[['label' => 'Tahap & alur']]">
    <div class="space-y-6">
        <div>
            <h2 class="text-lg font-bold text-gray-900">Konfigurasi alur</h2>
            <p class="text-sm text-gray-500 mt-1 max-w-2xl">Mencermati timeline di halaman status pendaftar—urutan tahap
                dapat diaktifkan, diganti label, atau dihubungkan otomatis ke notifikasi.</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-4 md:p-6 border-b border-gray-50 flex flex-wrap gap-3 justify-between items-center">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Urutan pipeline</span>
                <button type="button" onclick="showToast('Simpan alur (stub)', 'success')"
                    class="text-sm font-semibold text-emerald-600 hover:text-emerald-800">Simpan perubahan</button>
            </div>
            <ol class="divide-y divide-gray-50">
                @foreach ($stages as $i => $stage)
                    <li class="p-4 md:p-6 flex flex-col md:flex-row md:items-center gap-4 hover:bg-gray-50/50 transition-colors">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border-2 {{ $stage['active'] ? 'border-emerald-500 bg-emerald-50 text-emerald-700' : 'border-gray-200 text-gray-400' }} font-bold text-sm">
                            {{ $i + 1 }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-900">{{ $stage['label'] }}</p>
                            <p class="text-sm text-gray-500">{{ $stage['desc'] }}</p>
                        </div>
                        <div class="flex items-center gap-3 shrink-0">
                            <label class="flex items-center gap-2 text-xs text-gray-600 cursor-pointer">
                                <input type="checkbox" class="rounded border-gray-300 text-emerald-600"
                                    {{ $stage['active'] ? 'checked' : '' }}>
                                Aktif
                            </label>
                            <button type="button" class="text-xs font-semibold text-gray-500 hover:text-gray-800">Ubah
                                label</button>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</x-admin-layout>
