<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil - Asuh Bareng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('bareng.png') }}" type="image/png">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8 font-sans">
    
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl text-center border top-0 border-t-8 border-t-pink-500">
        <div>
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6 shadow-sm">
                <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h2 class="mt-2 text-3xl font-extrabold text-gray-900 tracking-tight">Pendaftaran Berhasil!</h2>
            <p class="mt-4 text-base text-gray-500 leading-relaxed">
                Terima kasih telah mendaftar di <strong>Asuh Bareng</strong>. Data Anda telah kami terima dan akan segera kami proses.
            </p>
            <p class="mt-2 text-sm text-gray-400">
                Kami akan menghubungi Anda melalui WhatsApp jika lolos ke tahap selanjutnya.
            </p>
        </div>
        
        <div class="pt-6">
            <a href="/" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-colors shadow-md">
                Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>
