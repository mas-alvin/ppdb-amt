<x-admin-layout title="Antrian dokumen" :breadcrumbs="[['label' => 'Antrian dokumen']]">
    <div class="mb-6">
        <h2 class="text-lg font-bold text-gray-900">Verifikasi berkas</h2>
        <p class="text-sm text-gray-500 mt-1 max-w-xl">Cermin dari halaman unggah pendaftar: ijazah, SKHUN, KK, akta,
            pas foto, dan tipe tambahan yang Anda konfigurasikan.</p>
    </div>
    <x-admin.resource-table resource-key="documents" />
</x-admin-layout>
