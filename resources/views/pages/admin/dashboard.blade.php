@php
    $kpis = config('ppdb_admin.dashboard_kpis', []);
    $kpiValues = config('ppdb_admin.dashboard_kpi_demo_values', []);
    $trend = config('ppdb_admin.charts_demo.trend_registrations_by_week', []);
    $distribution = config('ppdb_admin.charts_demo.distribution_by_stage', []);
    $activity = config('ppdb_admin.activity_feed_demo', []);
    $logs = config('ppdb_admin.system_log_demo', []);
@endphp

<x-admin-layout title="Ringkasan Operasional" :breadcrumbs="[['label' => 'Dashboard']]">
    <div class="space-y-8">
        
        {{-- Welcome Header --}}
        <div class="bg-emerald-950 rounded-lg p-8 text-white relative overflow-hidden shadow-2xl shadow-emerald-950/20" data-aos="fade-down">
            
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black mb-2 tracking-tight">Halo, Administrator!</h1>
                    <p class="text-emerald-100/60 max-w-xl text-lg">
                        Selamat datang di pusat kendali PPDB SMK AL-MUJTAMA'. Pantau seluruh aplikasi dan verifikasi berkas pendaftar di sini.
                    </p>
                </div>
                <div class="flex gap-4">
                    <div class="text-center px-6 py-3 bg-white/10 rounded-lg border border-white/10 backdrop-blur-md">
                        <p class="text-[10px] font-black text-yellow-500 uppercase tracking-widest mb-1">Status Sistem</p>
                        <p class="font-bold">AKTIF</p>
                    </div>
                    <div class="text-center px-6 py-3 bg-white/10 rounded-lg border border-white/10 backdrop-blur-md">
                        <p class="text-[10px] font-black text-yellow-500 uppercase tracking-widest mb-1">Tahun Ajaran</p>
                        <p class="font-bold">2026/2027</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- KPI Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6" data-aos="fade-up">
            @foreach ($kpis as $kpi)
                <div class="bg-white p-6 rounded-lg border border-slate-100 shadow-sm transition-all hover:shadow-lg hover:-translate-y-1">
                    <div class="flex justify-between items-start mb-4">
                        <div @class([
                            'size-12 rounded-lg flex items-center justify-center shadow-lg',
                            'bg-emerald-900 text-white shadow-emerald-900/20' => ($kpi['tone'] ?? 'emerald') == 'emerald',
                            'bg-blue-600 text-white shadow-blue-600/20' => ($kpi['tone'] ?? 'emerald') == 'blue',
                            'bg-yellow-500 text-green-950 shadow-yellow-500/20' => ($kpi['tone'] ?? 'emerald') == 'amber',
                            'bg-red-600 text-white shadow-red-600/20' => ($kpi['tone'] ?? 'emerald') == 'red',
                        ])>
                            <iconify-icon icon="lucide:{{ $kpi['icon'] ?? 'bar-chart' }}" class="text-2xl"></iconify-icon>
                        </div>
                        <span class="text-xs font-black text-slate-300 uppercase">Live</span>
                    </div>
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">{{ $kpi['label'] }}</h3>
                    <p class="text-3xl font-black text-green-950">{{ number_format($kpiValues[$kpi['id']] ?? 0) }}</p>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            {{-- Charts --}}
            <div class="lg:col-span-8 space-y-6" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-white p-8 rounded-lg border border-slate-100 shadow-sm">
                    <h3 class="text-lg font-black text-green-950 mb-8 uppercase tracking-wide">Tren Pendaftaran Mingguan</h3>
                    <x-admin.chart-bar-trend :points="$trend" />
                </div>
                
                <div class="bg-white p-8 rounded-lg border border-slate-100 shadow-sm">
                    <h3 class="text-lg font-black text-green-950 mb-8 uppercase tracking-wide">Distribusi Tahapan Siswa</h3>
                    <x-admin.chart-distribution :segments="$distribution" />
                </div>
            </div>

            {{-- Feeds --}}
            <div class="lg:col-span-4 space-y-6" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white rounded-lg border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                        <h3 class="font-black text-green-950 uppercase text-xs tracking-widest">Aktivitas Pendaftar</h3>
                        <iconify-icon icon="lucide:clock" class="text-slate-400"></iconify-icon>
                    </div>
                    <div class="p-6">
                        <x-admin.activity-feed :items="$activity" />
                    </div>
                </div>

                <div class="bg-emerald-950 rounded-lg border border-emerald-900 shadow-sm overflow-hidden text-white">
                    <div class="p-6 border-b border-white/5 flex items-center justify-between bg-white/5">
                        <h3 class="font-black text-yellow-500 uppercase text-xs tracking-widest">Sistem Log</h3>
                        <iconify-icon icon="lucide:scroll-text" class="text-emerald-500"></iconify-icon>
                    </div>
                    <div class="p-6">
                        <x-admin.system-log-panel :entries="$logs" />
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
