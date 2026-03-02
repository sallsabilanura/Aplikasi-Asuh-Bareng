<x-app-layout>
    <x-slot name="header">Overview</x-slot>

    <div class="mb-8 bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden relative">
        <div class="p-6 sm:p-10 relative z-10 flex flex-col sm:flex-row items-center justify-between">
            <div class="text-center sm:text-left mb-4 sm:mb-0 flex-1">
                <h2 class="text-2xl sm:text-4xl font-extrabold mb-3 text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-green-500">
                    Selamat Datang, {{ Auth::user()->name }}! 
                </h2>
                <p class="text-gray-600 text-sm sm:text-base">Mulai harimu dengan senyuman dan terus berikan yang terbaik.</p>
            </div>
            <div class="hidden sm:block flex-shrink-0 ml-6">
                <img src="{{ asset('asuh.png') }}" class="h-32 object-contain hover:scale-105 transition-transform duration-300">
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Anak Asuh</h3>
                <p class="text-2xl font-black text-gray-800">{{ $totalAnak }}</p>
            </div>
            <div class="p-3 bg-pink-50 text-pink-500 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
        </div>

        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin')
            <a href="{{ route('admin.rekrutmen.pendaftar.index') }}" class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-green-500 flex items-center justify-between hover:shadow-md transition-all group">
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Pelamar Baru</h3>
                    <p class="text-2xl font-black text-gray-800">{{ $pendingRekrutmen ?? 0 }}</p>
                </div>
                <div class="p-3 bg-green-50 text-green-500 rounded-lg group-hover:scale-110">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                </div>
            </a>
            <a href="{{ route('rencana-program.index', ['status' => 'Menunggu']) }}" class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-yellow-400 flex items-center justify-between hover:shadow-md transition-all group">
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Persetujuan Program</h3>
                    <p class="text-2xl font-black text-gray-800">{{ $pendingProgram ?? 0 }}</p>
                </div>
                <div class="p-3 bg-yellow-50 text-yellow-600 rounded-lg group-hover:scale-110">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
            </a>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-blue-500 flex items-center justify-between">
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Validasi Logbook</h3>
                    <p class="text-2xl font-black text-gray-800">{{ $pendingLogbook ?? 0 }}</p>
                </div>
                <div class="p-3 bg-blue-50 text-blue-500 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
            </div>
        @else
            <a href="{{ route('absensi_pendampingan.index') }}" class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-all group">
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Absensi Bulan Ini</h3>
                    <p class="text-2xl font-black text-gray-800">{{ $absensiBulanIni }}</p>
                </div>
                <div class="p-3 bg-green-50 text-green-500 rounded-lg group-hover:scale-110">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </a>
            <a href="{{ route('rencana-program.index') }}" class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-all group">
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Program Berjalan</h3>
                    <p class="text-2xl font-black text-gray-800">{{ $programAktif ?? 0 }}</p>
                </div>
                <div class="p-3 bg-blue-50 text-blue-500 rounded-lg group-hover:scale-110">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
            </a>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Logbook Terkirim</h3>
                    <p class="text-2xl font-black text-gray-800">{{ $logbookPending ?? 0 }}</p>
                </div>
                <div class="p-3 bg-yellow-50 text-yellow-600 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
            </div>
        @endif

        <div class="bg-gradient-to-br from-pink-500 to-rose-600 p-5 rounded-xl shadow-lg flex items-center justify-between text-white">
            <div>
                <h3 class="text-xs font-bold text-pink-100 uppercase tracking-wider mb-1">Keanggotaan</h3>
                <p class="text-xl font-black capitalize">{{ Auth::user()->role }}</p>
            </div>
            <div class="p-2 bg-white bg-opacity-20 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
        </div>
    </div>
</x-app-layout>
