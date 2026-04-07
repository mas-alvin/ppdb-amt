@props([
    'resourceKey',
    'pageTitle' => null,
])

@php
    $schema = config("ppdb_admin.resource_tables.{$resourceKey}", []);
    $columns = $schema['columns'] ?? [];
    $rows = $schema['demo_rows'] ?? [];
    $filters = $schema['filters'] ?? [];
    $empty = $schema['empty'] ?? [];
@endphp

<div class="space-y-4"
    x-data="{
        search: '',
        selected: [],
        drawerOpen: false,
        activeRow: null,
        rows: @js($rows),
        toggleAll(e) {
            if (e.target.checked) this.selected = this.filteredRows().map(r => r.id);
            else this.selected = [];
        },
        toggleOne(id) {
            const i = this.selected.indexOf(id);
            if (i === -1) this.selected.push(id); else this.selected.splice(i, 1);
        },
        openDetail(row) { this.activeRow = row; this.drawerOpen = true; },
        filteredRows() {
            const q = this.search.toLowerCase();
            if (!q) return this.rows;
            return this.rows.filter(r => JSON.stringify(r).toLowerCase().includes(q));
        },
        confirmDelete() {
            if (this.selected.length && confirm('Hapus ' + this.selected.length + ' item terpilih?')) {
                showToast('Aksi massal terjadwal (stub backend)', 'info');
            }
        }
    }">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-2">
            @foreach ($filters as $filter)
                <label class="sr-only" for="f-{{ $filter['key'] ?? '' }}">{{ $filter['label'] ?? '' }}</label>
                <select id="f-{{ $filter['key'] ?? '' }}"
                    class="text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 bg-white">
                    @foreach ($filter['options'] ?? [] as $optVal => $optLabel)
                        <option value="{{ $optVal }}">{{ $optLabel }}</option>
                    @endforeach
                </select>
            @endforeach
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <input type="search" x-model.debounce.300ms="search" placeholder="Cari (langsung)…"
                class="text-sm border-gray-200 rounded-lg w-full sm:w-56 focus:ring-emerald-500 focus:border-emerald-500"
                autocomplete="off">
            <button type="button" @click="confirmDelete()"
                class="text-sm px-3 py-2 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 disabled:opacity-40"
                :disabled="selected.length === 0">
                Hapus terpilih
            </button>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                    <tr>
                        <th class="px-4 py-3 w-10">
                            <input type="checkbox" class="rounded border-gray-300 text-emerald-600"
                                @change="toggleAll($event)">
                        </th>
                        @foreach ($columns as $col)
                            <th class="px-4 py-3 whitespace-nowrap">{{ $col['label'] ?? $col['key'] }}</th>
                        @endforeach
                        <th class="px-4 py-3 text-right w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <template x-if="filteredRows().length === 0">
                        <tr>
                            <td colspan="{{ count($columns) + 2 }}" class="p-0">
                                <x-admin.empty-state class="rounded-none border-0 bg-transparent"
                                    :title="$empty['title'] ?? 'Kosong'" :description="$empty['description'] ?? null" />
                            </td>
                        </tr>
                    </template>
                    <template x-for="row in filteredRows()" :key="row.id">
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="px-4 py-3">
                                <input type="checkbox" class="rounded border-gray-300 text-emerald-600"
                                    :checked="selected.includes(row.id)" @change="toggleOne(row.id)">
                            </td>
                            @foreach ($columns as $col)
                                @php $k = $col['key']; @endphp
                                <td class="px-4 py-3 text-gray-800 whitespace-nowrap max-w-[14rem] truncate"
                                    x-text="row['{{ $k }}']"></td>
                            @endforeach
                            <td class="px-4 py-3 text-right space-x-1 whitespace-nowrap">
                                <button type="button" @click="openDetail(row)"
                                    class="text-emerald-600 hover:text-emerald-800 text-xs font-semibold">Detail</button>
                                <button type="button" @click="showToast('Form edit (stub)', 'info')"
                                    class="text-gray-600 hover:text-gray-900 text-xs font-semibold">Edit</button>
                                <button type="button"
                                    @click="if(confirm('Yakin hapus?')) showToast('Penghapusan dijadwalkan (stub)', 'warning')"
                                    class="text-red-600 hover:text-red-800 text-xs font-semibold">Hapus</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <div
            class="px-4 py-3 border-t border-gray-50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 text-xs text-gray-500">
            <span x-text="'Menampilkan ' + filteredRows().length + ' baris (demo)'"></span>
            <div class="flex gap-2">
                <button type="button"
                    class="px-3 py-1 rounded-lg border border-gray-200 opacity-50 cursor-not-allowed">Sebelumnya</button>
                <button type="button"
                    class="px-3 py-1 rounded-lg border border-gray-200 opacity-50 cursor-not-allowed">Berikutnya</button>
            </div>
        </div>
    </div>

    {{-- Panel detail --}}
    <div x-show="drawerOpen" x-transition.opacity class="fixed inset-0 z-50" style="display: none;">
        <div class="absolute inset-0 bg-black/40" @click="drawerOpen = false"></div>
        <div
            class="absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-2xl border-l border-gray-100 flex flex-col"
            x-show="drawerOpen" x-transition:enter="transition transform duration-200"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition transform duration-200" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full">
            <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-sm font-bold text-gray-900">Detail rekaman</h2>
                <button type="button" class="p-2 rounded-lg hover:bg-gray-100 text-gray-500" @click="drawerOpen = false"
                    aria-label="Tutup">✕</button>
            </div>
            <div class="flex-1 overflow-y-auto p-4 space-y-4 text-sm" x-show="activeRow">
                <template x-for="(val, key) in activeRow" :key="key">
                    <div class="border-b border-gray-50 pb-3">
                        <p class="text-[10px] uppercase tracking-wider text-gray-400" x-text="key"></p>
                        <p class="font-medium text-gray-900 mt-1 break-all" x-text="val"></p>
                    </div>
                </template>
                <p class="text-xs text-gray-400">Relasi ke entitas lain (orang tua, dokumen…) disambungkan di lapisan
                    API.</p>
            </div>
        </div>
    </div>
</div>
