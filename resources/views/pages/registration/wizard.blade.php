<x-layout title="Pendaftaran Siswa Baru">
    <div class="min-h-screen bg-slate-50 dark:bg-background-dark py-12 px-4 sm:px-6 lg:px-8" x-data="{ step: 1 }">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-10">
                <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Formulir Pendaftaran</h1>
                <p class="mt-2 text-slate-500">Silakan lengkapi data pendaftaran Anda dengan benar sesuai dokumen asli.
                </p>
            </div>

            <!-- Step Indicator -->
            <x-registration.wizard-step-indicator ::active-step="step" />

            <!-- Wizard Form -->
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 overflow-hidden">
                <form action="#" method="POST" id="registrationForm"
                    onsubmit="event.preventDefault(); alert('Pendaftaran Berhasil Dikirim!'); window.location.href='/dashboard';">
                    @csrf

                    <!-- Step 1: Data Pribadi & Kontak -->
                    <div x-show="step === 1" x-transition class="p-8 space-y-8">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-6">
                                <span
                                    class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                    <iconify-icon icon="lucide:user" class="text-xl"></iconify-icon>
                                </span>
                                Data Pribadi
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <x-form-input label="Nama Lengkap (Sesuai Ijazah)" name="nama_lengkap"
                                    placeholder="Masukkan nama lengkap" required icon="user" />
                                <x-form-select label="Jenis Kelamin" name="jenis_kelamin" :options="['L' => 'Laki-laki', 'P' => 'Perempuan']" required
                                    icon="users-2" />
                                <x-form-input label="NISN (10 Digit)" name="nisn" placeholder="Contoh: 0012345678"
                                    required icon="hash" maxlength="10" />
                                <x-form-input label="NIK (16 Digit)" name="nik"
                                    placeholder="Contoh: 3201234567890123" required icon="id-card" maxlength="16" />
                                <x-form-input label="No. Akta Lahir" name="no_akta"
                                    placeholder="Masukkan nomor akta lahir" required icon="file-text" />
                                <x-form-select label="Agama" name="agama" :options="[
                                    'Islam' => 'Islam',
                                    'Kristen' => 'Kristen',
                                    'Katolik' => 'Katolik',
                                    'Hindu' => 'Hindu',
                                    'Budha' => 'Budha',
                                    'Lainnya' => 'Lainnya',
                                ]" required
                                    icon="heart" />
                                <x-form-select label="Kewarganegaraan" name="kewarganegaraan" :options="['WNI' => 'WNI', 'WNA' => 'WNA']" required
                                    icon="globe" />
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-100 dark:border-slate-800">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-6">
                                <span
                                    class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                    <iconify-icon icon="lucide:map-pin" class="text-xl"></iconify-icon>
                                </span>
                                Alamat Domisili
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <x-form-input label="Alamat / Jalan" name="alamat" placeholder="Jl. Contoh No. 123"
                                        required icon="home" />
                                </div>
                                <div class="grid grid-cols-2 gap-4 text-slate-700">
                                    <x-form-input label="RT" name="rt" placeholder="00" required />
                                    <x-form-input label="RW" name="rw" placeholder="00" required />
                                </div>
                                <x-form-input label="Dusun" name="dusun" placeholder="Nama Dusun" />
                                <x-form-input label="Kelurahan" name="kelurahan" placeholder="Nama Kelurahan"
                                    required />
                                <x-form-input label="Kecamatan" name="kecamatan" placeholder="Nama Kecamatan"
                                    required />
                                <x-form-input label="Kode Pos" name="kode_pos" placeholder="67xxx" required />
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-100 dark:border-slate-800">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-6">
                                <span
                                    class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                    <iconify-icon icon="lucide:phone" class="text-xl"></iconify-icon>
                                </span>
                                Kontak Aktif
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <x-form-input label="Nomor HP / WhatsApp" name="no_hp" placeholder="08123456789"
                                    required icon="smartphone" />
                                <x-form-input label="Email Aktif" type="email" name="email"
                                    placeholder="contoh@gmail.com" required icon="mail" />
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Data Orang Tua / Wali -->
                    <div x-show="step === 2" x-transition class="p-8 space-y-12">
                        @foreach (['Ayah Kandung', 'Ibu Kandung', 'Wali'] as $entity)
                            @php $prefix = strtolower(str_replace(' Kandung', '', $entity)); @endphp
                            <div>
                                <h3
                                    class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-6">
                                    <span
                                        class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                        <iconify-icon icon="lucide:{{ $prefix == 'wali' ? 'user-cog' : 'users' }}"
                                            class="text-xl"></iconify-icon>
                                    </span>
                                    Data {{ $entity }}
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="md:col-span-2">
                                        <x-form-input :label="'Nama Lengkap ' . $entity" :name="$prefix . '_nama'" :placeholder="'Nama ' . $entity"
                                            :required="$prefix != 'wali'" icon="user" />
                                    </div>
                                    <x-form-input label="NIK" :name="$prefix . '_nik'" placeholder="16 Digit NIK"
                                        :required="$prefix != 'wali'" icon="id-card" maxlength="16" />
                                    <x-form-input label="Tahun Lahir" :name="$prefix . '_tahun_lahir'" placeholder="YYYY"
                                        :required="$prefix != 'wali'" icon="calendar" maxlength="4" />
                                    <x-form-select label="Pendidikan Terakhir" :name="$prefix . '_pendidikan'" :options="[
                                        'SD' => 'SD / Sederajat',
                                        'SMP' => 'SMP / Sederajat',
                                        'SMA' => 'SMA / Sederajat',
                                        'D3' => 'D3',
                                        'S1' => 'S1 / D4',
                                        'S2' => 'S2',
                                        'S3' => 'S3',
                                        'Lainnya' => 'Tidak Sekolah',
                                    ]"
                                        :required="$prefix != 'wali'" icon="graduation-cap" />
                                    <x-form-input label="Pekerjaan" :name="$prefix . '_pekerjaan'"
                                        placeholder="Contoh: Buruh, PNS, Wiraswasta" :required="$prefix != 'wali'"
                                        icon="briefcase" />
                                    <x-form-select label="Penghasilan Bulanan" :name="$prefix . '_penghasilan'" :options="[
                                        '<500' => '< Rp 500.000',
                                        '500-1juta' => 'Rp 500.000 - 1.000.000',
                                        '1juta-2juta' => 'Rp 1.000.000 - 2.000.000',
                                        '2juta-5juta' => 'Rp 2.000.000 - 5.000.000',
                                        '5juta-20juta' => 'Rp 5.000.000 - 20.000.000',
                                        '>20juta' => '> Rp 20.000.000',
                                    ]"
                                        :required="$prefix != 'wali'" icon="banknote" />
                                </div>
                            </div>
                            @if (!$loop->last)
                                <div class="border-t border-slate-100 dark:border-slate-800"></div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Step 3: Data Periodik & Rincian -->
                    <div x-show="step === 3" x-transition class="p-8 space-y-8">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-6">
                                <span
                                    class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                    <iconify-icon icon="lucide:ruler" class="text-xl"></iconify-icon>
                                </span>
                                Data Fisik
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <x-form-input label="Tinggi Badan (cm)" name="tinggi_badan" placeholder="000"
                                    required icon="arrows-up-down" type="number" />
                                <x-form-input label="Berat Badan (kg)" name="berat_badan" placeholder="00" required
                                    icon="monitor-weight" type="number" />
                                <x-form-input label="Lingkar Kepala (cm)" name="lingkar_kepala" placeholder="00"
                                    required icon="circle-dashed" type="number" />
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-100 dark:border-slate-800">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-6">
                                <span
                                    class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                    <iconify-icon icon="lucide:map" class="text-xl"></iconify-icon>
                                </span>
                                Jarak & Waktu Tempuh
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <x-form-input label="Jarak ke Sekolah (km)" name="jarak_sekolah"
                                    placeholder="Contoh: 2" required icon="milestone" type="number"
                                    step="0.1" />
                                <div class="grid grid-cols-2 gap-4">
                                    <x-form-input label="Jam" name="waktu_jam" placeholder="0" required
                                        type="number" icon="clock" />
                                    <x-form-input label="Menit" name="waktu_menit" placeholder="30" required
                                        type="number" icon="timer" />
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-100 dark:border-slate-800">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-6">
                                <span
                                    class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                    <iconify-icon icon="lucide:info" class="text-xl"></iconify-icon>
                                </span>
                                Informasi Lainnya
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <x-form-input label="Jumlah Saudara Kandung" name="jumlah_saudara" placeholder="0"
                                    required icon="users-2" type="number" />
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Prestasi, Beasiswa & Kesejahteraan -->
                    <div x-show="step === 4" x-transition class="p-8 space-y-8">
                        <div>
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <span
                                        class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                        <iconify-icon icon="lucide:award" class="text-xl"></iconify-icon>
                                    </span>
                                    Data Prestasi (Opsional)
                                </h3>
                                <button type="button" class="text-xs font-bold text-primary hover:underline">+ TAMBAH
                                    PRESTASI</button>
                            </div>
                            <div
                                class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-xl border border-dashed border-slate-200 dark:border-slate-700">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <x-form-select label="Jenis Prestasi" name="prestasi_jenis" :options="[
                                        'Sains' => 'Sains',
                                        'Seni' => 'Seni',
                                        'Olahraga' => 'Olahraga',
                                        'Lainnya' => 'Lainnya',
                                    ]"
                                        icon="list-todo" />
                                    <x-form-select label="Tingkat" name="prestasi_tingkat" :options="[
                                        'Kecamatan' => 'Kecamatan',
                                        'Kabupaten' => 'Kabupaten/Kota',
                                        'Provinsi' => 'Provinsi',
                                        'Nasional' => 'Nasional',
                                        'Internasional' => 'Internasional',
                                    ]"
                                        icon="bar-chart" />
                                    <div class="md:col-span-2">
                                        <x-form-input label="Nama Prestasi / Lomba" name="prestasi_nama"
                                            placeholder="Juara 1 Lomba Matematika" icon="trophy" />
                                    </div>
                                    <x-form-input label="Tahun" name="prestasi_tahun" placeholder="YYYY"
                                        icon="calendar" maxlength="4" />
                                    <x-form-input label="Penyelenggara" name="prestasi_penyelenggara"
                                        placeholder="Dinas Pendidikan" icon="building" />
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-100 dark:border-slate-800">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-6">
                                <span
                                    class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                    <iconify-icon icon="lucide:heart" class="text-xl"></iconify-icon>
                                </span>
                                Program Kesejahteraan
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <x-form-input label="No. KKS (Kartu Keluarga Sejahtera)" name="no_kks"
                                    placeholder="Masukkan jika ada" icon="credit-card" />
                                <x-form-input label="No. PKH (Program Keluarga Harapan)" name="no_pkh"
                                    placeholder="Masukkan jika ada" icon="users" />
                                <x-form-input label="No. KIP (Kartu Indonesia Pintar)" name="no_kip"
                                    placeholder="Masukkan jika ada" icon="graduation-cap" />
                            </div>
                            <p class="mt-4 text-xs text-slate-400">Kosongkan jika tidak memiliki program kesejahteraan.
                            </p>
                        </div>
                    </div>

                    <!-- Step 5: Registrasi & Dokumen (Final) -->
                    <div x-show="step === 5" x-transition class="p-8 space-y-8">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-6">
                                <span
                                    class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                    <iconify-icon icon="lucide:graduation-cap" class="text-xl"></iconify-icon>
                                </span>
                                Data Asal Sekolah
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <x-form-input label="Nama Sekolah Asal" name="asal_sekolah"
                                        placeholder="SMP Negeri Contoh 1" required icon="school" />
                                </div>
                                <x-form-input label="No. Peserta UN" name="no_un"
                                    placeholder="Masukkan nomor peserta UN" icon="book-open" />
                                <x-form-input label="No. Seri Ijazah" name="no_ijazah"
                                    placeholder="Masukkan nomor seri ijazah" icon="scroll" />
                                <x-form-input label="No. SKHUN" name="no_skhun" placeholder="Masukkan nomor SKHUN"
                                    icon="file-signature" />
                            </div>
                        </div>

                        <div class="pt-10 border-t border-slate-100 dark:border-slate-800">
                            <div
                                class="bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-800 p-6 rounded-2xl flex gap-4">
                                <iconify-icon icon="lucide:info" class="text-amber-500 text-2xl shrink-0"></iconify-icon>
                                <div>
                                    <h4 class="font-bold text-amber-900 dark:text-amber-200">Konfirmasi Final</h4>
                                    <p class="text-sm text-amber-800 dark:text-amber-300 mt-1">
                                        Dengan mengklik tombol submit, saya menyatakan bahwa data yang saya masukkan
                                        adalah benar dan dapat dipertanggungjawabkan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div
                        class="p-8 bg-slate-50 dark:bg-slate-800/50 flex justify-between items-center border-t border-slate-100 dark:border-slate-800">
                        <button type="button" x-show="step > 1" @click="step--"
                            class="px-6 py-2.5 rounded-lg font-bold border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-white dark:hover:bg-slate-800 transition-all flex items-center gap-2">
                            <iconify-icon icon="lucide:arrow-left" class="text-xl"></iconify-icon>
                            Kembali
                        </button>
                        <div x-show="step === 1"></div> <!-- Spacer for first step -->

                        <button type="button" x-show="step < 5" @click="step++"
                            class="px-8 py-2.5 bg-primary text-white rounded-lg font-bold shadow-lg shadow-primary/20 hover:bg-emerald-600 transition-all flex items-center gap-2">
                            Lanjut
                            <iconify-icon icon="lucide:arrow-right" class="text-xl"></iconify-icon>
                        </button>

                        <button type="submit" x-show="step === 5"
                            class="px-8 py-2.5 bg-accent text-white rounded-lg font-bold shadow-lg shadow-accent/20 hover:bg-amber-600 transition-all flex items-center gap-2">
                            Submit Pendaftaran
                            <iconify-icon icon="lucide:rocket" class="text-xl"></iconify-icon>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Alpine.js is included in layout -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</x-layout>
