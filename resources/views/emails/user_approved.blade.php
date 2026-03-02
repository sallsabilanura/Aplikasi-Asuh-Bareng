<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Akun Anda Telah Disetujui</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #fce7f3; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #fce7f3; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <tr>
                        <td align="center" style="padding: 30px; background-color: #ec4899;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px;">Selamat Datang di Asuh Bareng!</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 30px; color: #374151; line-height: 1.6;">
                            <h2 style="color: #1f2937; margin-top: 0;">Halo, {{ $user->name }}!</h2>
                            <p>Kabar gembira! Email dan akun kamu telah <strong>disetujui</strong> oleh Admin.</p>
                            <p>Mari masuk ke platform Asuh Bareng dan mulai berkolaborasi bersama kami dalam membimbing anak-anak asuh menuju cita-cita mereka!</p>
                            
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 30px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/login') }}" style="background-color: #22c55e; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;">Masuk ke Dashboard Sekarang</a>
                                    </td>
                                </tr>
                            </table>

                            <p>Terima kasih atas kepedulian Anda. Mari bersama-sama menciptakan masa depan yang lebih cerah!</p>
                            <p style="margin-bottom: 0;">Salam hangat,<br><strong>Tim Asuh Bareng & Zakat Sukses</strong></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
