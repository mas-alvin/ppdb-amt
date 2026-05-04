<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Calon Siswa - PPDB</title>
    <style>
        body { font-family: 'Arial', sans-serif; font-size: 10pt; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { bg-color: #f2f2f2; font-weight: bold; text-transform: uppercase; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 18pt; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 10pt; }
        .footer { margin-top: 30px; text-align: right; font-style: italic; font-size: 8pt; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Daftar Calon Siswa Baru</h1>
        <p>Portal PPDB SMK AL-MUJTAMA'</p>
        <p>Tanggal Cetak: {{ now()->format('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>NISN</th>
                <th>Asal Sekolah</th>
                <th>Jurusan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $index => $reg)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $reg->nama_lengkap }}</td>
                    <td>{{ $reg->nisn }}</td>
                    <td>{{ $reg->asal_sekolah }}</td>
                    <td>{{ $reg->jurusan->nama_jurusan ?? '-' }}</td>
                    <td>{{ strtoupper($reg->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak secara otomatis melalui Sistem PPDB Online
    </div>
</body>
</html>
