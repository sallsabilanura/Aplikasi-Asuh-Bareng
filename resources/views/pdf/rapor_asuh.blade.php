<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapor Asuh - {{ $anak->NamaLengkap }}</title>
    <style>
        @page { margin: 40px; }
        body { 
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            margin: 0; 
            padding: 0;
            background-color: #ffffff;
            color: #374151; /* gray-700 */
        }

        /* Legacy SVG fallback for DomPDF */
        .star-box img {
            width: 15px;
            height: 15px;
            margin-right: 2px;
            vertical-align: middle;
        }

        .header-table { width: 100%; border-bottom: 3px solid #f9a8d4; /* pink-300 */ padding-bottom: 15px; margin-bottom: 25px; }
        .header-table td { vertical-align: top; }
        .title { font-size: 24px; font-weight: bold; color: #16a34a; /* green-600 */ text-transform: uppercase; letter-spacing: 1px; }
        .subtitle { font-size: 14px; color: #6b7280; font-weight: bold; margin-top: 5px; }

        .info-table { width: 100%; margin-bottom: 30px; font-size: 14px; }
        .info-table td { padding: 6px 0; vertical-align: middle; border-bottom: 1px solid #f3f4f6; }
        .info-table .info-label { font-weight: bold; width: 150px; color: #4b5563; }
        .profile-photo {
            width: 110px;
            height: 130px;
            object-fit: cover;
            border-radius: 8px;
            border: 4px solid #fce7f3; /* pink-100 */
        }

        .section-title {
            background-color: #fdf2f8; /* pink-50 */
            color: #be185d; /* pink-700 */
            padding: 8px 15px;
            font-weight: bold;
            border-left: 5px solid #ec4899; /* pink-500 */
            margin-bottom: 15px;
            font-size: 14px;
            text-transform: uppercase;
            border-radius: 0 4px 4px 0;
        }

        .section-title-green {
            background-color: #f0fdf4; /* green-50 */
            color: #15803d; /* green-700 */
            border-left: 5px solid #22c55e; /* green-500 */
        }

        .grid-table { width: 100%; margin-bottom: 20px; border: 1px solid #e5e7eb; border-radius: 8px; border-collapse: collapse; }
        .grid-table td { vertical-align: top; padding: 15px; }
        
        .rating-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .rating-table td { padding: 8px 0; border-bottom: 1px dashed #e5e7eb; }
        .rating-label { font-weight: bold; width: 55%; color: #374151; }

        .stat-box {
            text-align: center;
            background-color: #f9fafb;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin-top: 10px;
        }

        .summary-box {
            border: 1px solid #fbcfe8; /* pink-200 */
            padding: 15px;
            border-radius: 8px;
            line-height: 1.5;
            background-color: #fffafc;
            color: #374151;
            font-size: 13px;
            text-align: justify;
            margin-bottom: 20px;
        }

        .photo-box { text-align: center; margin-top: 10px; }
        .photo-box img { max-width: 250px; max-height: 150px; object-fit: contain; border-radius: 8px; border: 3px solid #d1d5db; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
            line-height: 1.4;
        }
    </style>
</head>
<body>

@php
    // Base64 encode an SVG for DOMPDF
    $starFull = 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#fbbf24"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>');
    $starEmpty = 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#e5e7eb"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>');
@endphp

<table class="header-table">
    <tr>
        <td style="width: 70%;">
            <div class="title">Rapor Asuh Semester</div>
            <div class="subtitle">Periode: {{ $periodeName }}</div>
        </td>
        <td style="width: 30%; text-align: right;">
            <img src="{{ public_path('bareng.png') }}" alt="AsuhBareng" style="height: 45px;">
        </td>
    </tr>
</table>

<table class="info-table" style="table-layout: fixed;">
    <tr>
        <td class="info-label" style="width: 25%;">Nama Lengkap</td>
        <td style="width: 50%;">: <strong style="color: #111;">{{ $anak->NamaLengkap }}</strong></td>
        <td rowspan="4" style="width: 25%; text-align: right; border-bottom: none;">
            @if($anak->FotoAnak)
                <img src="{{ public_path('storage/' . $anak->FotoAnak) }}" class="profile-photo">
            @else
                <div style="width:110px; height:130px; background:#f3f4f6; text-align:center; line-height:130px; border:4px solid #fce7f3; border-radius:8px; display:inline-block; font-size:12px; color:#9ca3af;">No Photo</div>
            @endif
        </td>
    </tr>
    <tr>
        <td class="info-label">Umur / Tingkat</td>
        <td>: {{ $anak->umur }} Thn / {{ $anak->Sekolah ?? '-' }}</td>
    </tr>
    <tr>
        <td class="info-label">Kakak Asuh</td>
        <td>: <span style="font-weight: bold; color: #ec4899;">{{ $rapor->kakakAsuh->NamaLengkap ?? 'Belum Ditugaskan' }}</span></td>
    </tr>
    <tr>
        <td class="info-label">Status Pendampingan</td>
        <td>: Aktif Mengikuti Kegiatan</td>
    </tr>
</table>

<div class="section-title section-title-green">A. Nilai Perkembangan & Evaluasi Pribadi</div>
<table class="grid-table" cellspacing="0" style="table-layout: fixed;">
    <tr>
        <td style="width: 55%; padding-right: 20px; border-right: 1px solid #e5e7eb;">
            <table class="rating-table">
                <tr>
                    <td class="rating-label">Mengerjakan Ibadah Wajib</td>
                    <td>
                        <div class="star-box">
                            @for($i=1; $i<=5; $i++)
                                @if($i <= $starIbadah) <img src="{{ $starFull }}"> @else <img src="{{ $starEmpty }}"> @endif
                            @endfor
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Karakter & Sikap Kegiatan</td>
                    <td>
                        <div class="star-box">
                            @for($i=1; $i<=5; $i++)
                                @if($i <= $starKarakter) <img src="{{ $starFull }}"> @else <img src="{{ $starEmpty }}"> @endif
                            @endfor
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Keaktifan & Antusias Belajar</td>
                    <td>
                        <div class="star-box">
                            @for($i=1; $i<=5; $i++)
                                @if($i <= $starPendidikan) <img src="{{ $starFull }}"> @else <img src="{{ $starEmpty }}"> @endif
                            @endfor
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label" style="border-bottom:none;">Menjaga Kesehatan Fisik</td>
                    <td style="border-bottom:none;">
                        <div class="star-box">
                            @for($i=1; $i<=5; $i++)
                                @if($i <= $starKesehatan) <img src="{{ $starFull }}"> @else <img src="{{ $starEmpty }}"> @endif
                            @endfor
                        </div>
                    </td>
                </tr>
            </table>
        </td>
        <td style="width: 40%; padding-left: 25px; border-left: 1px solid #e5e7eb; vertical-align: middle;">
            <div class="stat-box">
                <h3 style="color: #6b7280; font-size: 13px; margin-top: 0; text-transform: uppercase; letter-spacing: 0.5px;">Statistik Kehadiran</h3>
                <div style="font-size: 32px; font-weight: bold; color: #16a34a; margin: 15px 0;">
                    Hadir: {{ $totalHadir }} Kali
                </div>
                <div style="font-size: 12px; color: #9ca3af; font-weight: bold;">
                    (Dari target 24 pertemuan wajib per semester)
                </div>
            </div>
        </td>
    </tr>
</table>

<div class="section-title">B. Ringkasan & Catatan Perkembangan Anak</div>
<div class="summary-box">
    {!! nl2br(e($rapor->RingkasanPerkembangan ?? 'Belum ada ringkasan yang ditulis untuk periode ini.')) !!}
</div>

@if($photoAktifitas)
<div class="section-title" style="background-color: #f3f4f6; color: #4b5563; border-left-color: #9ca3af;">C. Dokumentasi Kegiatan Terakhir</div>
<div class="photo-box">
    <img src="{{ public_path('storage/' . $photoAktifitas->FotoBukti) }}" alt="Foto Kegiatan">
</div>
@endif

<div class="footer">
    <strong>Catatan:</strong> Nilai perkembangan dihitung secara otomatis berdasarkan intensitas keikutsertaan anak dalam program<br>
    Absensi Pendampingan, Cek Kesehatan, dan laporan Kebiasaan Baik selama 6 bulan terakhir.<br><br>
    <span style="color: #ec4899; font-weight: bold;">Terima kasih kepada bapak/ibu donatur pendukung anak ini. Semoga rezekinya dilancarkan dan berkah selalu.</span>
</div>

</body>
</html>
