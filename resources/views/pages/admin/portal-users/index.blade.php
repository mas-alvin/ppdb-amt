<x-admin-layout title="Akun Siswa" :breadcrumbs="[['label' => 'Akun Siswa']]">
    <div class="mb-8" data-aos="fade-down">
        <h2 class="text-2xl font-black text-green-950 uppercase tracking-tight">Manajemen Akun Siswa</h2>
        <p class="text-sm text-slate-500 mt-1 max-w-2xl">Kelola data login, status aktivasi, dan informasi autentikasi untuk seluruh calon siswa pendaftar.</p>
    </div>
    <x-admin.resource-table resource-key="portal_users" />
</x-admin-layout>
