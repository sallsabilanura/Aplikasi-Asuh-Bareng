<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi Pendampingan</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; color: #333; }
        .header-info { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Laporan Absensi Pendampingan</h2>
    <div class="header-info">
        <p>Tanggal Cetak: {{ date('d/m/Y H:i') }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Anak Asuh</th>
                <th>Kakak Asuh</th>
                <th>Jenis</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensis as $index => $absensi)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $absensi->anakAsuh->NamaLengkap ?? 'N/A' }}</td>
                <td>{{ $absensi->kakakAsuh->NamaLengkap ?? 'N/A' }}</td>
                <td>{{ $absensi->JenisPendampingan }}</td>
                <td>{{ $absensi->Tanggal }}</td>
                <td>{{ $absensi->WaktuMulai }} - {{ $absensi->WaktuSelesai }}</td>
                <td>{{ $absensi->NilaiPendampingan }} ({{ $absensi->NilaiHuruf }})</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
