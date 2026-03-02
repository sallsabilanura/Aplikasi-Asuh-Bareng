<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Rekrutmen - Asuh Bareng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('bareng.png') }}" type="image/png">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .prose p { margin-bottom: 1rem; color: #4b5563; line-height: 1.7; }
        .prose ul, .prose ol { margin-bottom: 1rem; margin-left: 1.5rem; color: #4b5563; }
        .prose li { margin-bottom: 0.5rem; }
        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
    </style>
</head>
<body class="text-gray-800 antialiased h-full flex flex-col min-h-screen relative">

    <nav class="glass-header sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center gap-3 group">
                    <img src="{{ asset('bareng.png') }}" alt="Logo" class="h-8 w-auto group-hover:scale-105 transition-transform">
                    <span class="font-bold text-lg text-pink-600 tracking-tight">Asuh Bareng</span>
                </a>
                <a href="/" class="text-sm font-semibold text-gray-500 hover:text-pink-600 transition-colors">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </nav>

    <main class="flex-grow py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            
            <div class="text-center mb-10">
                <span class="inline-block py-1 px-3 rounded-full bg-pink-100 text-pink-700 text-xs font-bold tracking-wide uppercase mb-3 border border-pink-200">
                    Rekrutmen Terbuka
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                    Panduan Rekrutmen Volunteer
                </h1>
                <p class="text-lg text-gray-500 max-w-2xl mx-auto">
                    Silakan baca dengan teliti panduan dan ketentuan rekrutmen di bawah ini sebelum Anda mengisi form pendaftaran.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl shadow-pink-100/50 border border-gray-100 overflow-hidden mb-10">
                <div class="h-2 bg-gradient-to-r from-pink-400 via-pink-500 to-rose-500"></div>
                
                <div class="p-8 md:p-12 prose max-w-none">
                    
                    @if($setting->Pengenalan)
                    <div class="mb-10">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 pb-2 border-b-2 border-pink-100 inline-block">1. Pengenalan</h2>
                        <div class="whitespace-pre-line text-gray-600">{{ $setting->Pengenalan }}</div>
                    </div>
                    @endif

                    @if($setting->Tujuan)
                    <div class="mb-10">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 pb-2 border-b-2 border-pink-100 inline-block">2. Tujuan</h2>
                        <div class="whitespace-pre-line text-gray-600">{{ $setting->Tujuan }}</div>
                    </div>
                    @endif

                    <div class="mb-10">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 pb-2 border-b-2 border-pink-100 inline-block">3. Posisi yang Dibutuhkan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            @foreach($posisi as $pos)
                            <div class="bg-pink-50 border border-pink-100 p-4 rounded-xl">
                                <h3 class="font-bold text-pink-700 text-lg mb-1">{{ $pos->NamaPosisi }}</h3>
                                <span class="inline-block bg-white text-pink-600 text-xs font-bold px-2 py-1 rounded shadow-sm mb-2 border border-pink-100">Dibutuhkan: {{ $pos->Kuota }}</span>
                                <p class="text-sm text-gray-600 mt-2">{{ $pos->KeteranganPeran }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    @if($setting->KetentuanUmum)
                    <div class="mb-10">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 pb-2 border-b-2 border-pink-100 inline-block">4. Ketentuan Umum</h2>
                        <div class="whitespace-pre-line text-gray-600">{{ $setting->KetentuanUmum }}</div>
                    </div>
                    @endif

                    @if($setting->SistemKafalah)
                    <div class="mb-10">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 pb-2 border-b-2 border-pink-100 inline-block">5. Sistem Kafalah / Benefit</h2>
                        <div class="whitespace-pre-line text-gray-600">{{ $setting->SistemKafalah }}</div>
                    </div>
                    @endif

                    @if($setting->Mekanisme)
                    <div class="mb-10">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 pb-2 border-b-2 border-pink-100 inline-block">6. Mekanisme</h2>
                        <div class="whitespace-pre-line text-gray-600">{{ $setting->Mekanisme }}</div>
                    </div>
                    @endif

                    @if($setting->Penutup)
                    <div class="mt-12 p-6 bg-gray-50 rounded-xl border border-gray-100 text-center">
                        <p class="italic text-gray-600 font-medium whitespace-pre-line">"{{ $setting->Penutup }}"</p>
                    </div>
                    @endif

                </div>
            </div>

            <!-- CTA Next Step -->
            <div class="text-center pb-12">
                <p class="text-gray-500 mb-6 font-medium">Sudah membaca dan memahami ketentuan di atas?</p>
                <a href="{{ route('rekrutmen.daftar') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-pink-600 border border-transparent rounded-full shadow-lg hover:bg-pink-700 hover:shadow-xl hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-600">
                    Lanjut Isi Formulir Pendaftaran
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
            </div>

        </div>
    </main>
</body>
</html>
