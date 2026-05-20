<x-layout title="Pendaftaran Siswa Baru">
    <div class="min-h-screen bg-slate-50 dark:bg-background-dark py-12 px-4 sm:px-6 lg:px-8" x-data="{ step: 1 }">
        <div class="relative max-w-full sm:mx-auto md:mx-28">
            
            @if(!$registration)
                <!-- Header Section -->
                <div class="text-center mb-12" data-aos="fade-down">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-green-100 text-green-800 text-xs font-black mb-4 border border-green-200 uppercase tracking-widest">
                        Registration Wizard
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black text-green-950 tracking-tight leading-tight">Formulir Pendaftaran</h1>
                    <p class="mt-2 text-slate-500 text-lg">Lengkapi data Anda dengan teliti sesuai dokumen asli.</p>
                </div>

                <!-- Step Indicator -->
                <x-registration.wizard-step-indicator ::active-step="step" />
            @endif

            @if(!$registration)
                @if(!$activeWave)
                    <!-- Registration Closed Notice -->
                    <div class="bg-white dark:bg-slate-900 rounded-lg shadow-xl border border-slate-100 dark:border-slate-800 p-12 text-center" data-aos="zoom-in">
                        <div class="size-24 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center mx-auto mb-6">
                            <iconify-icon icon="lucide:calendar-off" class="text-5xl"></iconify-icon>
                        </div>
                        <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-2">Pendaftaran Belum Dibuka</h2>
                        <p class="text-slate-500 max-w-md mx-auto mb-8">Mohon maaf, saat ini belum ada gelombang pendaftaran yang dibuka atau jadwal pendaftaran telah berakhir. Silakan cek kembali secara berkala.</p>
                        <a href="{{ route('student.dashboard') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-green-900 text-white rounded-lg font-black uppercase tracking-widest hover:bg-green-800 transition-all shadow-xl shadow-green-900/20">
                            <iconify-icon icon="lucide:arrow-left"></iconify-icon> Kembali ke Dashboard
                        </a>
                    </div>
                @elseif($activeWave->isFull())
                    <!-- Quota Full Notice -->
                    <div class="bg-white dark:bg-slate-900 rounded-lg shadow-xl border border-slate-100 dark:border-slate-800 p-12 text-center" data-aos="zoom-in">
                        <div class="size-24 rounded-full bg-red-50 dark:bg-red-950/20 text-red-500 flex items-center justify-center mx-auto mb-6">
                            <iconify-icon icon="lucide:users-2" class="text-5xl"></iconify-icon>
                        </div>
                        <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-2">Kuota Sudah Penuh</h2>
                        <p class="text-slate-500 max-w-md mx-auto mb-2">Mohon maaf, kuota pendaftaran untuk <strong>{{ $activeWave->name }}</strong> telah terpenuhi.</p>
                        <p class="text-slate-400 text-sm mb-8 italic">Silakan hubungi panitia PPDB untuk informasi lebih lanjut.</p>
                        <a href="{{ route('student.dashboard') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-green-900 text-white rounded-lg font-black uppercase tracking-widest hover:bg-green-800 transition-all shadow-xl shadow-green-900/20">
                            <iconify-icon icon="lucide:arrow-left"></iconify-icon> Kembali ke Dashboard
                        </a>
                    </div>
                @else
                    <!-- Wizard Form -->
                    <div
                        class="bg-white dark:bg-slate-900 rounded-lg shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 overflow-hidden">
                        
                        <!-- Wave Status Badge -->
                        <div class="bg-green-900/5 px-8 py-3 border-b border-green-900/10 flex items-center justify-between">
                            <div class="flex items-center gap-2 text-green-900 font-bold text-sm">
                                <iconify-icon icon="lucide:info" class="text-lg"></iconify-icon>
                                <span>Pendaftaran: {{ $activeWave->name }}</span>
                            </div>
                            <div class="text-xs text-slate-500">
                                Berakhir dalam: <span class="font-bold text-green-900">{{ $activeWave->end_date->endOfDay()->diffForHumans() }}</span>
                            </div>
                        </div>

                        <form action="{{ route('student.pendaftaran.store') }}" method="POST" id="registrationForm" @submit.prevent="submitForm($el)">
                            @csrf
     
                        <!-- Step 1: Data Pribadi & Kontak -->
                        <div x-show="step === 1" id="step-container-1" x-transition class="p-8 space-y-8">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-6">
                                    <span
                                        class="size-10 rounded-lg bg-green-900 text-white flex items-center justify-center shadow-lg shadow-green-900/20">
                                        <iconify-icon icon="lucide:user" class="text-2xl"></iconify-icon>
                                    </span>
                                    Pilihan Jurusan & Data Pribadi
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="md:col-span-2">
                                        <x-form-select label="Pilih Jurusan / Kompetensi Keahlian" name="jurusan_id" :options="$jurusans->pluck('nama_jurusan', 'id')->toArray()" required
                                            icon="book-open" :selected="old('jurusan_id')" />
                                    </div>
                                    <x-form-input label="Nama Lengkap (Sesuai Ijazah)" name="nama_lengkap"
                                        placeholder="Masukkan nama lengkap" required icon="user" :value="old('nama_lengkap', auth()->user()->name)" />
                                    <x-form-select label="Jenis Kelamin" name="jenis_kelamin" :options="['L' => 'Laki-laki', 'P' => 'Perempuan']" required
                                        icon="users-2" :selected="old('jenis_kelamin')" />
                                    <x-form-input label="NISN (10 Digit)" name="nisn" placeholder="Contoh: 0012345678"
                                        required icon="hash" maxlength="10" :value="old('nisn')" />
                                    <x-form-input label="NIK (16 Digit)" name="nik"
                                        placeholder="Contoh: 3201234567890123" required icon="id-card" maxlength="16" :value="old('nik')" />
                                    <x-form-input label="No Kartu Keluarga (16 Digit)" name="no_kk"
                                        placeholder="Contoh: 3201234567890123" required icon="id-card" maxlength="16" :value="old('no_kk')" />
                                    <x-form-input label="Tempat Lahir" name="tempat_lahir" placeholder="Contoh: Jakarta"
                                        required icon="map-pin" :value="old('tempat_lahir')" />
                                    <x-form-input type="date" label="Tanggal Lahir" name="tanggal_lahir" placeholder="Contoh: 2009-01-01"
                                        required icon="calendar" :value="old('tanggal_lahir')" />
                                    <x-form-input label="No. Akta Lahir" name="no_akta"
                                        placeholder="Masukkan nomor akta lahir" required icon="file-text" :value="old('no_akta')" />
                                    <x-form-select label="Agama" name="agama" :options="[
                                        'Islam' => 'Islam',
                                        'Kristen' => 'Kristen',
                                        'Katolik' => 'Katolik',
                                        'Hindu' => 'Hindu',
                                        'Budha' => 'Budha',
                                        'Lainnya' => 'Lainnya',
                                    ]" required icon="heart" :selected="old('agama')" />
                                    <x-form-select label="Kewarganegaraan" name="kewarganegaraan" :options="['WNI' => 'WNI', 'WNA' => 'WNA']" required
                                        icon="globe" :selected="old('kewarganegaraan')" />
                                </div>
                            </div>
     
                            <div class="pt-6 border-t border-slate-100 dark:border-slate-800">
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-6">
                                    <span
                                        class="size-10 rounded-lg bg-yellow-500 text-green-950 flex items-center justify-center shadow-lg shadow-yellow-500/20">
                                        <iconify-icon icon="lucide:map-pin" class="text-2xl"></iconify-icon>
                                    </span>
                                    Alamat Domisili Lengkap
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="md:col-span-2">
                                        <x-form-input label="Alamat / Jalan" name="alamat" placeholder="Jl. Contoh No. 123"
                                            required icon="home" :value="old('alamat')" />
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 text-slate-700">
                                        <x-form-input label="RT" name="rt" placeholder="00" required :value="old('rt')" />
                                        <x-form-input label="RW" name="rw" placeholder="00" required :value="old('rw')" />
                                    </div>
                                    <x-form-input label="Dusun" name="dusun" placeholder="Nama Dusun" :value="old('dusun')" />
                                    <x-form-input label="Kelurahan" name="kelurahan" placeholder="Nama Kelurahan"
                                        required :value="old('kelurahan')" />
                                    <x-form-input label="Kecamatan" name="kecamatan" placeholder="Nama Kecamatan"
                                        required :value="old('kecamatan')" />
                                    <x-form-input label="Kode Pos" name="kode_pos" placeholder="67xxx" required :value="old('kode_pos')" />
                                </div>
                            </div>
     
                            <div class="pt-6 border-t border-slate-100 dark:border-slate-800">
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-6">
                                    <span
                                        class="size-10 rounded-lg bg-green-900 text-white flex items-center justify-center shadow-lg shadow-green-900/20">
                                        <iconify-icon icon="lucide:phone" class="text-2xl"></iconify-icon>
                                    </span>
                                    Informasi Kontak Aktif
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <x-form-input label="Nomor HP / WhatsApp" name="no_hp" placeholder="08123456789"
                                        required icon="smartphone" :value="old('no_hp')" />
                                    <x-form-input label="Email Aktif" type="email" name="email"
                                        placeholder="contoh@gmail.com" required icon="mail" :value="old('email', auth()->user()->email)" />
                                </div>
                            </div>
                        </div>
     
                        <!-- Step 2: Data Orang Tua / Wali -->
                        <div x-show="step === 2" id="step-container-2" x-transition class="p-8 space-y-12">
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
                                                :required="$prefix != 'wali'" icon="user" :value="old($prefix . '_nama')" />
                                        </div>
                                        <x-form-input label="NIK" :name="$prefix . '_nik'" placeholder="16 Digit NIK"
                                            :required="$prefix != 'wali'" icon="id-card" maxlength="16" :value="old($prefix . '_nik')" />
                                        <x-form-input label="Tahun Lahir" :name="$prefix . '_tahun_lahir'" placeholder="YYYY"
                                            :required="$prefix != 'wali'" icon="calendar" maxlength="4" :value="old($prefix . '_tahun_lahir')" />
                                        <x-form-select label="Pendidikan Terakhir" :name="$prefix . '_pendidikan'" :options="[
                                            'SD' => 'SD / Sederajat',
                                            'SMP' => 'SMP / Sederajat',
                                            'SMA' => 'SMA / Sederajat',
                                            'D3' => 'D3',
                                            'S1' => 'S1 / D4',
                                            'S2' => 'S2',
                                            'S3' => 'S3',
                                            'Lainnya' => 'Tidak Sekolah',
                                        ]" :required="$prefix != 'wali'" icon="graduation-cap" :selected="old($prefix . '_pendidikan')" />
                                        <x-form-input label="Pekerjaan" :name="$prefix . '_pekerjaan'"
                                            placeholder="Contoh: Buruh, PNS, Wiraswasta" :required="$prefix != 'wali'"
                                            icon="briefcase" :value="old($prefix . '_pekerjaan')" />
                                        <x-form-select label="Penghasilan Bulanan" :name="$prefix . '_penghasilan'" :options="[
                                            '<500' => '< Rp 500.000',
                                            '500-1juta' => 'Rp 500.000 - 1.000.000',
                                            '1juta-2juta' => 'Rp 1.000.000 - 2.000.000',
                                            '2juta-5juta' => 'Rp 2.000.000 - 5.000.000',
                                            '5juta-20juta' => 'Rp 5.000.000 - 20.000.000',
                                            '>20juta' => '> Rp 20.000.000',
                                        ]" :required="$prefix != 'wali'" icon="banknote" :selected="old($prefix . '_penghasilan')" />
                                    </div>
                                </div>
                                @if (!$loop->last)
                                    <div class="border-t border-slate-100 dark:border-slate-800"></div>
                                @endif
                            @endforeach
                        </div>
     
                        <!-- Step 3: Data Periodik & Rincian -->
                        <div x-show="step === 3" id="step-container-3" x-transition class="p-8 space-y-8">
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
                                        required icon="arrows-up-down" type="number" :value="old('tinggi_badan')" />
                                    <x-form-input label="Berat Badan (kg)" name="berat_badan" placeholder="00" required
                                        icon="monitor-weight" type="number" :value="old('berat_badan')" />
                                    <x-form-input label="Lingkar Kepala (cm)" name="lingkar_kepala" placeholder="00"
                                        required icon="circle-dashed" type="number" :value="old('lingkar_kepala')" />
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
                                        step="0.1" :value="old('jarak_sekolah')" />
                                    <div class="grid grid-cols-2 gap-4">
                                        <x-form-input label="Jam" name="waktu_jam" placeholder="0" required
                                            type="number" icon="clock" :value="old('waktu_jam')" />
                                        <x-form-input label="Menit" name="waktu_menit" placeholder="30" required
                                            type="number" icon="timer" :value="old('waktu_menit')" />
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
                                        required icon="users-2" type="number" :value="old('jumlah_saudara')" />
                                </div>
                            </div>
                        </div>
     
                        <!-- Step 4: Prestasi, Beasiswa & Kesejahteraan -->
                        <div x-show="step === 4" id="step-container-4" x-transition class="p-8 space-y-8">
                            <div>
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                        <span
                                            class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                            <iconify-icon icon="lucide:award" class="text-xl"></iconify-icon>
                                        </span>
                                        Data Prestasi (Opsional)
                                    </h3>
                                </div>
                                <div
                                    class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-lg border border-dashed border-slate-200 dark:border-slate-700">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <x-form-select label="Jenis Prestasi" name="prestasi_jenis" :options="[
                                            'Sains' => 'Sains',
                                            'Seni' => 'Seni',
                                            'Olahraga' => 'Olahraga',
                                            'Lainnya' => 'Lainnya',
                                        ]" icon="list-todo" :selected="old('prestasi_jenis')" />
                                        <x-form-select label="Tingkat" name="prestasi_tingkat" :options="[
                                            'Kecamatan' => 'Kecamatan',
                                            'Kabupaten' => 'Kabupaten/Kota',
                                            'Provinsi' => 'Provinsi',
                                            'Nasional' => 'Nasional',
                                            'Internasional' => 'Internasional',
                                        ]" icon="bar-chart" :selected="old('prestasi_tingkat')" />
                                        <div class="md:col-span-2">
                                            <x-form-input label="Nama Prestasi / Lomba" name="prestasi_nama"
                                                placeholder="Juara 1 Lomba Matematika" icon="trophy" :value="old('prestasi_nama')" />
                                        </div>
                                        <x-form-input label="Tahun" name="prestasi_tahun" placeholder="YYYY"
                                            icon="calendar" maxlength="4" :value="old('prestasi_tahun')" />
                                        <x-form-input label="Penyelenggara" name="prestasi_penyelenggara"
                                            placeholder="Dinas Pendidikan" icon="building" :value="old('prestasi_penyelenggara')" />
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
                                        placeholder="Masukkan jika ada" icon="credit-card" :value="old('no_kks')" />
                                    <x-form-input label="No. PKH (Program Keluarga Harapan)" name="no_pkh"
                                        placeholder="Masukkan jika ada" icon="users" :value="old('no_pkh')" />
                                    <x-form-input label="No. KIP (Kartu Indonesia Pintar)" name="no_kip"
                                        placeholder="Masukkan jika ada" icon="graduation-cap" :value="old('no_kip')" />
                                </div>
                                <p class="mt-4 text-xs text-slate-400">Kosongkan jika tidak memiliki program kesejahteraan.
                                </p>
                            </div>
                        </div>
     
                        <!-- Step 5: Registrasi & Dokumen (Final) -->
                        <div x-show="step === 5" id="step-container-5" x-transition class="p-8 space-y-8">
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
                                            placeholder="SMP Negeri Contoh 1" required icon="school" :value="old('asal_sekolah')" />
                                    </div>
                                    <x-form-input label="No. Peserta UN" name="no_un"
                                        placeholder="Masukkan nomor peserta UN" icon="book-open" :value="old('no_un')" />
                                    <x-form-input label="No. Seri Ijazah" name="no_ijazah"
                                        placeholder="Masukkan nomor seri ijazah" icon="scroll" :value="old('no_ijazah')" />
                                    <x-form-input label="No. SKHUN" name="no_skhun" placeholder="Masukkan nomor SKHUN"
                                        icon="file-signature" :value="old('no_skhun')" />
                                </div>
                            </div>
     
                            <div class="pt-10 border-t border-slate-100 dark:border-slate-800">
                                <div
                                    class="bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-800 p-6 rounded-lg flex gap-4">
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
    
                            <button type="button" x-show="step < 5"
                                @click="
                                    let validation = validateStep(step);
                                    if (!validation.valid) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Kolom Wajib Diisi',
                                            html: '<p class=\'text-sm text-slate-500 mb-3\'>Mohon lengkapi kolom berikut sebelum melanjutkan:</p>' +
                                                  '<div class=\'max-h-60 overflow-y-auto text-left bg-slate-50 dark:bg-slate-800 p-4 rounded border border-slate-100 dark:border-slate-700\'>' +
                                                  '<ul class=\'list-disc list-inside space-y-1 text-xs font-semibold text-red-600 dark:text-red-400\'>' +
                                                  validation.fields.map(f => '<li>' + f + '</li>').join('') +
                                                  '</ul></div>',
                                            confirmButtonColor: '#064e3b',
                                            confirmButtonText: 'OK'
                                        });
                                    } else {
                                        step++;
                                        window.scrollTo({ top: 0, behavior: 'smooth' });
                                    }
                                "
                                class="px-10 py-3 bg-green-900 text-white rounded-lg font-black text-lg shadow-xl shadow-green-900/20 hover:bg-green-800 transition-all flex items-center gap-3">
                                LANJUT
                                <iconify-icon icon="lucide:arrow-right" class="text-2xl"></iconify-icon>
                            </button>
    
                            <button type="submit" x-show="step === 5"
                                class="px-10 py-3 bg-yellow-500 text-green-950 rounded-lg font-black text-lg shadow-xl shadow-yellow-500/20 hover:bg-yellow-400 transition-all flex items-center gap-3">
                                SUBMIT PENDAFTARAN
                                <iconify-icon icon="lucide:rocket" class="text-2xl"></iconify-icon>
                            </button>
                        </div>
                    </form>
                </div>
                @endif
            @else
                <!-- Show Submitted Data Summary -->
                <div class="bg-white rounded-lg shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                    <div class="bg-emerald-900 p-8 text-white relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10 pointer-events-none mix-blend-overlay" style="background-color: #064e3b"></div>
                        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                            <div class="flex items-center gap-6">
                                <div class="size-20 rounded-lg bg-yellow-500 text-green-950 flex items-center justify-center font-black text-3xl shadow-xl shadow-yellow-500/20">
                                    <iconify-icon icon="lucide:check-circle"></iconify-icon>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-black tracking-tight mb-1">Formulir Terkirim</h2>
                                    <p class="text-emerald-100/80 text-sm">Anda telah berhasil mengirimkan formulir pendaftaran. Silakan lanjutkan ke tahap unggah dokumen.</p>
                                </div>
                            </div>
                            <a href="{{ route('student.documents.index') }}" class="px-6 py-3 bg-yellow-500 hover:bg-yellow-400 text-green-950 font-black rounded-lg transition-all shadow-lg flex items-center gap-2 whitespace-nowrap">
                                Lanjut Unggah Dokumen <iconify-icon icon="lucide:arrow-right"></iconify-icon>
                            </a>
                        </div>
                    </div>

                    <div class="p-0" x-data="{ summaryTab: 'personal' }">
                        <!-- Summary Tabs Header -->
                        <div class="flex flex-wrap border-b border-slate-100 bg-slate-50/50">
                            @foreach([
                                'personal' => '1. Identitas',
                                'parents' => '2. Orang Tua',
                                'periodik' => '3. Periodik',
                                'achievement' => '4. Prestasi',
                                'school' => '5. Sekolah'
                            ] as $key => $label)
                                <button @click="summaryTab = '{{ $key }}'" 
                                    :class="summaryTab === '{{ $key }}' ? 'text-green-900 border-green-900 bg-white' : 'text-slate-400 border-transparent hover:text-slate-600'"
                                    class="flex-1 min-w-[120px] px-4 py-4 text-[10px] font-black uppercase tracking-widest border-b-2 transition-all">
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>

                        <div class="p-8">
                            <!-- Tab 1: Identitas -->
                            <div x-show="summaryTab === 'personal'" x-transition>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                    <div class="space-y-6">
                                        <h3 class="text-sm font-black text-green-950 uppercase tracking-widest flex items-center gap-2">
                                            <iconify-icon icon="lucide:user" class="text-lg"></iconify-icon>
                                            Data Diri
                                        </h3>
                                        <dl class="space-y-4">
                                            <x-summary-item label="Nama Lengkap" :value="$registration->nama_lengkap" />
                                            <x-summary-item label="Jurusan" :value="$registration->jurusan ? $registration->jurusan->nama_jurusan : '-'" highlight />
                                            <x-summary-item label="NISN" :value="$registration->nisn" />
                                            <x-summary-item label="NIK" :value="$registration->nik" />
                                            <x-summary-item label="No. KK" :value="$registration->no_kk" />
                                        </dl>
                                    </div>
                                    <div class="space-y-6">
                                        <h3 class="text-sm font-black text-green-950 uppercase tracking-widest flex items-center gap-2">
                                            <iconify-icon icon="lucide:calendar" class="text-lg"></iconify-icon>
                                            Kelahiran & Agama
                                        </h3>
                                        <dl class="space-y-4">
                                            <x-summary-item label="Tempat, Tgl Lahir" :value="$registration->tempat_lahir . ', ' . ($registration->tanggal_lahir ? \Carbon\Carbon::parse($registration->tanggal_lahir)->format('d M Y') : '-')" />
                                            <x-summary-item label="Gender" :value="$registration->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'" />
                                            <x-summary-item label="Agama" :value="$registration->agama" />
                                            <x-summary-item label="Kewarganegaraan" :value="$registration->kewarganegaraan" />
                                            <x-summary-item label="No. Akta" :value="$registration->no_akta" />
                                        </dl>
                                    </div>
                                    <div class="space-y-6">
                                        <h3 class="text-sm font-black text-green-950 uppercase tracking-widest flex items-center gap-2">
                                            <iconify-icon icon="lucide:map-pin" class="text-lg"></iconify-icon>
                                            Domisili & Kontak
                                        </h3>
                                        <dl class="space-y-4">
                                            <x-summary-item label="Alamat" :value="$registration->alamat . ' RT' . $registration->rt . '/RW' . $registration->rw" />
                                            <x-summary-item label="Dusun/Kel" :value="$registration->dusun . ' / ' . $registration->kelurahan" />
                                            <x-summary-item label="Kecamatan" :value="$registration->kecamatan" />
                                            <x-summary-item label="WhatsApp" :value="$registration->no_hp" />
                                            <x-summary-item label="Email" :value="$registration->email" />
                                        </dl>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab 2: Orang Tua -->
                            <div x-show="summaryTab === 'parents'" x-transition x-cloak>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                    @foreach (['ayah', 'ibu', 'wali'] as $p)
                                        <div class="space-y-6">
                                            <h3 class="text-sm font-black text-green-950 uppercase tracking-widest flex items-center gap-2">
                                                <iconify-icon icon="lucide:users" class="text-lg"></iconify-icon>
                                                {{ ucfirst($p) }}
                                            </h3>
                                            @if($registration->{$p . '_nama'})
                                            <dl class="space-y-4">
                                                <x-summary-item label="Nama" :value="$registration->{$p . '_nama'}" />
                                                <x-summary-item label="NIK" :value="$registration->{$p . '_nik'}" />
                                                <x-summary-item label="Tahun Lahir" :value="$registration->{$p . '_tahun_lahir'}" />
                                                <x-summary-item label="Pendidikan" :value="$registration->{$p . '_pendidikan'}" />
                                                <x-summary-item label="Pekerjaan" :value="$registration->{$p . '_pekerjaan'}" />
                                                <x-summary-item label="Penghasilan" :value="$registration->{$p . '_penghasilan'}" />
                                            </dl>
                                            @else
                                            <p class="text-xs text-slate-400 italic">Data tidak diisi</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Tab 3: Periodik -->
                            <div x-show="summaryTab === 'periodik'" x-transition x-cloak>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                    <div class="space-y-6">
                                        <h3 class="text-sm font-black text-green-950 uppercase tracking-widest flex items-center gap-2">
                                            <iconify-icon icon="lucide:ruler" class="text-lg"></iconify-icon>
                                            Data Fisik
                                        </h3>
                                        <dl class="space-y-4">
                                            <x-summary-item label="Tinggi Badan" :value="$registration->tinggi_badan . ' cm'" />
                                            <x-summary-item label="Berat Badan" :value="$registration->berat_badan . ' kg'" />
                                            <x-summary-item label="Lingkar Kepala" :value="$registration->lingkar_kepala . ' cm'" />
                                        </dl>
                                    </div>
                                    <div class="space-y-6">
                                        <h3 class="text-sm font-black text-green-950 uppercase tracking-widest flex items-center gap-2">
                                            <iconify-icon icon="lucide:map" class="text-lg"></iconify-icon>
                                            Jarak & Waktu
                                        </h3>
                                        <dl class="space-y-4">
                                            <x-summary-item label="Jarak Sekolah" :value="$registration->jarak_sekolah . ' km'" />
                                            <x-summary-item label="Waktu Tempuh" :value="$registration->waktu_jam . ' jam ' . $registration->waktu_menit . ' menit'" />
                                        </dl>
                                    </div>
                                    <div class="space-y-6">
                                        <h3 class="text-sm font-black text-green-950 uppercase tracking-widest flex items-center gap-2">
                                            <iconify-icon icon="lucide:users-2" class="text-lg"></iconify-icon>
                                            Lainnya
                                        </h3>
                                        <dl class="space-y-4">
                                            <x-summary-item label="Jml Saudara" :value="$registration->jumlah_saudara" />
                                        </dl>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab 4: Prestasi -->
                            <div x-show="summaryTab === 'achievement'" x-transition x-cloak>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-6">
                                        <h3 class="text-sm font-black text-green-950 uppercase tracking-widest flex items-center gap-2">
                                            <iconify-icon icon="lucide:award" class="text-lg"></iconify-icon>
                                            Prestasi
                                        </h3>
                                        @if($registration->prestasi_nama)
                                        <dl class="space-y-4">
                                            <x-summary-item label="Jenis" :value="$registration->prestasi_jenis" />
                                            <x-summary-item label="Tingkat" :value="$registration->prestasi_tingkat" />
                                            <x-summary-item label="Nama Lomba" :value="$registration->prestasi_nama" />
                                            <x-summary-item label="Tahun" :value="$registration->prestasi_tahun" />
                                            <x-summary-item label="Penyelenggara" :value="$registration->prestasi_penyelenggara" />
                                        </dl>
                                        @else
                                        <p class="text-xs text-slate-400 italic">Tidak ada data prestasi</p>
                                        @endif
                                    </div>
                                    <div class="space-y-6">
                                        <h3 class="text-sm font-black text-green-950 uppercase tracking-widest flex items-center gap-2">
                                            <iconify-icon icon="lucide:heart" class="text-lg"></iconify-icon>
                                            Kesejahteraan
                                        </h3>
                                        <dl class="space-y-4">
                                            <x-summary-item label="No. KKS" :value="$registration->no_kks ?: '-'" />
                                            <x-summary-item label="No. PKH" :value="$registration->no_pkh ?: '-'" />
                                            <x-summary-item label="No. KIP" :value="$registration->no_kip ?: '-'" />
                                        </dl>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab 5: Sekolah -->
                            <div x-show="summaryTab === 'school'" x-transition x-cloak>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                    <div class="space-y-6">
                                        <h3 class="text-sm font-black text-green-950 uppercase tracking-widest flex items-center gap-2">
                                            <iconify-icon icon="lucide:school" class="text-lg"></iconify-icon>
                                            Sekolah Asal
                                        </h3>
                                        <dl class="space-y-4">
                                            <x-summary-item label="Nama Sekolah" :value="$registration->asal_sekolah" />
                                            <x-summary-item label="No. UN" :value="$registration->no_un ?: '-'" />
                                            <x-summary-item label="No. Ijazah" :value="$registration->no_ijazah ?: '-'" />
                                            <x-summary-item label="No. SKHUN" :value="$registration->no_skhun ?: '-'" />
                                        </dl>
                                    </div>
                                    <div class="space-y-6">
                                        <h3 class="text-sm font-black text-green-950 uppercase tracking-widest flex items-center gap-2">
                                            <iconify-icon icon="lucide:check-circle" class="text-lg"></iconify-icon>
                                            Status Akhir
                                        </h3>
                                        <dl class="space-y-4">
                                            <x-summary-item label="Status" :value="strtoupper($registration->status)" highlight />
                                            <x-summary-item label="Tgl Daftar" :value="$registration->created_at->format('d M Y')" />
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-8 border-t border-slate-100 bg-slate-50/30 flex flex-wrap gap-4">
                            <a href="{{ route('student.dashboard') }}" class="px-6 py-3 bg-emerald-900 text-white font-black rounded-lg transition-all shadow-lg shadow-emerald-900/20 flex items-center gap-2">
                                <iconify-icon icon="lucide:layout-dashboard"></iconify-icon> Ke Dashboard
                            </a>
                            <a href="{{ route('student.pendaftaran.download') }}" class="px-6 py-3 bg-yellow-500 hover:bg-yellow-400 text-green-950 font-black rounded-lg transition-all shadow-lg flex items-center gap-2">
                                <iconify-icon icon="lucide:file-down"></iconify-icon> Unduh Bukti (PDF)
                            </a>
                            <button onclick="window.print()" class="px-6 py-3 bg-white border-2 border-slate-200 hover:border-emerald-900 hover:text-emerald-900 text-slate-600 font-black rounded-lg transition-all flex items-center gap-2">
                                <iconify-icon icon="lucide:printer"></iconify-icon> Cetak Bukti
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <x-footer></x-footer>

    <!-- Alpine.js is included in layout -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        function validateStep(stepNumber) {
            const container = document.getElementById('step-container-' + stepNumber);
            if (!container) return { valid: true };

            const requiredInputs = container.querySelectorAll('[required]');
            let missingFields = [];

            requiredInputs.forEach(input => {
                const val = input.value ? input.value.trim() : '';
                let labelText = input.getAttribute('placeholder') || input.name;
                
                const labelElement = input.closest('div').querySelector('label') || 
                                     input.closest('.grid > div')?.querySelector('label');
                if (labelElement) {
                    labelText = labelElement.textContent.replace(/[*:]/g, '').trim();
                }

                if (val === '') {
                    missingFields.push(labelText + ' wajib diisi.');
                } else {
                    if (input.name === 'nisn' && val.length !== 10) {
                        missingFields.push(labelText + ' harus tepat 10 digit angka.');
                    }
                    if (['nik', 'no_kk', 'ayah_nik', 'ibu_nik', 'wali_nik'].includes(input.name) && val.length !== 16) {
                        missingFields.push(labelText + ' harus tepat 16 digit angka.');
                    }
                    if (input.type === 'email') {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(val)) {
                            missingFields.push(labelText + ' format email tidak valid.');
                        }
                    }
                }
            });

            if (missingFields.length > 0) {
                return {
                    valid: false,
                    fields: missingFields
                };
            }

            return { valid: true };
        }

        function validateAllSteps() {
            let allMissing = [];
            for (let s = 1; s <= 5; s++) {
                const res = validateStep(s);
                if (!res.valid) {
                    allMissing = allMissing.concat(res.fields);
                }
            }
            if (allMissing.length > 0) {
                return {
                    valid: false,
                    fields: allMissing
                };
            }
            return { valid: true };
        }

        function submitForm(formElement) {
            const validation = validateAllSteps();
            if (!validation.valid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lengkapi Data Anda',
                    html: '<p class="text-sm text-slate-500 mb-3">Kolom berikut wajib diisi dengan benar sebelum mengirim pendaftaran:</p>' +
                          '<div class="max-h-60 overflow-y-auto text-left bg-slate-50 dark:bg-slate-800 p-4 rounded border border-slate-100 dark:border-slate-700">' +
                          '<ul class="list-disc list-inside space-y-1 text-xs font-semibold text-red-600 dark:text-red-400">' +
                          validation.fields.map(f => '<li>' + f + '</li>').join('') +
                          '</ul></div>',
                    confirmButtonColor: '#064e3b',
                    confirmButtonText: 'KEMBALI'
                });
            } else {
                Swal.fire({
                    title: 'Kirim Pendaftaran?',
                    text: 'Pastikan seluruh data Anda sudah benar. Data tidak dapat diubah setelah dikirim.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#064e3b',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: 'YA, KIRIM',
                    cancelButtonText: 'BATAL'
                }).then((result) => {
                    if (result.isConfirmed) {
                        formElement.submit();
                    }
                });
            }
        }
    </script>
</x-layout>
