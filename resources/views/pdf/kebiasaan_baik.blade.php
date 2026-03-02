<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kebiasaan Baik Anak Asuh</title>
    <style>
        @page { margin: 40px; }
        body { font-family: sans-serif; font-size: 13px; margin: 0; padding: 0; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { font-size: 18px; color: #d81b60; margin: 0; text-transform: uppercase; }
        .info-table { width: 100%; margin-bottom: 15px; }
        .info-table td { padding: 3px 0; font-size: 12px; }
        .info-label { width: 130px; font-weight: bold; }
        
        .main-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .main-table th, .main-table td { border: 1px solid #000; padding: 6px 2px; text-align: center; }
        .main-table th { background-color: #f3f4f6; }
        .col-habit { text-align: left !important; font-weight: bold; width: 150px; font-size: 12px; padding-left: 6px !important; }
        .col-total { font-weight: bold; width: 45px; font-size: 11px; }
        .col-date { font-size: 10px; width: 20px; }
        
        .signature-table { width: 100%; margin-top: 40px; text-align: center; }
        .signature-table td { width: 33%; vertical-align: bottom; height: 90px; font-size: 12px; }
        .signature-line { margin-top: 50px; border-top: 1px solid #000; width: 160px; display: inline-block; }
        
        .quote { text-align: center; font-style: italic; font-size: 11px; margin-top: 20px; color: #555; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Kebiasaan Baik Anak Asuh</h1>
    </div>

    <table class="info-table">
        <tr>
            <td class="info-label">Nama Anak Asuh</td>
            <td>: {{ $anak->NamaLengkap }}</td>
        </tr>
        <tr>
            <td class="info-label">Nama Kakak Asuh</td>
            <td>: {{ $kakakAsuhName ?? '-' }}</td>
        </tr>
        <tr>
            <td class="info-label">Bulan</td>
            <td>: {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}</td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th rowspan="2" class="col-habit">Kebiasaan</th>
                <th colspan="31">Tanggal</th>
                <th rowspan="2" class="col-total">TOTAL</th>
            </tr>
            <tr>
                @for($i = 1; $i <= 31; $i++)
                    <th class="col-date">{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @php
                $habits = [
                    'Sholat Subuh' => 'SholatSubuh',
                    'Sholat Zuhur' => 'SholatZuhur',
                    'Sholat Ashar' => 'SholatAshar',
                    'Sholat Magrib' => 'SholatMagrib',
                    'Sholat Isya' => 'SholatIsya',
                    'Mengaji' => 'Mengaji',
                    'Berangkat Sekolah' => 'BerangkatSekolah',
                    'Bantu Orang Tua' => 'BantuOrangTua'
                ];
            @endphp

            @foreach($habits as $label => $key)
                <tr>
                    <td class="col-habit">{{ $label }}</td>
                    @for($i = 1; $i <= 31; $i++)
                        <td></td>
                    @endfor
                    <td class="col-total">{{ $kebiasaan ? $kebiasaan->$key : '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="quote">
        "Setiap kebiasaan baik yang kamu tanamkan hari ini akan menjadi kekuatan untuk menghadapi hari esok. Jadilah pribadi yang disiplin, berilmu, dan penuh semangat untuk menggapai cita-citamu."
    </div>

    <table class="signature-table">
        <tr>
            <td>
                Pelaksana<br><br><br><br>
                <div class="signature-line"></div><br>
                Anak Asuh
            </td>
            <td>
                Pendukung<br><br><br><br>
                <div class="signature-line"></div><br>
                Orang Tua
            </td>
            <td>
                Mengetahui<br><br><br><br>
                <div class="signature-line"></div><br>
                Kakak Asuh
            </td>
        </tr>
    </table>

</body>
</html>
