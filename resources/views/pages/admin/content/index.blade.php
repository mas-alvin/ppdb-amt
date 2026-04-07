<x-admin-layout title="Konten & pengumuman" :breadcrumbs="[['label' => 'Konten & pengumuman']]">
    <div class="mb-6 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-gray-900">Konten portal publik</h2>
            <p class="text-sm text-gray-500 mt-1 max-w-xl">Mengisi widget berita/pengumuman yang terlihat di dasbor
                pendaftar.</p>
        </div>
        <button type="button" onclick="showToast('Editor konten (stub)', 'info')"
            class="px-4 py-2 rounded-lg border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50">
            Buat draf
        </button>
    </div>
    <x-admin.resource-table resource-key="content" />
</x-admin-layout>
