<x-admin-layout title="Aplikasi pendaftaran" :breadcrumbs="[['label' => 'Aplikasi pendaftaran']]">
    <div class="mb-6 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-gray-900">Manajemen aplikasi</h2>
            <p class="text-sm text-gray-500 mt-1 max-w-xl">Gabungan entitas data pribadi, orang tua, prestasi,
                kesejahteraan, dan asal sekolah dari wizard pendaftar.</p>
        </div>
        <button type="button" onclick="showToast('Ekspor CSV (stub)', 'info')"
            class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition-colors">
            Ekspor ringkas
        </button>
    </div>
    <x-admin.resource-table resource-key="registrations" />
</x-admin-layout>
