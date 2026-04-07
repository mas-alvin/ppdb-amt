<x-admin-layout title="Log aktivitas" :breadcrumbs="[['label' => 'Log aktivitas']]">
    <div class="mb-6">
        <h2 class="text-lg font-bold text-gray-900">Audit & jejak</h2>
        <p class="text-sm text-gray-500 mt-1 max-w-xl">Rekonsiliasi dengan <code
                class="text-xs bg-gray-100 px-1 rounded">audit_log</code> setelah integrasi backend.</p>
    </div>
    <x-admin.resource-table resource-key="activity" />
</x-admin-layout>
