<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pendaftaran Kakak Asuh Baru</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #fce7f3; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #fce7f3; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <tr>
                        <td align="center" style="padding: 30px; background-color: #ec4899;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px;">Pemberitahuan Sistem</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 30px; color: #374151; line-height: 1.6;">
                            <h2 style="color: #1f2937; margin-top: 0;">Halo, Admin!</h2>
                            <p>Ada <strong>Kakak Asuh baru</strong> yang baru saja mendaftar di platform Asuh Bareng dan saat ini sedang <strong>menunggu persetujuan</strong> Anda.</p>
                            
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 20px 0; background-color: #f9fafb; border-radius: 6px; padding: 15px;">
                                <tr>
                                    <td><strong>Nama:</strong></td>
                                    <td>{{ $newUser->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $newUser->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Waktu Daftar:</strong></td>
                                    <td>{{ $newUser->created_at->format('d M Y, H:i') }}</td>
                                </tr>
                            </table>
                            
                            <p>Silakan tinjau dan berikan persetujuan agar relawan ini bisa login ke dalam sistem.</p>
                            
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 30px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ route('users.index') }}" style="background-color: #22c55e; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;">Tinjau & Setujui Sekarang</a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin-bottom: 0;">Salam hangat,<br><strong>Sistem Asuh Bareng</strong></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
