<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran - {{ $registration->nama_lengkap }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11pt;
            color: #333;
            line-height: 1.1;
            background-color: #fff;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            /* border: 2px solid #064e3b; */
            padding: 10px;
            background-color: #fff;
            position: relative;
            box-sizing: border-box;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px double #064e3b;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .header-logo {
            width: 15%;
            vertical-align: middle;
            padding-bottom: 10px;
        }
        .header-logo img {
            max-width: 90px;
            height: auto;
            display: block;
        }
        .header-text {
            width: 85%;
            text-align: center;
            vertical-align: middle;
            padding-bottom: 10px;
            padding-right: 90px; /* Menyeimbangkan posisi teks karena ada logo di kiri */
        }
        .header-text h1 {
            margin: 0;
            font-size: 18pt;
            color: #064e3b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .header-text p {
            margin: 3px 0 0;
            font-size: 10pt;
        }
        .registration-title {
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            margin: 20px 0;
            text-decoration: underline;
            color: #064e3b;
        }
        .section-title {
            background-color: #032e15;
            padding: 6px 10px;
            font-weight: bold;
            font-size: 10pt;
            margin-top: 20px;
            border-left: 4px solid #ffee00;
            color: #fff;
        }
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        .content-table td {
            padding: 5px 0;
            vertical-align: top;
        }
        .label {
            width: 25%;
            color: #555;
        }
        .colon {
            width: 3%;
            color: #333;
        }
        .value {
            width: 72%;
            font-weight: bold;
            color: #111;
        }
        .photo-box {
            position: absolute;
            top: 170px;
            right: 30px;
            width: 113px; /* Skala pas foto 3x4 murni */
            height: 151px;
            border: 2px dashed #064e3b;
            background-color: #fafafa;
            text-align: center;
            line-height: 151px;
            font-size: 9pt;
            color: #064e3b;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
        }
        .signature {
            float: right;
            text-align: center;
            width: 220px;
        }
        .signature p {
            margin: 0 0 70px 0;
        }
        .clear {
            clear: both;
        }
        .note {
            font-size: 8.5pt;
            color: #555;
            margin-top: 40px;
            border-top: 1px dotted #064e3b;
            padding-top: 15px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Kop Surat Menggunakan Tabel agar Posisi Logo & Teks Sejajar -->
        <table class="header-table">
            <tr>
                <td class="header-logo">
                    <!-- Ganti path/url_logo_sekolah.png dengan aset gambar logo SMK Anda -->
                    <img src="{{ public_path('logo-amt.webp') }}" alt="Logo Sekolah">
                </td>
                <td class="header-text">
                    <h1>{{ \App\Models\Setting::getValue('school_name', "SMK AL-MUJTAMA'") }}</h1>
                    <p><b>Panitia Penerimaan Peserta Didik Baru (PPDB) Online</b></p>
                    <p>Tahun Pelajaran {{ \App\Models\Setting::getValue('academic_year', '2026/2027') }}</p>
                    <p style="font-size: 8.5pt; color: #555; margin-top: 5px;">{{ \App\Models\Setting::getValue('school_address', 'Jl. Raya Pegantenan No.KM. 09, Tengracak, Plakpak, Kec. Pegantenan, Kabupaten Pamekasan, Jawa Timur 69361') }}</p>
                </td>
            </tr>
        </table>

        <div class="registration-title">BUKTI PENDAFTARAN ONLINE</div>

        <!-- Box Foto Tetap Absolute, Mengikuti Sisi Kanan Container yang Terkunci -->
        {{-- <div class="photo-box">PAS FOTO 3x4</div> --}}

        <div class="section-title">DATA PENDAFTARAN</div>
        <table class="content-table"> <!-- Dipersempit agar tidak tabrakan dengan pas foto -->
            <tr>
                <td class="label">No. Pendaftaran</td>
                <td class="colon">:</td>
                <td class="value">{{ str_pad($registration->id, 5, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td class="label">Gelombang</td>
                <td class="colon">:</td>
                <td class="value">{{ $registration->wave->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Pilihan Jurusan</td>
                <td class="colon">:</td>
                <td class="value">{{ $registration->jurusan->nama_jurusan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Daftar</td>
                <td class="colon">:</td>
                <td class="value">{{ $registration->created_at->format('d F Y') }}</td>
            </tr>
        </table>

        <div class="section-title">IDENTITAS CALON SISWA</div>
        <table class="content-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="colon">:</td>
                <td class="value">{{ strtoupper($registration->nama_lengkap) }}</td>
            </tr>
            <tr>
                <td class="label">NISN</td>
                <td class="colon">:</td>
                <td class="value">{{ $registration->nisn }}</td>
            </tr>
            <tr>
                <td class="label">NIK</td>
                <td class="colon">:</td>
                <td class="value">{{ $registration->nik }}</td>
            </tr>
            <tr>
                <td class="label">Tempat, Tgl Lahir</td>
                <td class="colon">:</td>
                <td class="value">{{ $registration->tempat_lahir }}, {{ \Carbon\Carbon::parse($registration->tanggal_lahir)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Jenis Kelamin</td>
                <td class="colon">:</td>
                <td class="value">{{ $registration->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td class="label">Sekolah Asal</td>
                <td class="colon">:</td>
                <td class="value">{{ $registration->asal_sekolah }}</td>
            </tr>
        </table>

        <div class="section-title">DATA ORANG TUA</div>
        <table class="content-table">
            <tr>
                <td class="label">Nama Ayah</td>
                <td class="colon">:</td>
                <td class="value">{{ $registration->ayah_nama }}</td>
            </tr>
            <tr>
                <td class="label">Nama Ibu</td>
                <td class="colon">:</td>
                <td class="value">{{ $registration->ibu_nama }}</td>
            </tr>
            <tr>
                <td class="label">No. HP / WA</td>
                <td class="colon">:</td>
                <td class="value">{{ $registration->no_hp }}</td>
            </tr>
        </table>

        <div class="footer">
            <div class="signature">
                <p>Kabupaten Pamekasan, {{ now()->format('d F Y') }}<br>Pendaftar,</p>
                <strong>( {{ $registration->nama_lengkap }} )</strong>
            </div>
            <div class="clear"></div>
        </div>

        <div class="note">
            <strong>Catatan:</strong><br>
            1. Simpan bukti pendaftaran ini sebagai bukti valid pendaftaran online.<br>
            2. Silakan login ke dashboard untuk memantau status verifikasi dan mengunggah dokumen yang diperlukan.<br>
            3. Pastikan data yang diisi benar. Pemalsuan data dapat mengakibatkan pembatalan pendaftaran.
        </div>
    </div>
</body>
</html>
