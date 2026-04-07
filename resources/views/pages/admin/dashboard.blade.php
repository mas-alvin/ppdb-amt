@php
    $kpis = config('ppdb_admin.dashboard_kpis', []);
    $kpiValues = config('ppdb_admin.dashboard_kpi_demo_values', []);
    $trend = config('ppdb_admin.charts_demo.trend_registrations_by_week', []);
    $distribution = config('ppdb_admin.charts_demo.distribution_by_stage', []);
    $activity = config('ppdb_admin.activity_feed_demo', []);
    $logs = config('ppdb_admin.system_log_demo', []);
@endphp

<x-admin-layout title="Ringkasan operasional" :breadcrumbs="[['label' => 'Ringkasan']]">
    <div class="space-y-8">
        <p class="text-sm text-gray-500 max-w-2xl">
            Indikator dan visualisasi di bawah memetakan data domain PPDB dari alur pendaftar (formulir, dokumen,
            tahapan). Nilai contoh siap diganti query agregat.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 md:gap-6">
            @foreach ($kpis as $kpi)
                <x-admin.kpi-card :label="$kpi['label']" :value="number_format($kpiValues[$kpi['id']] ?? 0)" :tone="$kpi['tone'] ?? 'emerald'"
                    :hint="'Sumber: ' . ($kpi['entity_key'] ?? '') . ' · ' . ($kpi['metric'] ?? '')" />
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">
            <x-admin.chart-bar-trend title="Tren pengajuan (contoh mingguan)" :points="$trend" />
            <x-admin.chart-distribution title="Distribusi menurut tahap pipeline" :segments="$distribution" />
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6 items-start">
            <x-admin.activity-feed title="Aktivitas pendaftar" :items="$activity" />
            <x-admin.system-log-panel title="Log sistem" :entries="$logs" />
        </div>

        {{-- Contoh skeleton load --}}
        <details class="group rounded-xl border border-gray-100 bg-white p-4 text-sm">
            <summary class="cursor-pointer font-semibold text-gray-700 list-none flex items-center gap-2">
                <span class="transition group-open:rotate-90">▸</span>
                Pratinjau status pemuatan (skeleton)
            </summary>
            <div class="mt-4">
                <x-admin.skeleton-table :rows="4" :cols="4" />
            </div>
        </details>
    </div>
</x-admin-layout>
