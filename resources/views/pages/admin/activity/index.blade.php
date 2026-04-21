<x-admin-layout title="Riwayat Sistem" :breadcrumbs="[['label' => 'Riwayat']]">
    <div class="mb-8" data-aos="fade-down">
        <h2 class="text-2xl font-black text-green-950 uppercase tracking-tight">Audit & Riwayat Aktivitas</h2>
        <p class="text-sm text-slate-500 mt-1 max-w-2xl">Pantau jejak audit dan rekaman aktivitas sistem untuk memastikan transparansi dan keamanan operasional PPDB.</p>
    </div>
    <x-admin.resource-table resource-key="activity" />
</x-admin-layout>
