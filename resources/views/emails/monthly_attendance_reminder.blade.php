<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pengingat: Absensi Pendampingan Bulan Ini Belum Lengkap</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #fce7f3; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #fce7f3; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <tr>
                        <td align="center" style="padding: 30px; background-color: #ec4899;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px;">Pengingat Absensi Pendampingan</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 30px; color: #374151; line-height: 1.6;">
                            <h2 style="color: #1f2937; margin-top: 0;">Halo Kak {{ $kakakAsuh->NamaLengkap }},</h2>
                            <p>Semoga Kakak selalu dalam keadaan sehat dan semangat dalam menjalani aktivitas sehari-hari!</p>
                            
                            <p>Melalui email ini, kami dari Asuh Bareng ingin mengingatkan terkait <strong>kewajiban absensi pendampingan bulanan</strong> untuk anak-anak asuh Kakak. Mohon dipastikan Kakak telah memenuhi target absensi pendampingan berikut untuk bulan ini:</p>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 20px 0; background-color: #f9fafb; border-radius: 6px; padding: 15px;">
                                <tr>
                                    <td><strong>Pendampingan Offline:</strong></td>
                                    <td>Minimal 2x sebulan</td>
                                </tr>
                                <tr>
                                    <td><strong>Pendampingan Online:</strong></td>
                                    <td>Minimal 2x sebulan</td>
                                </tr>
                            </table>

                            <p>Berdasarkan catatan sistem kami, tampaknya absensi pendampingan Kakak untuk bulan ini belum mencapai kuota 2x Offline dan 2x Online.</p>
                            
                            <p>Dimohon kesediaannya untuk segera melengkapi pendampingan sebelum bulan ini berakhir, agar aktivitas pembinaan anak asuh tetap berjalan dengan optimal.</p>
                            
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 30px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ route('absensi_pendampingan.index') }}" style="background-color: #ec4899; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;">Isi Absensi Sekarang</a>
                                    </td>
                                </tr>
                            </table>
                            
                            <p>Apabila terdapat kendala teknis atau Kakak kebetulan sudah absen namun belum terekap, silakan hubungi tim Admin.</p>

                            <p>Terima kasih banyak atas dedikasi luar biasa Kakak untuk masa depan anak-anak asuh kita!</p>
                            <p style="margin-bottom: 0;">Salam hangat,<br><strong>Sistem Asuh Bareng</strong></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
