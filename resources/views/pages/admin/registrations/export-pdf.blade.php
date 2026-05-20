<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Calon Siswa - PPDB</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11pt;
            color: #333;
            line-height: 1.2;
            background-color: #fff;
            margin: 0;
            padding: 10px;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            background-color: #fff;
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
            width: 10%;
            vertical-align: middle;
            padding-bottom: 10px;
        }
        .header-logo img {
            max-width: 80px;
            height: auto;
            display: block;
        }
        .header-text {
            width: 90%;
            text-align: center;
            vertical-align: middle;
            padding-bottom: 10px;
            padding-right: 80px; /* Menyeimbangkan posisi teks karena ada logo di kiri */
        }
        .header-text h1 {
            margin: 0;
            font-size: 20pt;
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
            text-transform: uppercase;
        }
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .footer {
            margin-top: 40px;
            font-size: 8.5pt;
            color: #555;
            border-top: 1px dotted #064e3b;
            padding-top: 15px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Kop Surat Menggunakan Tabel agar Posisi Logo & Teks Sejajar -->
        <table class="header-table">
            <tr>
                <td class="header-logo">
                    <img src="{{ public_path('logo-amt.webp') }}" alt="Logo Sekolah">
                </td>
                <td class="header-text">
                    <h1>SMK AL-MUJTAMA'</h1>
                    <p><b>Panitia Penerimaan Peserta Didik Baru (PPDB) Online</b></p>
                    <p>Tahun Pelajaran 2026/2027</p>
                    <p style="font-size: 8.5pt; color: #555; margin-top: 5px;">Jl. Raya Contoh No. 123, Kabupaten/Kota, Provinsi</p>
                </td>
            </tr>
        </table>

        <div class="registration-title">DAFTAR CALON SISWA BARU (PPDB)</div>

        <table class="content-table">
            <thead>
                <tr style="background-color: #032e15; color: #fff;">
                    <th style="padding: 10px; font-weight: bold; border: 1px solid #064e3b; text-align: center; font-size: 10pt; text-transform: uppercase; width: 5%;">No</th>
                    <th style="padding: 10px; font-weight: bold; border: 1px solid #064e3b; font-size: 10pt; text-transform: uppercase; width: 25%;">Nama Lengkap</th>
                    <th style="padding: 10px; font-weight: bold; border: 1px solid #064e3b; font-size: 10pt; text-transform: uppercase; width: 15%;">NISN</th>
                    <th style="padding: 10px; font-weight: bold; border: 1px solid #064e3b; font-size: 10pt; text-transform: uppercase; width: 25%;">Asal Sekolah</th>
                    <th style="padding: 10px; font-weight: bold; border: 1px solid #064e3b; font-size: 10pt; text-transform: uppercase; width: 20%;">Jurusan</th>
                    <th style="padding: 10px; font-weight: bold; border: 1px solid #064e3b; font-size: 10pt; text-transform: uppercase; text-align: center; width: 10%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $index => $reg)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 8px; border: 1px solid #ddd; text-align: center; font-size: 9.5pt;">{{ $index + 1 }}</td>
                        <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold; text-transform: uppercase; font-size: 9.5pt;">{{ $reg->nama_lengkap }}</td>
                        <td style="padding: 8px; border: 1px solid #ddd; font-size: 9.5pt;">{{ $reg->nisn }}</td>
                        <td style="padding: 8px; border: 1px solid #ddd; text-transform: uppercase; font-size: 9.5pt;">{{ $reg->asal_sekolah }}</td>
                        <td style="padding: 8px; border: 1px solid #ddd; font-size: 9.5pt;">{{ $reg->jurusan->nama_jurusan ?? '-' }}</td>
                        <td style="padding: 8px; border: 1px solid #ddd; text-align: center; font-size: 9.5pt;">
                            @php
                                $statusLabel = $reg->status == 'verified' ? 'LULUS' : ($reg->status == 'rejected' ? 'DITOLAK' : 'PENDING');
                                $statusColor = $reg->status == 'verified' ? '#059669' : ($reg->status == 'rejected' ? '#dc2626' : '#d97706');
                            @endphp
                            <span style="color: {{ $statusColor }}; font-weight: bold;">{{ $statusLabel }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            Dicetak secara otomatis melalui Sistem PPDB Online SMK AL-MUJTAMA' &bull; Tanggal Cetak: {{ now()->format('d F Y H:i') }} WIB
        </div>
    </div>
</body>
</html>
