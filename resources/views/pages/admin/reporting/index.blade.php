@php
    $kpis = config('ppdb_admin.dashboard_kpis', []);
    $kpiValues = config('ppdb_admin.dashboard_kpi_demo_values', []);
    $trend = config('ppdb_admin.charts_demo.trend_registrations_by_week', []);
    $distribution = config('ppdb_admin.charts_demo.distribution_by_stage', []);
@endphp

<x-admin-layout title="Analitik & Laporan" :breadcrumbs="[['label' => 'Analitik']]">
    <div class="space-y-8" x-data="{ from: '2026-03-01', to: '2026-03-28' }">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4" data-aos="fade-down">
            <div>
                <h2 class="text-2xl font-black text-green-950 uppercase tracking-tight">Analitik & Laporan PPDB</h2>
                <p class="text-sm text-slate-500 mt-1 max-w-xl">Pantau statistik pendaftaran secara real-time dan ekspor data laporan untuk kebutuhan arsip atau pengolahan data lanjut.</p>
            </div>
            <div class="flex flex-wrap items-end gap-3">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Dari Tanggal</label>
                    <input type="date" x-model="from"
                        class="text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Sampai Tanggal</label>
                    <input type="date" x-model="to"
                        class="text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                </div>
                <button type="button" onclick="showToast('Memuat ulang agregasi (stub)', 'info')"
                    class="px-6 py-2 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 transition-all shadow-xl shadow-green-900/20 h-[38px]">
                    FILTER
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
