<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Akun Relawan Asuh Bareng Anda Telah Aktif</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8fafc; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8fafc; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <tr>
                        <td align="center" style="padding: 40px; background-color: #db2777;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: bold;">Selamat Datang!</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px; color: #334155; line-height: 1.6;">
                            <h2 style="color: #1e293b; margin-top: 0; font-size: 20px;">Halo, {{ $user->name }}!</h2>
                            <p>Selamat! Pendaftaran Anda sebagai relawan di <strong>Asuh Bareng</strong> telah diterima. Akun Anda kini telah aktif.</p>
                            
                            <div style="background-color: #f1f5f9; border-radius: 8px; padding: 20px; margin: 25px 0;">
                                <p style="margin-top: 0; font-weight: bold; color: #475569; font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em;">Kredensial Login Anda:</p>
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="100" style="padding: 8px 0; color: #64748b; font-size: 14px;">Email:</td>
                                        <td style="padding: 8px 0; color: #1e293b; font-weight: bold;">{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; color: #64748b; font-size: 14px;">Password:</td>
                                        <td style="padding: 8px 0; color: #1e293b; font-weight: bold;">{{ $password }}</td>
                                    </tr>
                                </table>
                            </div>

                            <p>Segera masuk ke dashboard untuk mulai mengelola program dan melaporkan aktivitas Anda melalui fitur Logbook.</p>
                            
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 30px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/login') }}" style="background-color: #db2777; color: #ffffff; padding: 14px 32px; text-decoration: none; border-radius: 8px; font-weight: bold; display: inline-block;">Login ke Dashboard</a>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size: 13px; color: #64748b; font-style: italic;">Catatan: Mohon segera ubah password Anda setelah login pertama kali di menu Profil demi keamanan.</p>
                            <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 30px 0;">
                            <p style="margin-bottom: 0;">Salam hangat,<br><strong style="color: #db2777;">Tim Asuh Bareng</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 20px; background-color: #f8fafc; color: #94a3b8; font-size: 12px;">
                            © {{ date('Y') }} Asuh Bareng. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
