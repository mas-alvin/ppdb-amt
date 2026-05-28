@php
    $tabs = [
        ['id' => 'general', 'label' => 'Umum'],
        ['id' => 'brochure', 'label' => 'Brosur Pendaftaran'],
        ['id' => 'documents', 'label' => 'Jenis dokumen'],
        ['id' => 'notifications', 'label' => 'Notifikasi'],
        ['id' => 'security', 'label' => 'Keamanan'],
    ];
@endphp

<x-admin-layout title="Konfigurasi Sistem" :breadcrumbs="[['label' => 'Pengaturan']]">
    <div class="mb-8" data-aos="fade-down">
        <h2 class="text-2xl font-black text-green-950 uppercase tracking-tight">Konfigurasi Sistem PPDB</h2>
        <p class="text-sm text-slate-500 mt-1 max-w-2xl">Atur identitas lembaga, brosur pendaftaran, parameter dokumen, kanal notifikasi, dan kebijakan keamanan aplikasi secara terpusat.</p>
    </div>

    {{-- Notification Toast / Flash message --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-900 rounded-lg text-sm font-bold flex items-center gap-3">
            <iconify-icon icon="lucide:check-circle" class="text-xl text-green-900"></iconify-icon>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-900 rounded-lg text-sm font-bold flex items-center gap-3">
            <iconify-icon icon="lucide:alert-circle" class="text-xl text-red-900"></iconify-icon>
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg border border-slate-100 shadow-sm overflow-hidden" x-data="{ tab: 'general' }" data-aos="fade-up">
        <div class="border-b border-slate-100 flex overflow-x-auto bg-slate-50/50">
            @foreach ($tabs as $t)
                <button type="button" @click="tab = '{{ $t['id'] }}'"
                    :class="tab === '{{ $t['id'] }}'
                        ? 'border-b-2 border-green-900 text-green-900 bg-white'
                        : 'text-slate-400 hover:text-slate-600'"
                    class="px-8 py-4 text-xs font-black uppercase tracking-widest whitespace-nowrap transition-all border-b-2 border-transparent">
                    {{ $t['label'] }}
                </button>
            @endforeach
        </div>

        <div class="p-6 space-y-6">
            {{-- UMUM TAB --}}
            <div x-show="tab === 'general'" x-transition>
                <h3 class="text-sm font-bold text-gray-900 mb-4">Identitas & batasan</h3>
                <form action="{{ route('admin.settings.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-3xl">
                    @csrf
                    <div class="md:col-span-2">
                        <x-form-input
                            name="school_name"
                            id="school_name"
                            label="Nama Lembaga"
                            value="{{ \App\Models\Setting::getValue('school_name', 'SMK AL-MUJTAMA\'') }}"
                            required />
                    </div>
                    <div>
                        <x-form-input
                            name="academic_year"
                            id="academic_year"
                            label="Tahun Pelajaran"
                            value="{{ \App\Models\Setting::getValue('academic_year', '2026/2027') }}"
                            placeholder="Contoh: 2026/2027"
                            required />
                    </div>
                    <div>
                        <x-form-input
                            type="number"
                            name="max_upload_size"
                            id="max_upload_size"
                            label="Ukuran Unggah Maks (MB)"
                            value="{{ \App\Models\Setting::getValue('max_upload_size', 2048) / 1024 }}"
                            min="1"
                            required />
                    </div>
                    <div>
                        @php
                            $tz = \App\Models\Setting::getValue('timezone', 'WIB');
                            $tzOptions = [
                                'WIB' => 'WIB (Waktu Indonesia Barat)',
                                'WITA' => 'WITA (Waktu Indonesia Tengah)',
                                'WIT' => 'WIT (Waktu Indonesia Timur)',
                            ];
                        @endphp
                        <x-form-select
                            name="timezone"
                            id="timezone"
                            label="Zona Waktu"
                            :options="$tzOptions"
                            :selected="$tz"
                            required />
                    </div>
                    <div class="md:col-span-2">
                        <x-form-textarea
                            name="school_address"
                            id="school_address"
                            label="Alamat Lembaga"
                            value="{{ \App\Models\Setting::getValue('school_address', 'Jl. Raya Pegantenan No.KM. 09, Tengracak, Plakpak, Kec. Pegantenan, Kabupaten Pamekasan, Jawa Timur 69361') }}"
                            placeholder="Alamat lengkap sekolah..."
                            rows="3"
                            required />
                    </div>
                    <div class="md:col-span-2 pt-4">
                        <button type="submit"
                            class="px-8 py-3 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 transition-all shadow-xl shadow-green-900/20">
                            SIMPAN KONFIGURASI
                        </button>
                    </div>
                </form>
            </div>

            {{-- BROSUR TAB --}}
            <div x-show="tab === 'brochure'" x-transition style="display: none;">
                <h3 class="text-sm font-bold text-gray-900 mb-2">Unggah Brosur Pendaftaran</h3>
                <p class="text-xs text-slate-500 mb-6 max-w-xl">Materi brosur PPDB resmi yang Anda unggah di sini akan langsung tampil pada menu utama website depan serta dapat diunduh oleh calon siswa.</p>
                
                <form action="{{ route('admin.settings.brochure') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-xl">
                    @csrf
                    <div class="p-8 rounded-xl border-2 border-dashed border-slate-200 hover:border-green-800 transition-colors flex flex-col items-center justify-center bg-slate-50 text-center relative group">
                        <iconify-icon icon="lucide:file-up" class="text-4xl text-slate-400 group-hover:text-green-800 transition-colors mb-3"></iconify-icon>
                        <span class="text-sm font-bold text-slate-700">Pilih berkas brosur pendaftaran</span>
                        <span class="text-xs text-slate-400 mt-1">Format berkas: PDF, JPG, JPEG, PNG (Maksimal 5MB)</span>
                        <input type="file" name="brochure" class="absolute inset-0 opacity-0 cursor-pointer" required onchange="updateFileName(this)">
                        
                        <div id="file-name-preview" class="hidden mt-4 px-4 py-2 bg-green-50 text-green-900 rounded-lg text-xs font-bold border border-green-100 items-center gap-2">
                            <iconify-icon icon="lucide:check-circle"></iconify-icon>
                            <span id="selected-file-name">filename.pdf</span>
                        </div>
                    </div>

                    @php
                        $currentBrochure = \App\Models\Setting::getValue('school_brochure');
                    @endphp

                    @if($currentBrochure)
                        <div class="p-4 bg-slate-50 rounded-lg border border-slate-200 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="size-10 bg-green-900/10 rounded-lg flex items-center justify-center text-green-900">
                                    <iconify-icon icon="lucide:file-check" class="text-xl"></iconify-icon>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-700">Brosur Pendaftaran Terpasang</p>
                                    <div class="flex items-center gap-3 mt-1">
                                        <a href="{{ asset('storage/' . $currentBrochure) }}" target="_blank" class="text-[11px] text-green-800 hover:underline font-semibold flex items-center gap-1">
                                            Buka brosur aktif <iconify-icon icon="lucide:external-link" class="text-[10px]"></iconify-icon>
                                        </a>
                                        <span class="text-slate-300">|</span>
                                        <form action="{{ route('admin.settings.brochure.delete') }}" method="POST" onsubmit="return confirmDelete(event, 'Apakah Anda yakin ingin menghapus brosur ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-[11px] text-red-600 hover:underline font-semibold flex items-center gap-1">
                                                <iconify-icon icon="lucide:trash-2" class="text-xs"></iconify-icon>
                                                Hapus brosur
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <span class="text-[10px] px-2.5 py-1 bg-green-900 text-white rounded font-bold uppercase tracking-wider">AKTIF</span>
                        </div>
                    @endif

                    <button type="submit"
                        class="px-8 py-3 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all">UNGGAH BROSUR</button>
                </form>
            </div>

            {{-- DOKUMEN TAB (MOCK INTERACTIVE) --}}
            <div x-show="tab === 'documents'" x-transition style="display: none;">
                <h3 class="text-sm font-bold text-gray-900 mb-4">Tipe dokumen wajib</h3>
                <p class="text-sm text-gray-500 mb-4">Selaras dengan kartu dokumen di halaman unggah pendaftar.</p>
                <ul class="space-y-2 max-w-xl">
                    @foreach (['Ijazah Terakhir', 'SKHUN / Keterangan Lulus', 'Kartu Keluarga (KK)', 'Akta Kelahiran', 'Pas Foto 3x4'] as $doc)
                        <li class="flex items-center gap-3 text-sm">
                            <input type="checkbox" checked disabled class="rounded border-gray-300 text-emerald-600 cursor-not-allowed">
                            <span class="text-slate-700">{{ $doc }}</span>
                        </li>
                    @endforeach
                </ul>
                <button type="button" onclick="showToast('Daftar dokumen diperbarui.', 'success')"
                    class="mt-6 px-8 py-3 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all">SIMPAN DAFTAR</button>
            </div>

            {{-- NOTIFIKASI TAB (MOCK INTERACTIVE) --}}
            <div x-show="tab === 'notifications'" x-transition style="display: none;">
                <h3 class="text-sm font-bold text-gray-900 mb-4">Kanal pemberitahuan</h3>
                <form class="space-y-3 max-w-xl"
                    onsubmit="event.preventDefault(); showToast('Preferensi notifikasi disimpan.', 'success');">
                    <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                        <input type="checkbox" checked class="rounded border-gray-300 text-emerald-600"> Email
                        transaksional
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                        <input type="checkbox" class="rounded border-gray-300 text-emerald-600"> WhatsApp (gateway
                        eksternal)
                    </label>
                    <button type="submit"
                        class="px-8 py-3 rounded-lg bg-green-900 text-white text-xs font-black uppercase tracking-widest hover:bg-green-800 shadow-xl shadow-green-900/20 transition-all">SIMPAN PREFERENSI</button>
                </form>
            </div>

            {{-- KEAMANAN TAB (MOCK INTERACTIVE) --}}
            <div x-show="tab === 'security'" x-transition style="display: none;">
                <h3 class="text-sm font-bold text-gray-900 mb-4">Kebijakan sesi</h3>
                <p class="text-sm text-gray-500 mb-4">TTL sesi admin, 2FA, dan pembatasan IP dapat dihubungkan di
                    lapisan auth.</p>
                <button type="button" onclick="showToast('Panel keamanan lanjutan belum terhubung.', 'warning')"
                    class="px-4 py-2 rounded-lg border border-gray-200 text-sm font-semibold text-gray-700">Buka
                    konfigurasi lanjutan</button>
            </div>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            const preview = document.getElementById('file-name-preview');
            const span = document.getElementById('selected-file-name');
            if (input.files && input.files.length > 0) {
                span.textContent = input.files[0].name;
                preview.classList.remove('hidden');
                preview.classList.add('flex');
            } else {
                preview.classList.add('hidden');
                preview.classList.remove('flex');
            }
        }
    </script>
</x-admin-layout>
