<x-admin-layout title="Informasi & Pengumuman" :breadcrumbs="[['label' => 'Informasi']]">
    <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between gap-4" data-aos="fade-down">
        <div>
            <h2 class="text-2xl font-black text-green-950 uppercase tracking-tight">Manajemen Informasi & Berita</h2>
            <p class="text-sm text-slate-500 mt-1 max-w-2xl">Kelola seluruh konten publik, berita, dan pengumuman resmi yang akan tampil pada dashboard portal siswa.</p>
        </div>
        <button type="button" onclick="showToast('Editor konten (stub)', 'info')"
            class="px-6 py-2.5 rounded-lg bg-green-900 text-white text-sm font-black hover:bg-green-800 transition-all shadow-xl shadow-green-900/20">
            BUAT PENGUMUMAN
        </button>
    </div>
    <x-admin.resource-table resource-key="content" />
</x-admin-layout>
