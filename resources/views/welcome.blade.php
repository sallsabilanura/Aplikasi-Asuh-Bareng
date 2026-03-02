<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asuh Bareng • Platform Monitoring Anak Asuh</title>
    
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
            background-color: #ffffff;
            color: #1f2937;
            line-height: 1.5;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            padding: 16px 0;
            background: white;
            border-bottom: 1px solid #f1f5f9;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo-img {
            height: 32px;
            width: auto;
        }

        .logo-text {
            font-size: 18px;
            font-weight: 600;
            color: #ec4899;
        }

        .nav-links {
            display: flex;
            gap: 32px;
        }

        .nav-link {
            font-size: 14px;
            font-weight: 500;
            color: #4b5563;
            text-decoration: none;
        }

        .nav-link:hover {
            color: #ec4899;
        }

        .auth-buttons {
            display: flex;
            gap: 16px;
        }

        .btn-login {
            font-size: 14px;
            font-weight: 500;
            color: #4b5563;
            text-decoration: none;
            padding: 8px 0;
        }

        .btn-register {
            font-size: 14px;
            font-weight: 500;
            color: white;
            background: #ec4899;
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 6px;
        }

        .btn-dashboard {
            font-size: 14px;
            font-weight: 500;
            color: white;
            background: #ec4899;
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 6px;
        }

        /* Hero Section */
        .hero {
            padding: 120px 0 60px;
            background: linear-gradient(135deg, #fdf2f8 0%, #ffffff 100%);
        }

        .hero-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .hero-badge {
            display: inline-block;
            background: #fce7f3;
            color: #ec4899;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .hero-title {
            font-size: 42px;
            font-weight: 700;
            line-height: 1.2;
            color: #1f2937;
            margin-bottom: 16px;
        }

        .hero-subtitle {
            font-size: 18px;
            font-weight: 400;
            color: #6b7280;
            margin-top: 8px;
        }

        .hero-text {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 30px;
            max-width: 450px;
        }

        .hero-highlight {
            color: #ec4899;
            font-weight: 600;
        }

        .hero-buttons {
            display: flex;
            gap: 12px;
            margin-bottom: 40px;
        }

        .btn-primary {
            background: #ec4899;
            color: white;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid #e2e8f0;
            color: #4b5563;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .hero-stats {
            display: flex;
            gap: 40px;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
        }

        .stat-label {
            font-size: 13px;
            color: #6b7280;
        }

        .hero-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border: 1px solid #f1f5f9;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .card-item {
            text-align: center;
            padding: 16px;
            background: #f8fafc;
            border-radius: 8px;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            background: #fce7f3;
            border-radius: 8px;
            margin: 0 auto 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-icon.green {
            background: #dcfce7;
        }

        .card-icon i {
            width: 20px;
            height: 20px;
            color: #ec4899;
        }

        .card-icon.green i {
            color: #22c55e;
        }

        .card-title {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .card-desc {
            font-size: 11px;
            color: #6b7280;
        }

        /* Sections */
        .section {
            padding: 60px 0;
        }

        .section-light {
            background: #f8fafc;
        }

        .section-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .section-title span {
            color: #ec4899;
        }

        .section-subtitle {
            font-size: 15px;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
        }

        /* PROGRAM CARDS - GAMBAR BESAR */
        .program-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .program-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .program-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(236, 72, 153, 0.1);
        }

        .program-image {
            height: 240px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8fafc, #ffffff);
            padding: 20px;
        }

        .program-image img {
            transition: transform 0.3s ease;
        }

        .program-card:hover .program-image img {
            transform: scale(1.05);
        }

        .program-content {
            padding: 24px;
            text-align: center;
        }

        .program-title {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .program-desc {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
        }

        /* Feature Cards */
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .feature-card {
            background: white;
            border-radius: 8px;
            padding: 24px 16px;
            border: 1px solid #f1f5f9;
            text-align: center;
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }

        .feature-icon.pink {
            background: #fce7f3;
        }

        .feature-icon.green {
            background: #dcfce7;
        }

        .feature-icon i {
            width: 22px;
            height: 22px;
        }

        .feature-icon.pink i {
            color: #ec4899;
        }

        .feature-icon.green i {
            color: #22c55e;
        }

        .feature-title {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .feature-desc {
            font-size: 12px;
            color: #6b7280;
        }

        /* About Section */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }

        .about-text {
            font-size: 15px;
            color: #4b5563;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .about-list {
            list-style: none;
        }

        .about-item {
            display: flex;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .about-check {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            background: #fce7f3;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .about-check i {
            width: 12px;
            height: 12px;
            color: #ec4899;
        }

        .about-check.green {
            background: #dcfce7;
        }

        .about-check.green i {
            color: #22c55e;
        }

        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            border: 1px solid #f1f5f9;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .stat-item-center {
            text-align: center;
        }

        .stat-value-lg {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .stat-value-lg.pink {
            color: #ec4899;
        }

        .stat-value-lg.green {
            color: #22c55e;
        }

        .stat-label-sm {
            font-size: 12px;
            color: #6b7280;
        }

        /* Testimonials */
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .testimonial-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            border: 1px solid #f1f5f9;
        }

        .testimonial-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 20px;
            background: #ec4899;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        .avatar-info h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .avatar-info p {
            font-size: 11px;
            color: #6b7280;
        }

        .testimonial-quote {
            font-size: 13px;
            color: #4b5563;
            font-style: italic;
            line-height: 1.5;
        }

        /* CTA Section */
        .cta-section {
            background: #fdf2f8;
            padding: 60px 0;
            text-align: center;
        }

        .cta-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .cta-text {
            font-size: 15px;
            color: #6b7280;
            margin-bottom: 24px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        /* Recruitment Banner - Professional Design */
        .recruitment-banner {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            position: relative;
            overflow: hidden;
            padding: 40px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        /* Galeri Asuh */
        .galeri-section {
            padding: 80px 0;
            background: #fff;
        }

        .galeri-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .galeri-item {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            aspect-ratio: 4/3;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            group: hover;
            cursor: pointer;
        }

        .galeri-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .galeri-item:hover .galeri-img {
            transform: scale(1.1);
        }

        .galeri-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 50%);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 24px;
        }

        .galeri-item:hover .galeri-overlay {
            opacity: 1;
        }

        .galeri-caption {
            color: white;
            font-weight: 500;
            font-size: 15px;
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .galeri-item:hover .galeri-caption {
            transform: translateY(0);
        }

        .recruitment-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(236,72,153,0.15) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }

        .recruitment-banner::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(34,197,94,0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }

        .banner-content {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 30px;
        }

        .banner-left {
            flex: 1;
            min-width: 300px;
        }

        .banner-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(236, 72, 153, 0.15);
            color: #ec4899;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
            border: 1px solid rgba(236, 72, 153, 0.3);
            backdrop-filter: blur(5px);
        }

        .banner-title {
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pulse-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            background: #ec4899;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(236, 72, 153, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(236, 72, 153, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(236, 72, 153, 0);
            }
        }

        .banner-description {
            color: #94a3b8;
            font-size: 15px;
            margin-bottom: 20px;
            max-width: 500px;
            line-height: 1.6;
        }

        .banner-benefits {
            display: flex;
            flex-wrap: wrap;
            gap: 16px 24px;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #cbd5e1;
            font-size: 13px;
        }

        .benefit-item i {
            color: #ec4899;
        }

        .banner-right {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            padding: 24px 28px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            min-width: 260px;
            text-align: center;
        }

        .stats-mini {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-bottom: 20px;
        }

        .stat-mini-item {
            display: flex;
            flex-direction: column;
        }

        .stat-mini-value {
            font-size: 28px;
            font-weight: 700;
            color: #ec4899;
            line-height: 1.2;
        }

        .stat-mini-label {
            font-size: 11px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .banner-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #ec4899;
            color: white;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 12px;
            width: 100%;
            border: 1px solid transparent;
        }

        .banner-cta:hover {
            background: #db2777;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(236, 72, 153, 0.5);
        }

        .banner-deadline {
            font-size: 12px;
            color: #64748b;
            margin: 0;
        }

        /* Footer */
        .footer {
            background: #1f2937;
            padding: 40px 0 20px;
            color: white;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 30px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .footer-logo img {
            height: 28px;
            width: auto;
            background: rgba(255,255,255,0.1);
            border-radius: 4px;
            padding: 4px;
        }

        .footer-logo span {
            font-size: 16px;
            font-weight: 600;
            color: #ec4899;
        }

        .footer-text {
            font-size: 13px;
            color: #9ca3af;
            line-height: 1.6;
        }

        .footer-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links a {
            color: #9ca3af;
            font-size: 13px;
            text-decoration: none;
        }

        .footer-links a:hover {
            color: #ec4899;
        }

        .partner-card {
            background: rgba(255,255,255,0.05);
            border-radius: 6px;
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .partner-card img {
            height: 24px;
            width: 24px;
            border-radius: 4px;
        }

        .partner-card span {
            font-size: 13px;
            font-weight: 500;
            color: #22c55e;
        }

        .footer-bottom {
            border-top: 1px solid #374151;
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #6b7280;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-container,
            .about-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }
            
            .program-grid,
            .feature-grid,
            .testimonial-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-links {
                display: none;
            }
            
            .hero-title {
                font-size: 32px;
            }

            .banner-content {
                flex-direction: column;
                text-align: center;
            }
            
            .banner-left {
                text-align: center;
            }
            
            .banner-description {
                margin-left: auto;
                margin-right: auto;
            }
            
            .banner-benefits {
                justify-content: center;
            }
            
            .banner-right {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="navbar-content">
                <div class="logo">
                    <img class="logo-img" src="{{ asset('bareng.png') }}" alt="Asuh Bareng">
                </div>

                <div class="nav-links">
                    <a href="#beranda" class="nav-link">Beranda</a>
                    <a href="#program" class="nav-link">Program</a>
                    <a href="#fitur" class="nav-link">Fitur</a>
                    <a href="#tentang" class="nav-link">Tentang</a>
                </div>

                <div class="auth-buttons">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-dashboard">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-login">Masuk</a>
                            <a href="{{ route('register') }}" class="btn-register">Daftar</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero">
        <div class="container">
            <div class="hero-container">
                <div>
                    <div class="hero-badge">Kolaborasi dengan Zakat Sukses</div>
                    
                    <h1 class="hero-title">
                        Asuh Bareng
                        <div class="hero-subtitle">Platform Monitoring Anak Asuh</div>
                    </h1>
                    
                    <p class="hero-text">
                        Bersama <span class="hero-highlight">Zakat Sukses</span>, kami hadir untuk menemani setiap langkah perkembangan anak-anak asuh.
                    </p>

                    <div class="hero-buttons">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-primary">
                                <span>Dashboard</span>
                                <i data-lucide="arrow-right" style="width: 14px;"></i>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn-primary">
                                <span>Mulai Sekarang</span>
                                <i data-lucide="arrow-right" style="width: 14px;"></i>
                            </a>
                        @endauth
                        
                        <a href="#program" class="btn-secondary">
                            <span>Program</span>
                            <i data-lucide="chevron-down" style="width: 14px;"></i>
                        </a>
                    </div>

                    <div class="hero-stats">
                        <div>
                            <div class="stat-number">500+</div>
                            <div class="stat-label">Anak Asuh</div>
                        </div>
                        <div>
                            <div class="stat-number">50+</div>
                            <div class="stat-label">Kakak Asuh</div>
                        </div>
                        <div>
                            <div class="stat-number">100%</div>
                            <div class="stat-label">Transparan</div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="hero-card">
                        <div class="card-grid">
                            <div class="card-item">
                                <div class="card-icon">
                                    <i data-lucide="calendar-check"></i>
                                </div>
                                <div class="card-title">Absensi</div>
                                <div class="card-desc">Pendampingan rutin</div>
                            </div>
                            <div class="card-item">
                                <div class="card-icon green">
                                    <i data-lucide="heart-pulse"></i>
                                </div>
                                <div class="card-title">Kesehatan</div>
                                <div class="card-desc">Pemantauan rutin</div>
                            </div>
                            <div class="card-item">
                                <div class="card-icon">
                                    <i data-lucide="file-text"></i>
                                </div>
                                <div class="card-title">Laporan</div>
                                <div class="card-desc">Data lengkap PDF</div>
                            </div>
                            <div class="card-item">
                                <div class="card-icon green">
                                    <i data-lucide="users"></i>
                                </div>
                                <div class="card-title">Komunitas</div>
                                <div class="card-desc">Kolaborasi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        $rekrutmenSetting = \App\Models\SettingRekrutmen::first();
        $hasActivePosisi = \App\Models\PosisiRekrutmen::where('IsActive', true)->exists();
    @endphp

    @if($rekrutmenSetting && $rekrutmenSetting->IsActive && $hasActivePosisi)
    <!-- Recruitment Banner - Professional Design -->
    <section class="recruitment-banner">
        <div class="container">
            <div class="banner-content">
                <div class="banner-left">
                    <span class="banner-badge">
                        <i data-lucide="sparkles" style="width: 16px;"></i>
                        OPEN RECRUITMENT
                    </span>
                    <h2 class="banner-title">We're Hiring! <span class="pulse-dot"></span></h2>
                    <p class="banner-description">
                        Bergabunglah bersama tim Asuh Bareng dan Zakat Sukses untuk menebar manfaat lebih luas.
                    </p>
                    <div class="banner-benefits">
                        <div class="benefit-item">
                            <i data-lucide="briefcase" style="width: 16px;"></i>
                            <span>Kesempatan karir</span>
                        </div>
                        <div class="benefit-item">
                            <i data-lucide="heart" style="width: 16px;"></i>
                            <span>Bermanfaat untuk sesama</span>
                        </div>
                        <div class="benefit-item">
                            <i data-lucide="trending-up" style="width: 16px;"></i>
                            <span>Pengembangan diri</span>
                        </div>
                    </div>
                </div>
                <div class="banner-right">
                    <div class="stats-mini">
                        
                    <a href="{{ route('rekrutmen.panduan') }}" class="banner-cta">
                        <span>Lihat Disini!</span>
                        <i data-lucide="arrow-right" style="width: 18px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- PROGRAM SECTION - GAMBAR LEBIH BESAR -->
    <section id="program" class="section section-light">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Program <span>Asuh Bareng</span></h2>
                <p class="section-subtitle">Tiga program unggulan dalam pendampingan anak asuh</p>
            </div>

            <div class="program-grid">
                <!-- Card 1: Pendampingan Rutin - PNG -->
                <div class="program-card">
                    <div class="program-image">
                        <img src="{{ asset('bareng.png') }}" alt="Pendampingan Rutin" style="width: 180px; height: 180px; object-fit: contain;">
                    </div>
                    <div class="program-content">
                        <h3 class="program-title">Pendampingan Rutin</h3>
                        <p class="program-desc">Kakak asuh mendampingi anak asuh dalam kegiatan belajar dan pengembangan diri secara rutin.</p>
                    </div>
                </div>

                <!-- Card 2: Monitoring Kesehatan - JPG -->
                <div class="program-card">
                    <div class="program-image">
                        <img src="{{ asset('kesehaan.jpg') }}" alt="Monitoring Kesehatan" style="width: 200px; height: 200px; object-fit: cover; border-radius: 12px;">
                    </div>
                    <div class="program-content">
                        <h3 class="program-title">Monitoring Kesehatan</h3>
                        <p class="program-desc">Pemeriksaan kesehatan rutin untuk memantau perkembangan fisik dan mental anak asuh.</p>
                    </div>
                </div>

                <!-- Card 3: Laporan Perkembangan - JPG -->
                <div class="program-card">
                    <div class="program-image">
                        <img src="{{ asset('berkembang.jpg') }}" alt="Laporan Perkembangan" style="width: 200px; height: 200px; object-fit: cover; border-radius: 12px;">
                    </div>
                    <div class="program-content">
                        <h3 class="program-title">Laporan Perkembangan</h3>
                        <p class="program-desc">Laporan lengkap dan transparan tentang perkembangan anak asuh yang dapat diakses kapan saja.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Fitur <span>Unggulan</span></h2>
                <p class="section-subtitle">Kemudahan dalam satu platform</p>
            </div>

            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon pink">
                        <i data-lucide="calendar-check"></i>
                    </div>
                    <h3 class="feature-title">Pencatatan Absensi</h3>
                    <p class="feature-desc">Rekam setiap kegiatan pendampingan dengan mudah</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon green">
                        <i data-lucide="heart-pulse"></i>
                    </div>
                    <h3 class="feature-title">Cek Kesehatan</h3>
                    <p class="feature-desc">Pantau perkembangan fisik dan mental anak</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon pink">
                        <i data-lucide="file-text"></i>
                    </div>
                    <h3 class="feature-title">Laporan PDF</h3>
                    <p class="feature-desc">Akses data mudah dan transparan</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon green">
                        <i data-lucide="trending-up"></i>
                    </div>
                    <h3 class="feature-title">Grafik Perkembangan</h3>
                    <p class="feature-desc">Visualisasi data perkembangan anak</p>
                </div>
            </div>
        </div>
    </section>

    @php
        $galeriPhotos = \App\Models\GaleriAsuh::where('IsActive', true)->latest()->take(8)->get();
    @endphp

    @if($galeriPhotos->isNotEmpty())
    <!-- Galeri Asuh Section -->
    <section id="galeri" class="galeri-section bg-gray-50">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Galeri <span>Kegiatan</span></h2>
                <p class="section-subtitle">Potret momen bahagia anak asuh dan kakak asuh dalam berbagai kegiatan</p>
            </div>

            <div class="galeri-grid">
                @foreach($galeriPhotos as $photo)
                <div class="galeri-item">
                    <img class="galeri-img" src="{{ Storage::url($photo->FotoPath) }}" alt="{{ $photo->Caption ?? 'Galeri Kegiatan' }}" loading="lazy">
                    @if($photo->Caption)
                    <div class="galeri-overlay">
                        <p class="galeri-caption">{{ $photo->Caption }}</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="section section-light">
        <div class="container">
            <div class="about-grid">
                <div>
                    <h2 class="section-title" style="text-align: left; margin-bottom: 16px;">Tentang <span>Kami</span></h2>
                    
                    <p class="about-text">
                        Asuh Bareng adalah platform kolaborasi kebaikan yang menghubungkan kakak asuh dengan anak-anak asuh.
                    </p>

                    <ul class="about-list">
                        <li class="about-item">
                            <div class="about-check">
                                <i data-lucide="check"></i>
                            </div>
                            <span>Terintegrasi dengan Zakat Sukses</span>
                        </li>
                        <li class="about-item">
                            <div class="about-check green">
                                <i data-lucide="check"></i>
                            </div>
                            <span>Real-time monitoring perkembangan</span>
                        </li>
                        <li class="about-item">
                            <div class="about-check">
                                <i data-lucide="check"></i>
                            </div>
                            <span>Laporan berkala transparan</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <div class="stats-card">
                        <div class="stats-grid">
                            <div class="stat-item-center">
                                <div class="stat-value-lg pink">2018</div>
                                <div class="stat-label-sm">Tahun Berdiri</div>
                            </div>
                            <div class="stat-item-center">
                                <div class="stat-value-lg green">7</div>
                                <div class="stat-label-sm">Kota</div>
                            </div>
                            <div class="stat-item-center">
                                <div class="stat-value-lg pink">500+</div>
                                <div class="stat-label-sm">Anak Asuh</div>
                            </div>
                            <div class="stat-item-center">
                                <div class="stat-value-lg green">50+</div>
                                <div class="stat-label-sm">Relawan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Kata <span>Mereka</span></h2>
                <p class="section-subtitle">Pengalaman pengguna platform Asuh Bareng</p>
            </div>

            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="avatar-circle">A</div>
                        <div class="avatar-info">
                            <h4>Ahmad Fauzi</h4>
                            <p>Kakak Asuh</p>
                        </div>
                    </div>
                    <p class="testimonial-quote">"Platform ini sangat membantu dalam memantau perkembangan anak asuh."</p>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="avatar-circle">S</div>
                        <div class="avatar-info">
                            <h4>Siti Nurhaliza</h4>
                            <p>Kakak Asuh</p>
                        </div>
                    </div>
                    <p class="testimonial-quote">"Bisa melihat progres anak asuh secara real-time dan mudah."</p>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="avatar-circle">Z</div>
                        <div class="avatar-info">
                            <h4>Zakat Sukses</h4>
                            <p>Mitra</p>
                        </div>
                    </div>
                    <p class="testimonial-quote">"Memudahkan monitoring program pendampingan di berbagai daerah."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">Siap Menjadi Bagian dari Kebaikan?</h2>
            <p class="cta-text">Bergabunglah dalam mendukung masa depan anak-anak Indonesia.</p>

            <div class="cta-buttons">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-primary">Buka Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="btn-primary">Daftar Menjadi Kakak Asuh</a>
                @endauth
                
                <a href="#program" class="btn-secondary">Pelajari Program</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-logo">
                        <img src="{{ asset('bareng.png') }}" alt="Asuh Bareng">
                        <span>Asuh Bareng</span>
                    </div>
                    <p class="footer-text">
                        Platform kolaborasi kebaikan untuk masa depan anak asuh yang lebih cerah.
                    </p>
                </div>

                <div>
                    <h4 class="footer-title">Tautan</h4>
                    <ul class="footer-links">
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#program">Program</a></li>
                        <li><a href="#fitur">Fitur</a></li>
                        <li><a href="#tentang">Tentang</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-title">Kolaborasi</h4>
                    <div class="partner-card">
                        <img src="{{ asset('zakatsukses.png') }}" alt="Zakat Sukses">
                        <span>Zakat Sukses</span>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© {{ date('Y') }} Asuh Bareng</p>
                <p>v{{ Illuminate\Foundation\Application::VERSION }}</p>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>