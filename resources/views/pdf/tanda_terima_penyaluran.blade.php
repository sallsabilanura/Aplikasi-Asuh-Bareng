<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Hadir Pendampingan - {{ $judul }}</title>
    <style>
        @page {
            margin: 1.5cm;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            color: #000;
        }
        h2 {
            text-align: center;
            font-size: 14pt;
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px 5px;
            text-align: left;
            vertical-align: middle;
            word-wrap: break-word;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        .text-center {
            text-align: center;
        }
        
        /* Column Widths */
        .col-no { width: 4%; text-align: center; }
        .col-nama { width: 17%; }
        .col-telp { width: 12%; text-align: center; }
        .col-kakak { width: 12%; text-align: center; }
        .col-ortu { width: 15%; text-align: center; }
        .col-ttd { width: 15%; }
        .col-ket { width: 12%; text-align: center; }
        
        .row-item {
            height: 50px; /* Force minimum height for signature */
        }
    </style>
</head>
<body>

    <h2>DAFTAR HADIR<br>PENDAMPINGAN BERSAMA BULAN : {{ strtoupper(\DateTime::createFromFormat('!m', request('Bulan'))->format('F')) }} {{ request('Tahun') }}</h2>

    <table>
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-nama">Nama Anak</th>
                <th class="col-telp">Nomor Telepon</th>
                <th class="col-kakak">Kakak Asuh</th>
                <th class="col-ortu">Nama Orang Tua</th>
                <th class="col-ttd">Tanda Tangan</th>
                <th class="col-ket">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penyalurans as $index => $item)
            <tr class="row-item">
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->anakAsuh->NamaLengkap ?? '-' }}</td>
                <td class="text-center">{{ $item->anakAsuh->NomorTelp ?? '-' }}</td>
                <td class="text-center">{{ $item->anakAsuh->penugasan->first()->kakakAsuh->NamaLengkap ?? '-' }}</td>
                <td>{{ $item->anakAsuh->NamaOrangTua ?? '' }}</td> 
                <td></td> {{-- Empty for signature --}}
                <td class="text-center">Rp {{ number_format($item->Nominal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            
            @if($penyalurans->isEmpty())
            <tr>
                <td colspan="7" class="text-center">Belum ada data penyaluran pada bulan ini.</td>
            </tr>
            @endif
        </tbody>
    </table>

</body>
</html>
