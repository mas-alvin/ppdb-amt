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
        detailOpen: false,
        editOpen: false,
        addOpen: false,
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
        openDetail(row) { this.activeRow = row; this.detailOpen = true; },
        openEdit(row) { this.activeRow = row; this.editOpen = true; },
        filteredRows() {
            const q = this.search.toLowerCase();
            if (!q) return this.rows;
            return this.rows.filter(r => JSON.stringify(r).toLowerCase().includes(q));
        },
        confirmDelete() {
            if (!this.selected.length) return;
            
            Swal.fire({
                title: 'Hapus Data?',
                text: 'Sebanyak ' + this.selected.length + ' item terpilih akan dihapus permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#064e3b',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'YA, HAPUS',
                cancelButtonText: 'BATAL'
            }).then((result) => {
                if (result.isConfirmed) {
                    showToast('Data berhasil dihapus', 'success');
                    this.selected = [];
                }
            });
        },
        deleteOne(id) {
            Swal.fire({
                title: 'Hapus Item?',
                text: 'Data pendaftar ini akan dihapus dari sistem.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#064e3b',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'HAPUS',
                cancelButtonText: 'BATAL'
            }).then((result) => {
                if (result.isConfirmed) {
                    showToast('Item berhasil dihapus', 'success');
                }
            });
        }
    }">
    
    {{-- Table Header / Actions --}}
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-2">
            @foreach ($filters as $filter)
                <label class="sr-only" for="f-{{ $filter['key'] ?? '' }}">{{ $filter['label'] ?? '' }}</label>
                <select id="f-{{ $filter['key'] ?? '' }}"
                    class="text-xs border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white font-bold uppercase tracking-wider">
                    @foreach ($filter['options'] ?? [] as $optVal => $optLabel)
                        <option value="{{ $optVal }}">{{ $optLabel }}</option>
                    @endforeach
                </select>
            @endforeach
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <input type="search" x-model.debounce.300ms="search" placeholder="Cari data..."
                class="text-sm border-slate-200 rounded-lg w-full sm:w-64 focus:ring-green-900 focus:border-green-900"
                autocomplete="off">
            
            <div class="flex items-center gap-2">
                <button type="button" @click="confirmDelete()"
                    class="text-xs px-4 py-2 rounded-lg border border-red-200 text-red-600 font-bold uppercase tracking-widest hover:bg-red-50 disabled:opacity-40 transition-all"
                    :disabled="selected.length === 0">
                    <iconify-icon icon="lucide:trash-2" class="mr-1"></iconify-icon> HAPUS
                </button>
                <button type="button" @click="addOpen = true"
                    class="text-xs px-4 py-2 rounded-lg bg-green-900 text-white font-bold uppercase tracking-widest hover:bg-green-800 shadow-lg shadow-green-900/20 transition-all">
                    <iconify-icon icon="lucide:plus" class="mr-1"></iconify-icon> TAMBAH
                </button>
            </div>
        </div>
    </div>

    {{-- Main Table --}}
    <div class="bg-white rounded-lg border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">
                    <tr>
                        <th class="px-6 py-4 w-10">
                            <input type="checkbox" class="rounded-lg border-slate-300 text-green-900 focus:ring-green-900"
                                @change="toggleAll($event)">
                        </th>
                        @foreach ($columns as $col)
                            <th class="px-6 py-4 whitespace-nowrap">{{ $col['label'] ?? $col['key'] }}</th>
                        @endforeach
                        <th class="px-6 py-4 text-right w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <template x-if="filteredRows().length === 0">
                        <tr>
                            <td colspan="{{ count($columns) + 2 }}" class="p-0">
                                <x-admin.empty-state class="rounded-none border-0 bg-transparent"
                                    :title="$empty['title'] ?? 'Kosong'" :description="$empty['description'] ?? null" />
                            </td>
                        </tr>
                    </template>
                    <template x-for="row in filteredRows()" :key="row.id">
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <input type="checkbox" class="rounded-lg border-slate-300 text-green-900 focus:ring-green-900"
                                    :checked="selected.includes(row.id)" @change="toggleOne(row.id)">
                            </td>
                            @foreach ($columns as $col)
                                @php $k = $col['key']; @endphp
                                <td class="px-6 py-4 text-slate-600 whitespace-nowrap max-w-[14rem] truncate font-medium"
                                    x-text="row['{{ $k }}']"></td>
                            @endforeach
                            <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                <button type="button" @click="openDetail(row)"
                                    class="text-green-700 hover:text-green-900 text-[10px] font-black uppercase tracking-widest transition-colors">DETAIL</button>
                                <button type="button" @click="openEdit(row)"
                                    class="text-slate-400 hover:text-slate-900 text-[10px] font-black uppercase tracking-widest transition-colors">EDIT</button>
                                <button type="button" @click="deleteOne(row.id)"
                                    class="text-red-400 hover:text-red-700 text-[10px] font-black uppercase tracking-widest transition-colors">HAPUS</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <div
            class="px-6 py-4 border-t border-slate-50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-50/30">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest" x-text="'Menampilkan ' + filteredRows().length + ' data dari total ' + rows.length"></span>
            <div class="flex gap-2">
                <button type="button"
                    class="px-4 py-1 text-[10px] font-black uppercase tracking-widest rounded-lg border border-slate-200 text-slate-300 cursor-not-allowed">SEBELUMNYA</button>
                <button type="button"
                    class="px-4 py-1 text-[10px] font-black uppercase tracking-widest rounded-lg border border-slate-200 text-slate-300 cursor-not-allowed">BERIKUTNYA</button>
            </div>
        </div>
    </div>

    {{-- MODAL DETAIL --}}
    <x-admin.modal id="detail" title="Detail Data Pendaftar" size="lg">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-show="activeRow">
            <template x-for="(val, key) in activeRow" :key="key">
                <div class="bg-slate-50 p-4 rounded-lg border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1" x-text="key"></p>
                    <p class="font-bold text-green-950 break-all" x-text="val"></p>
                </div>
            </template>
        </div>
        <x-slot name="footer">
            <button @click="detailOpen = false" class="px-6 py-2.5 rounded-lg bg-slate-100 text-slate-600 text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all">TUTUP</button>
            <button @click="detailOpen = false; openEdit(activeRow)" class="px-6 py-2.5 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all">EDIT DATA</button>
        </x-slot>
    </x-admin.modal>

    {{-- MODAL EDIT --}}
    <x-admin.modal id="edit" title="Ubah Data Pendaftar" size="lg">
        <form @submit.prevent="editOpen = false; showToast('Perubahan berhasil disimpan', 'success')" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <template x-for="(val, key) in activeRow" :key="key">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2" x-text="key"></label>
                        <input type="text" :value="val" 
                               class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                    </div>
                </template>
            </div>
            <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                <button type="button" @click="editOpen = false" class="px-6 py-2.5 rounded-lg bg-slate-100 text-slate-600 text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all">BATAL</button>
                <button type="submit" class="px-8 py-2.5 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all">SIMPAN PERUBAHAN</button>
            </div>
        </form>
    </x-admin.modal>

    {{-- MODAL ADD --}}
    <x-admin.modal id="add" title="Tambah Pendaftar Baru" size="lg">
        <form @submit.prevent="addOpen = false; showToast('Data pendaftar berhasil ditambahkan', 'success')" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($columns as $col)
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">{{ $col['label'] }}</label>
                        <input type="text" placeholder="Masukkan {{ strtolower($col['label']) }}..." 
                               class="w-full text-sm border-slate-200 rounded-lg focus:ring-green-900 focus:border-green-900 bg-white">
                    </div>
                @endforeach
            </div>
            <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                <button type="button" @click="addOpen = false" class="px-6 py-2.5 rounded-lg bg-slate-100 text-slate-600 text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all">BATAL</button>
                <button type="submit" class="px-8 py-2.5 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all">SIMPAN DATA</button>
            </div>
        </form>
    </x-admin.modal>
</div>
