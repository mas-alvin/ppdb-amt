@php
    $waves = [
        ['nama' => 'Gelombang I', 'buka' => '2026-03-01', 'tutup' => '2026-04-15', 'kuota' => 120, 'status' => 'Buka'],
        ['nama' => 'Gelombang II', 'buka' => '2026-05-01', 'tutup' => '2026-06-30', 'kuota' => 80, 'status' => 'Draf'],
    ];
@endphp

<x-admin-layout title="Gelombang & jadwal" :breadcrumbs="[['label' => 'Gelombang & jadwal']]">
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Jadwal penerimaan</h2>
                <p class="text-sm text-gray-500 mt-1 max-w-xl">Menggantikan teks statis batas waktu di dasbor pendaftar
                    dengan sumber konfigurasi terpusat.</p>
            </div>
            <button type="button" onclick="showToast('Tambah gelombang (stub)', 'info')"
                class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700">
                Gelombang baru
            </button>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                    <tr>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Buka</th>
                        <th class="px-4 py-3">Tutup</th>
                        <th class="px-4 py-3 text-right">Kuota</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($waves as $w)
                        <tr class="hover:bg-gray-50/80">
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $w['nama'] }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $w['buka'] }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $w['tutup'] }}</td>
                            <td class="px-4 py-3 text-right tabular-nums">{{ $w['kuota'] }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold {{ $w['status'] === 'Buka' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">{{ $w['status'] }}</span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <button type="button" onclick="showToast('Edit jadwal (stub)', 'info')"
                                    class="text-emerald-600 text-xs font-semibold">Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
