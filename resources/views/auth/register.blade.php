{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Daftar • Asuh Bareng</title>
    
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

        .register-container {
            max-width: 420px;
            width: 100%;
        }

        .register-card {
            background: white;
            border-radius: 24px;
            padding: 40px 32px;
            box-shadow: 0 20px 40px -10px rgba(236, 72, 153, 0.2);
            border: 1px solid #f1f5f9;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 32px;
        }

        .logo-img {
            height: 48px;
            width: auto;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: #ec4899;
        }

        .title {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
            text-align: center;
        }

        .subtitle {
            font-size: 14px;
            color: #6b7280;
            text-align: center;
            margin-bottom: 32px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #4b5563;
            margin-bottom: 6px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .form-input:focus {
            outline: none;
            border-color: #ec4899;
            box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
        }

        .btn-register {
            width: 100%;
            background: #ec4899;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            margin: 24px 0 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-register:hover {
            background: #db2777;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(236, 72, 153, 0.4);
        }

        .login-link {
            text-align: center;
            font-size: 13px;
            color: #6b7280;
        }

        .login-link a {
            color: #ec4899;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .validation-errors {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .validation-errors ul {
            list-style: none;
            padding-left: 0;
        }

        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            margin-top: 24px;
            color: #6b7280;
            font-size: 13px;
            text-decoration: none;
        }

        .back-link:hover {
            color: #ec4899;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <!-- Logo -->
         

            <!-- Title -->
            <h1 class="title">Buat Akun Baru</h1>
            <p class="subtitle">Daftar untuk menjadi bagian dari Asuh Bareng</p>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="validation-errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap</label>
                    <input class="form-input" 
                           id="name" 
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus 
                           placeholder="Masukkan nama lengkap">
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-input" 
                           id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           placeholder="Masukkan email">
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-input" 
                           id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="new-password"
                           placeholder="Minimal 8 karakter">
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <input class="form-input" 
                           id="password_confirmation" 
                           type="password" 
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password"
                           placeholder="Ulangi password">
                </div>



                <!-- Submit Button -->
                <button type="submit" class="btn-register">
                    <span>Daftar</span>
                    <i data-lucide="arrow-right" style="width: 18px;"></i>
                </button>

                <!-- Login Link -->
                <div class="login-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
                </div>
            </form>

            <!-- Back to Home -->
            <a href="{{ url('/') }}" class="back-link">
                <i data-lucide="arrow-left" style="width: 14px;"></i>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>