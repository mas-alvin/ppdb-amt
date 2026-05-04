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
            line-height: 1.4;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            border: 2px solid #064e3b;
            padding: 30px;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #064e3b;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18pt;
            color: #064e3b;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 10pt;
        }
        .registration-title {
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            margin: 20px 0;
            text-decoration: underline;
        }
        .section-title {
            background-color: #f3f4f6;
            padding: 5px 10px;
            font-weight: bold;
            font-size: 10pt;
            margin-top: 15px;
            border-left: 4px solid #064e3b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table td {
            padding: 4px 0;
            vertical-align: top;
        }
        .label {
            width: 30%;
            color: #666;
        }
        .value {
            width: 70%;
            font-weight: bold;
        }
        .photo-box {
            position: absolute;
            top: 150px;
            right: 50px;
            width: 100px;
            height: 120px;
            border: 1px solid #ccc;
            text-align: center;
            line-height: 120px;
            font-size: 8pt;
            color: #999;
        }
        .footer {
            margin-top: 40px;
        }
        .qr-placeholder {
            float: left;
            width: 80px;
            height: 80px;
            border: 1px solid #eee;
            margin-right: 20px;
        }
        .signature {
            float: right;
            text-align: center;
            width: 200px;
        }
        .signature p {
            margin-bottom: 60px;
        }
        .clear {
            clear: both;
        }
        .note {
            font-size: 8pt;
            color: #666;
            margin-top: 30px;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SMK AL-MUJTAMA'</h1>
            <p>Panitia Penerimaan Peserta Didik Baru (PPDB) Online</p>
            <p>Tahun Pelajaran 2026/2027</p>
            <p style="font-size: 8pt; color: #666;">Jl. Raya Contoh No. 123, Kabupaten/Kota, Provinsi</p>
        </div>

        <div class="registration-title">BUKTI PENDAFTARAN ONLINE</div>

        <div class="photo-box">PAS FOTO 3x4</div>

        <div class="section-title">DATA PENDAFTARAN</div>
        <table>
            <tr>
                <td class="label">No. Pendaftaran</td>
                <td class="value">PPDB-{{ str_pad($registration->id, 5, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td class="label">Gelombang</td>
                <td class="value">{{ $registration->wave->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Pilihan Jurusan</td>
                <td class="value">{{ $registration->jurusan->nama_jurusan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Daftar</td>
                <td class="value">{{ $registration->created_at->format('d F Y') }}</td>
            </tr>
        </table>

        <div class="section-title">IDENTITAS CALON SISWA</div>
        <table>
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="value">{{ strtoupper($registration->nama_lengkap) }}</td>
            </tr>
            <tr>
                <td class="label">NISN</td>
                <td class="value">{{ $registration->nisn }}</td>
            </tr>
            <tr>
                <td class="label">NIK</td>
                <td class="value">{{ $registration->nik }}</td>
            </tr>
            <tr>
                <td class="label">Tempat, Tgl Lahir</td>
                <td class="value">{{ $registration->tempat_lahir }}, {{ \Carbon\Carbon::parse($registration->tanggal_lahir)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Jenis Kelamin</td>
                <td class="value">{{ $registration->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td class="label">Sekolah Asal</td>
                <td class="value">{{ $registration->asal_sekolah }}</td>
            </tr>
        </table>

        <div class="section-title">DATA ORANG TUA</div>
        <table>
            <tr>
                <td class="label">Nama Ayah</td>
                <td class="value">{{ $registration->ayah_nama }}</td>
            </tr>
            <tr>
                <td class="label">Nama Ibu</td>
                <td class="value">{{ $registration->ibu_nama }}</td>
            </tr>
            <tr>
                <td class="label">No. HP / WA</td>
                <td class="value">{{ $registration->no_hp }}</td>
            </tr>
        </table>

        <div class="footer">
            <div class="signature">
                <p>Kabupaten, {{ now()->format('d F Y') }}<br>Pendaftar,</p>
                <br>
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
