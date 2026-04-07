<x-admin-layout title="Pengguna portal" :breadcrumbs="[['label' => 'Pengguna portal']]">
    <div class="mb-6">
        <h2 class="text-lg font-bold text-gray-900">Akun calon siswa</h2>
        <p class="text-sm text-gray-500 mt-1 max-w-xl">Terhubung ke entitas <code
                class="text-xs bg-gray-100 px-1 rounded">portal_user</code> dan autentikasi.</p>
    </div>
    <x-admin.resource-table resource-key="portal_users" />
</x-admin-layout>
