<x-admin-layout title="Data Pendaftar Siswa" :breadcrumbs="[['label' => 'Pendaftar']]">
    <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between gap-4" data-aos="fade-down">
        <div>
            <h2 class="text-2xl font-black text-green-950 uppercase tracking-tight">Manajemen Data Siswa</h2>
            <p class="text-sm text-slate-500 mt-1 max-w-2xl">Kelola seluruh data formulir pendaftaran mulai dari data pribadi, orang tua, hingga riwayat sekolah asal calon siswa.</p>
        </div>
        <button type="button" onclick="showToast('Ekspor CSV (stub)', 'info')"
            class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition-colors">
            Ekspor ringkas
        </button>
    </div>
    <x-admin.resource-table resource-key="registrations" />
</x-admin-layout>
