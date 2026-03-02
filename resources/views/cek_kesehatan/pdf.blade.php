<!DOCTYPE html>
<html>
<head>
    <title>Laporan Cek Kesehatan</title>
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
    <div style="text-align: center; margin-bottom: 5px;">
        <h3 style="margin: 0; font-size: 16px; font-weight: bold;">Form Pemeriksaan Kesehatan Kegiatan Anak Asuh</h3>
        <p style="margin: 5px 0; font-size: 12px;">Dilakukan oleh: </p>
    </div>

    @foreach($ceks as $cek)
        <div style="page-break-after: always; padding-top: 10px;">
            <!-- 1. Identitas Anak -->
            <div style="margin-bottom: 15px;">
                <h4 style="margin: 0 0 5px 0; font-size: 13px; font-weight: bold;">1. Identitas Anak</h4>
                <table style="border: none; margin-left: 20px; margin-top: 0;">
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px; width: 140px;">• Nama Lengkap</td>
                        <td style="border: none; padding: 1px;">: {{ $cek->anakAsuh->NamaLengkap ?? '....................' }}</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Usia</td>
                        <td style="border: none; padding: 1px;">: {{ $cek->anakAsuh->umur ?? '....' }} Tahun</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Jenis Kelamin</td>
                        <td style="border: none; padding: 1px;">: {{ ($cek->anakAsuh->JenisKelamin ?? '') == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Nama Orang Tua</td>
                        <td style="border: none; padding: 1px;">: ........................................</td>
                    </tr>
                </table>
            </div>

            <!-- 2. Data Kesehatan Dasar -->
            <div style="margin-bottom: 15px;">
                <h4 style="margin: 0 0 5px 0; font-size: 13px; font-weight: bold;">2. Data Kesehatan Dasar</h4>
                <table style="border: none; margin-left: 20px; margin-top: 0;">
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px; width: 180px;">• Berat Badan (kg)</td>
                        <td style="border: none; padding: 1px;">: {{ $cek->BeratBadan }} kg</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Tinggi Badan (cm)</td>
                        <td style="border: none; padding: 1px;">: {{ $cek->TinggiBadan }} cm</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Lingkar Kepala (cm)</td>
                        <td style="border: none; padding: 1px;">: {{ $cek->LingkarKepala ?? '....' }} cm</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Indeks Massa Tubuh (IMT)</td>
                        <td style="border: none; padding: 1px;">: {{ $cek->IMT ?? '....' }}</td>
                    </tr>
                </table>
            </div>

            <!-- 3. Pemeriksaan Kesehatan Umum -->
            <div style="margin-bottom: 15px;">
                <h4 style="margin: 0 0 5px 0; font-size: 13px; font-weight: bold;">3. Pemeriksaan Kesehatan Umum</h4>
                <table style="border: none; margin-left: 20px; margin-top: 0;">
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px; width: 180px;">• Status Gizi</td>
                        <td style="border: none; padding: 1px;">: {{ ucfirst($cek->StatusGizi) }} (Baik / Kurang / Berlebih)</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Kesehatan Mata</td>
                        <td style="border: none; padding: 1px;">: {{ ucfirst($cek->KesehatanMata) }} (Normal / Minus / Plus / Silinder)</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Kesehatan Gigi & Mulut</td>
                        <td style="border: none; padding: 1px;">: {{ str_replace('_', ' ', ucfirst($cek->KesehatanGigi)) }} (Baik / Ada lubang gigi / Karang gigi)</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Pendengaran</td>
                        <td style="border: none; padding: 1px;">: {{ ucfirst($cek->Pendengaran) }} (Normal / Gangguan)</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Riwayat Penyakit</td>
                        <td style="border: none; padding: 1px;">: {{ $cek->RiwayatPenyakit ?? '........................................' }} (Alergi / Asma / Epilepsi / Lainnya)</td>
                    </tr>
                </table>
            </div>

            <!-- 4. Pemeriksaan Motorik & Sensorik -->
            <div style="margin-bottom: 15px;">
                <h4 style="margin: 0 0 5px 0; font-size: 13px; font-weight: bold;">4. Pemeriksaan Motorik & Sensorik</h4>
                <table style="border: none; margin-left: 20px; margin-top: 0;">
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px; width: 120px;">• Motorik Kasar</td>
                        <td style="border: none; padding: 1px;">: {{ str_replace('_', ' ', ucfirst($cek->MotorikKasar)) }} (Berjalan, Berlari, Melompat, Keseimbangan)</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Motorik Halus</td>
                        <td style="border: none; padding: 1px;">: {{ str_replace('_', ' ', ucfirst($cek->MotorikHalus)) }} (Menulis, Menggambar, Mengancingkan Baju, Menggunakan Sendok)</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Koordinasi & Respons Sensorik</td>
                        <td style="border: none; padding: 1px;">: {{ str_replace('_', ' ', ucfirst($cek->ResponsSensorik)) }} (Respon Terhadap Suara, Cahaya, Sentuhan, dll.)</td>
                    </tr>
                </table>
            </div>

            <!-- 5. Pemeriksaan Perkembangan Psikososial & Emosional -->
            <div style="margin-bottom: 15px;">
                <h4 style="margin: 0 0 5px 0; font-size: 13px; font-weight: bold;">5. Pemeriksaan Perkembangan Psikososial & Emosional</h4>
                <table style="border: none; margin-left: 20px; margin-top: 0;">
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px; width: 220px;">• Interaksi Sosial dengan Sebaya</td>
                        <td style="border: none; padding: 1px;">: {{ str_replace('_', ' ', ucfirst($cek->InteraksiSosial)) }} (Baik / Perlu Pendampingan)</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Kemampuan Fokus & Konsentrasi</td>
                        <td style="border: none; padding: 1px;">: {{ str_replace('_', ' ', ucfirst($cek->FokusKonsentrasi)) }} (Baik / Perlu Latihan)</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Ekspresi Emosi</td>
                        <td style="border: none; padding: 1px;">: {{ ucfirst($cek->EkspresiEmosi) }} (Cemas, Pemalu, Percaya Diri, dll. Sebutkan jika ada hal khusus)</td>
                    </tr>
                </table>
            </div>

            <!-- 6. Kebiasaan Makan & Pola Tidur -->
            <div style="margin-bottom: 15px;">
                <h4 style="margin: 0 0 5px 0; font-size: 13px; font-weight: bold;">6. Kebiasaan Makan & Pola Tidur</h4>
                <table style="border: none; margin-left: 20px; margin-top: 0;">
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px; width: 220px;">• Frekuensi Makan dalam Sehari</td>
                        <td style="border: none; padding: 1px;">: {{ $cek->FrekuensiMakan }} (2x / 3x / Lebih dari 3x)</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Jenis Makanan yang Dikonsumsi</td>
                        <td style="border: none; padding: 1px;">: {{ str_replace('_', ' ', ucfirst($cek->JenisMakanan)) }} (Seimbang / Kurang Sayur & Buah / Sering Makan Junk Food)</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Pola Tidur</td>
                        <td style="border: none; padding: 1px;">: {{ ucfirst($cek->PolaTidur) }} (Cukup (≥8 Jam) / Kurang Tidur (<8 Jam))</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Mulai Tidur Jam</td>
                        <td style="border: none; padding: 1px;">
                            : {{ $cek->WaktuTidur ? \Carbon\Carbon::parse($cek->WaktuTidur)->format('H:i') : '.........' }}
                            &nbsp;&nbsp;&nbsp;&nbsp;<b>Bangun Tidur Jam</b> : {{ $cek->WaktuBangun ? \Carbon\Carbon::parse($cek->WaktuBangun)->format('H:i') : '.........' }}
                        </td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; padding: 1px;">• Kebiasaan Tidur</td>
                        <td style="border: none; padding: 1px;">: {{ str_replace('_', ' ', ucfirst($cek->KebiasaanTidur)) }} (Tidur Teratur / Sering Begadang / Sering Terbangun di Malam)</td>
                    </tr>
                </table>
            </div>

            <!-- Footer -->
            <div style="margin-top: 20px;">
                <div style="width: 60%; float: left; border: 1px solid #000; padding: 5px; min-height: 100px;">
                    <span style="font-weight: bold; text-decoration: underline; font-size: 11px;">Catatan Pemeriksaan :</span>
                    <p style="font-size: 11px; margin-top: 5px;">{{ $cek->CatatanPemeriksaan }}</p>
                </div>
                <div style="width: 35%; float: right; text-align: center;">
                    <p style="font-size: 11px; margin-bottom: 50px;">Pemeriksa</p>
                    <p style="font-size: 11px;">( ........................................ )</p>
                    <p style="font-size: 11px; font-weight: bold;">{{ $cek->TandaTanganPemeriksa }}</p>
                </div>
                <div style="clear: both;"></div>
            </div>
            
            <div style="margin-top: 10px; font-size: 10px; color: #888;">
                Tanggal Pemeriksaan: {{ \Carbon\Carbon::parse($cek->TanggalPemeriksaan)->translatedFormat('d F Y') }}
            </div>
        </div>
    @endforeach
</body>
</body>
</html>
