<!-- Mobile Sidebar Backdrop -->
<div x-show="sidebarOpen" style="display: none;" class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity md:hidden" @click="sidebarOpen = false" x-transition.opacity></div>

<!-- Sidebar -->
<div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
     class="fixed inset-y-0 left-0 z-30 w-60 bg-white border-r border-gray-200 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 flex flex-col min-h-screen"
     style="font-family: 'Nunito', sans-serif;">
    {{-- Logo --}}
    <div class="h-16 flex items-center justify-center px-4 border-b border-gray-100">
        <img src="{{ asset('bareng.png') }}" alt="Asuh Bareng Logo" class="h-10 w-auto flex-shrink-0">
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 py-4">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('dashboard') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>

        @if(Auth::check() && in_array(Auth::user()->role, ['admin', 'superadmin']))
        {{-- Admin Section --}}
        <p class="mt-5 mb-2 px-3 text-[10px] font-bold tracking-widest uppercase text-gray-400">Admin</p>

        <a href="{{ route('users.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('users.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            Persetujuan Relawan
        </a>

        <a href="{{ route('anak_asuh.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('anak_asuh.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Anak Asuh
        </a>

        <a href="{{ route('kakak_asuh.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('kakak_asuh.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Kakak Asuh
        </a>

        <a href="{{ route('penugasan_asuh.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('penugasan_asuh.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            Penugasan Asuh
        </a>

        <a href="{{ route('cek_kesehatan.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('cek_kesehatan.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            Cek Kesehatan
        </a>

        <a href="{{ route('donatur.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('donatur.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Data Donatur
        </a>

        <a href="{{ route('penyaluran.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('penyaluran.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Penyaluran Dana
        </a>

        {{-- Mentoring Section --}}
        <p class="mt-5 mb-2 px-3 text-[10px] font-bold tracking-widest uppercase text-gray-400">Mentoring</p>

        <a href="{{ route('absensi_pendampingan.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('absensi_pendampingan.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Absensi Pendampingan
        </a>

        <a href="{{ route('kebiasaan_baik.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('kebiasaan_baik.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
            Kebiasaan Baik
        </a>

        <a href="{{ route('rapor_asuh.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('rapor_asuh.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            Rapor Asuh
        </a>

        {{-- Rekrutmen Section --}}
        <p class="mt-5 mb-2 px-3 text-[10px] font-bold tracking-widest uppercase text-gray-400">Rekrutmen Internal</p>
        
        <a href="{{ route('admin.rekrutmen.pendaftar.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('admin.rekrutmen.pendaftar.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            Data Pelamar
        </a>

        <a href="{{ route('admin.rekrutmen.posisi.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('admin.rekrutmen.posisi.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Posisi Dibutuhkan
        </a>

        <a href="{{ route('admin.rekrutmen.pengaturan') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('admin.rekrutmen.pengaturan') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                 <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Panduan Rekrutmen
        </a>

        <a href="{{ route('rencana-program.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('rencana-program.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
            Validasi Program
        </a>
        @endif

        <!-- Komunikasi -->
        <p class="mt-5 mb-2 px-3 text-[10px] font-bold tracking-widest uppercase text-gray-400">Komunikasi</p>

        <a href="{{ route('chat.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('chat.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <div class="relative">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                </svg>
                <!-- Unread Badge Placeholder -->
                <span id="sidebar-unread-badge" class="hidden absolute -top-1 -right-1 flex h-3 w-3 items-center justify-center rounded-full bg-red-500 text-[9px] font-bold text-white ring-2 ring-white"></span>
            </div>
            Ruang Obrolan
        </a>

        <!-- General Menu (Kakak Asuh) -->
        @if(Auth::user()->role === 'kakak_asuh')
        <a href="{{ route('galeri.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('galeri.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Galeri Asuh
        </a>

        <p class="mt-5 mb-2 px-3 text-[10px] font-bold tracking-widest uppercase text-gray-400">Mentoring</p>

        <a href="{{ route('absensi_pendampingan.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('absensi_pendampingan.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Absensi Pendampingan
        </a>

        <a href="{{ route('kebiasaan_baik.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('kebiasaan_baik.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
            Kebiasaan Baik
        </a>

        <a href="{{ route('rapor_asuh.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('rapor_asuh.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            Rapor Asuh
        </a>

        <a href="{{ route('rencana-program.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('rencana-program.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 3v8m4-8v8M10 3h4a1 1 0 011 1v1H9V4a1 1 0 011-1z"></path>
            </svg>
            Program & Logbook
        </a>
        @endif

        <div class="my-4 border-t border-gray-100"></div>

        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin')
        <!-- Section: Pengaturan Website -->
        <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4 flex justify-between items-center group cursor-pointer">
            Pengaturan Website
        </h3>
        <a href="{{ route('admin.galeri.index') }}"
           class="flex items-center gap-3 px-3 py-2 mb-1 rounded-lg text-sm font-semibold transition-colors duration-150
                  {{ request()->routeIs('admin.galeri.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Galeri Asuh
        </a>
        @endif

      
    </nav>

    {{-- Footer --}}
    <div class="px-5 py-4 border-t border-gray-100">
        <p class="text-[11px] text-gray-400">AsuhBareng &copy; {{ date('Y') }}</p>
    </div>

</div>

<!-- Unread Chat Badge Script -->
@auth
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const badge = document.getElementById('sidebar-unread-badge');
        
        async function fetchUnreadCount() {
            try {
                const response = await fetch('{{ route("chat.unread") }}');
                const data = await response.json();
                
                if (data.total > 0) {
                    badge.classList.remove('hidden');
                    // show number if < 100, else 99+
                    badge.innerText = data.total > 99 ? '99+' : data.total;
                    
                    // Slightly adjust padding based on digits
                    if(data.total > 9) {
                        badge.classList.remove('w-3', 'h-3');
                        badge.classList.add('px-1', 'py-0.5', 'min-w-[12px]', 'h-[14px]');
                    }
                } else {
                    badge.classList.add('hidden');
                }
            } catch (e) {
                console.error('Error fetching unread count:', e);
            }
        }

        // Fetch immediately
        fetchUnreadCount();
        
        // Polling every 10 seconds
        setInterval(fetchUnreadCount, 10000);
    });
</script>
@endauth
