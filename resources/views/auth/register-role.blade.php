{{-- resources/views/auth/register-role.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Pilih Peran • Asuh Bareng</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('bareng.png') }}" type="image/png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fdf2f8 0%, #ffffff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 48px;
        }

        .title {
            font-size: 32px;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 12px;
            background: linear-gradient(to r, #ec4899, #f43f5e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle {
            font-size: 16px;
            color: #6b7280;
        }

        .role-grid {
            display: grid;
            grid-template-cols: 1fr;
            gap: 24px;
        }

        @media (min-width: 640px) {
            .role-grid {
                grid-template-cols: 1fr 1fr;
            }
        }

        .role-card {
            background: white;
            border-radius: 24px;
            padding: 40px 32px;
            border: 2px solid transparent;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            height: 100%;
        }

        .role-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(236, 72, 153, 0.1), 0 10px 10px -5px rgba(236, 72, 153, 0.04);
            border-color: #fce7f3;
        }

        .role-card.selected {
            border-color: #ec4899;
            background: #fffdfd;
        }

        .role-icon {
            width: 80px;
            height: 80px;
            background: #fdf2f8;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            color: #ec4899;
            transition: all 0.3s;
        }

        .role-card:hover .role-icon {
            background: #ec4899;
            color: white;
            transform: scale(1.1);
        }

        .role-name {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 12px;
        }

        .role-desc {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 24px;
            flex-grow: 1;
        }

        .btn-submit {
            width: 100%;
            background: #ec4899;
            color: white;
            border: none;
            padding: 16px;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: 0 10px 15px -3px rgba(236, 72, 153, 0.3);
            opacity: 0.5;
            pointer-events: none;
        }

        .btn-submit.active {
            opacity: 1;
            pointer-events: auto;
        }

        .btn-submit.active:hover {
            background: #db2777;
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(236, 72, 153, 0.4);
        }

        .check-mark {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #ec4899;
            opacity: 0;
            transform: scale(0.5);
            transition: all 0.2s;
        }

        .role-card.selected .check-mark {
            opacity: 1;
            transform: scale(1);
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="title">Halo, {{ Auth::user()->name }}!</h1>
            <p class="subtitle">Satu langkah terakhir. Apa peran yang ingin Anda ambil dalam kebaikan ini?</p>
        </div>

        <form id="role-form" method="POST" action="{{ route('register.role') }}">
            @csrf
            <input type="hidden" name="role" id="role-input">

            <div class="role-grid">
                <!-- Donatur -->
                <div class="role-card" onclick="selectRole('donatur', this)">
                    <div class="check-mark">
                        <i data-lucide="check-circle-2" style="width: 24px;"></i>
                    </div>
                    <div class="role-icon">
                        <i data-lucide="heart" style="width: 40px; height: 40px;"></i>
                    </div>
                    <h2 class="role-name">Donatur</h2>
                    <p class="role-desc">Membantu memberikan dukungan finansial secara langsung untuk pendidikan dan kesehatan anak-anak asuh.</p>
                </div>

                <!-- Kakak Asuh -->
                <div class="role-card" onclick="selectRole('kakak_asuh', this)">
                    <div class="check-mark">
                        <i data-lucide="check-circle-2" style="width: 24px;"></i>
                    </div>
                    <div class="role-icon">
                        <i data-lucide="users" style="width: 40px; height: 40px;"></i>
                    </div>
                    <h2 class="role-name">Kakak Asuh</h2>
                    <p class="role-desc">Menjadi pengurus yang mendampingi, melaporkan perkembangan, dan menjadi mentor bagi anak-anak asuh.</p>
                </div>
            </div>

            <button type="submit" id="submit-btn" class="btn-submit">
                <span>Lanjutkan ke Dashboard</span>
                <i data-lucide="arrow-right" style="width: 20px;"></i>
            </button>
        </form>

        <div class="footer">
            <form method="POST" action="{{ route('logout') }}" id="logout-all">
                @csrf
                Ingin membatalkan? <a href="#" onclick="event.preventDefault(); document.getElementById('logout-all').submit();" style="color: #6b7280; font-weight: 600; text-decoration: none;">Keluar saja</a>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function selectRole(role, element) {
            // Update input
            document.getElementById('role-input').value = role;

            // Update UI
            document.querySelectorAll('.role-card').forEach(card => card.classList.remove('selected'));
            element.classList.add('selected');

            // Activate button
            document.getElementById('submit-btn').classList.add('active');
        }
    </script>
</body>
</html>
