@php
    $kpis = config('ppdb_admin.dashboard_kpis', []);
    $kpiValues = config('ppdb_admin.dashboard_kpi_demo_values', []);
    $trend = config('ppdb_admin.charts_demo.trend_registrations_by_week', []);
    $distribution = config('ppdb_admin.charts_demo.distribution_by_stage', []);
@endphp

<x-admin-layout title="Analitik & ekspor" :breadcrumbs="[['label' => 'Analitik & ekspor']]">
    <div class="space-y-8" x-data="{ from: '2026-03-01', to: '2026-03-28' }">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Laporan agregat</h2>
                <p class="text-sm text-gray-500 mt-1 max-w-xl">Filter rentang tanggal; ekspor mengikuti skema entitas
                    PPDB untuk BI atau arsip.</p>
            </div>
            <div class="flex flex-wrap items-end gap-3">
                <div>
                    <label class="block text-[10px] font-semibold text-gray-500 uppercase mb-1">Dari</label>
                    <input type="date" x-model="from"
                        class="text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-[10px] font-semibold text-gray-500 uppercase mb-1">Sampai</label>
                    <input type="date" x-model="to"
                        class="text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <button type="button" onclick="showToast('Memuat ulang agregasi (stub)', 'info')"
                    class="px-4 py-2 rounded-lg bg-gray-900 text-white text-sm font-semibold hover:bg-gray-800 h-[38px]">
                    Terapkan
                </button>
            </div>
        </div>

        <div class="flex flex-wrap gap-2">
            <button type="button" onclick="showToast('Menyiapkan PDF… (stub)', 'success')"
                class="px-4 py-2 rounded-lg border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                Ekspor PDF
            </button>
            <button type="button" onclick="showToast('Menyiapkan Excel… (stub)', 'success')"
                class="px-4 py-2 rounded-lg border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                Ekspor Excel
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($kpis as $kpi)
                <x-admin.kpi-card :label="$kpi['label']" :value="number_format($kpiValues[$kpi['id']] ?? 0)" :tone="$kpi['tone'] ?? 'slate'" />
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <x-admin.chart-bar-trend title="Volume pengajuan (periode dipilih)" :points="$trend" />
            <x-admin.chart-distribution title="Proporsi tahap" :segments="$distribution" />
        </div>
    </div>
</x-admin-layout>
