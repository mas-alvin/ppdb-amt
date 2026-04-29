<x-admin-layout title="Edit Jurusan" :breadcrumbs="[['label' => 'Jurusan', 'url' => route('admin.jurusan.index')], ['label' => 'Edit']]">
    <div class="max-w-2xl">
        <div class="mb-8">
            <h2 class="text-2xl font-black text-green-950">Edit Jurusan</h2>
            <p class="text-slate-500 text-sm">Perbarui informasi kompetensi keahlian: {{ $jurusan->nama_jurusan }}</p>
        </div>

        <div class="bg-white rounded-lg border border-slate-100 shadow-sm p-8">
            <form action="{{ route('admin.jurusan.update', $jurusan) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-form-input label="Nama Jurusan" name="nama_jurusan" placeholder="Contoh: Rekayasa Perangkat Lunak" required icon="book-open" :value="old('nama_jurusan', $jurusan->nama_jurusan)" />
                    <x-form-input label="Kode Jurusan" name="kode_jurusan" placeholder="Contoh: RPL" required icon="hash" :value="old('kode_jurusan', $jurusan->kode_jurusan)" />
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/10 transition-all outline-none text-slate-700 font-medium" placeholder="Masukkan deskripsi jurusan...">{{ old('deskripsi', $jurusan->deskripsi) }}</textarea>
                </div>

                <x-form-select label="Status" name="is_active" :options="['1' => 'Aktif', '0' => 'Non-Aktif']" required icon="check-circle" :selected="old('is_active', $jurusan->is_active ? '1' : '0')" />

                <div class="pt-6 border-t border-slate-100 flex gap-4">
                    <button type="submit" class="px-8 py-3 bg-emerald-900 text-white font-black rounded-lg shadow-xl shadow-emerald-900/20 hover:bg-emerald-800 transition-all flex items-center gap-2">
                        SIMPAN PERUBAHAN
                    </button>
                    <a href="{{ route('admin.jurusan.index') }}" class="px-8 py-3 bg-slate-100 text-slate-600 font-black rounded-lg hover:bg-slate-200 transition-all">
                        BATAL
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
