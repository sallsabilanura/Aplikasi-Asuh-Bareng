<!-- Mobile Sidebar Backdrop -->
<div x-show="sidebarOpen" style="display: none;" class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity md:hidden" @click="sidebarOpen = false" x-transition.opacity></div>

<!-- Sidebar -->
<div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
     class="fixed inset-y-0 left-0 z-30 w-72 bg-white border-r border-gray-200 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 flex flex-col min-h-screen"
     style="font-family: 'Nunito', sans-serif;">
    
    {{-- Logo --}}
    <div class="h-16 flex items-center justify-center px-4 border-b border-gray-100">
        <img src="{{ asset('bareng.png') }}" alt="Asuh Bareng Logo" class="h-10 w-auto flex-shrink-0">
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 py-4 overflow-y-auto custom-scrollbar" x-data="{ 
        activeDropdown: '{{ 
            request()->routeIs(['users.*', 'anak_asuh.*', 'kakak_asuh.*', 'donatur.*']) ? 'master' : 
            (request()->routeIs(['penugasan_asuh.*', 'cek_kesehatan.*', 'penyaluran.*']) ? 'ops' : 
            (request()->routeIs(['absensi_pendampingan.*', 'kebiasaan_baik.*', 'rapor_asuh.*', 'rencana-program.*']) ? 'mentoring' : 
            (request()->routeIs(['admin.rekrutmen.*']) ? 'rekrutmen' : 
            (request()->routeIs(['admin.donations.*', 'admin.galeri.*', 'admin.security.*']) ? 'pengaturan' : '')))) 
        }}',
        toggle(name) {
            this.activeDropdown = this.activeDropdown === name ? null : name;
        }
    }">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3 py-2.5 mb-2 rounded-xl text-sm font-bold transition-all duration-200
                  {{ request()->routeIs('dashboard') ? 'text-pink-600 bg-pink-50 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
            Dashboard
        </a>

        {{-- ROLE: ADMIN / SUPERADMIN --}}
        @if(Auth::check() && in_array(Auth::user()->role, ['admin', 'superadmin']))
            
            {{-- Group: Manajemen Data --}}
            <div class="mb-2">
                <button @click="toggle('master')" 
                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-bold transition-all duration-200
                               {{ request()->routeIs(['users.*', 'anak_asuh.*', 'kakak_asuh.*', 'donatur.*']) ? 'text-green-600' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-50' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="database" class="w-4 h-4"></i>
                        <span>Manajemen Data</span>
                    </div>
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 transition-transform duration-200" :class="activeDropdown === 'master' ? 'rotate-90' : ''"></i>
                </button>
                <div x-show="activeDropdown === 'master'" x-collapse x-cloak class="mt-1 space-y-1 ml-4 border-l-2 border-gray-50 pl-2">
                    <a href="{{ route('users.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('users.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Persetujuan Relawan</a>
                    <a href="{{ route('anak_asuh.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('anak_asuh.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Data Anak Asuh</a>
                    <a href="{{ route('kakak_asuh.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('kakak_asuh.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Data Kakak Asuh</a>
                    <a href="{{ route('donatur.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('donatur.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Data Donatur</a>
                </div>
            </div>

            {{-- Group: Aktivitas Lapangan --}}
            <div class="mb-2">
                <button @click="toggle('ops')" 
                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-bold transition-all duration-200
                               {{ request()->routeIs(['penugasan_asuh.*', 'cek_kesehatan.*', 'penyaluran.*']) ? 'text-green-600' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-50' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="activity" class="w-4 h-4"></i>
                        <span>Aktivitas & Keuangan</span>
                    </div>
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 transition-transform duration-200" :class="activeDropdown === 'ops' ? 'rotate-90' : ''"></i>
                </button>
                <div x-show="activeDropdown === 'ops'" x-collapse x-cloak class="mt-1 space-y-1 ml-4 border-l-2 border-gray-50 pl-2">
                    <a href="{{ route('penugasan_asuh.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('penugasan_asuh.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Penugasan Asuh</a>
                    <a href="{{ route('cek_kesehatan.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('cek_kesehatan.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Cek Kesehatan</a>
                    <a href="{{ route('penyaluran.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('penyaluran.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Penyaluran Dana</a>
                </div>
            </div>

            {{-- Group: Mentoring --}}
            <div class="mb-2">
                <button @click="toggle('mentoring')" 
                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-bold transition-all duration-200
                               {{ request()->routeIs(['absensi_pendampingan.*', 'kebiasaan_baik.*', 'rapor_asuh.*', 'rencana-program.*']) ? 'text-pink-600' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-50' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="award" class="w-4 h-4"></i>
                        <span>Sistem Mentoring</span>
                    </div>
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 transition-transform duration-200" :class="activeDropdown === 'mentoring' ? 'rotate-90' : ''"></i>
                </button>
                <div x-show="activeDropdown === 'mentoring'" x-collapse x-cloak class="mt-1 space-y-1 ml-4 border-l-2 border-gray-50 pl-2">
                    <a href="{{ route('absensi_pendampingan.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('absensi_pendampingan.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Absensi</a>
                    <a href="{{ route('kebiasaan_baik.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('kebiasaan_baik.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Kebiasaan Baik</a>
                    <a href="{{ route('rapor_asuh.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('rapor_asuh.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Rapor Asuh</a>
                    <a href="{{ route('rencana-program.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('rencana-program.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Validasi Program</a>
                </div>
            </div>

            {{-- Group: Rekrutmen --}}
            <div class="mb-2">
                <button @click="toggle('rekrutmen')" 
                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-bold transition-all duration-200
                               {{ request()->routeIs(['admin.rekrutmen.*']) ? 'text-green-600' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-50' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        <span>Rekrutmen</span>
                    </div>
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 transition-transform duration-200" :class="activeDropdown === 'rekrutmen' ? 'rotate-90' : ''"></i>
                </button>
                <div x-show="activeDropdown === 'rekrutmen'" x-collapse x-cloak class="mt-1 space-y-1 ml-4 border-l-2 border-gray-50 pl-2">
                    <a href="{{ route('admin.rekrutmen.pendaftar.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('admin.rekrutmen.pendaftar.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Data Pelamar</a>
                    <a href="{{ route('admin.rekrutmen.posisi.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('admin.rekrutmen.posisi.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Posisi Lowongan</a>
                    <a href="{{ route('admin.rekrutmen.pengaturan') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('admin.rekrutmen.pengaturan') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Panduan</a>
                </div>
            </div>

            {{-- Group: Konfigurasi --}}
            <div class="mt-6 mb-2">
                <p class="px-3 text-[10px] font-bold tracking-widest uppercase text-gray-400 mb-2">Situs & Donasi</p>
                <button @click="toggle('pengaturan')" 
                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-bold transition-all duration-200
                               {{ request()->routeIs(['admin.donations.*', 'admin.galeri.*']) ? 'text-green-600' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-50' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="settings" class="w-4 h-4"></i>
                        <span>Konfigurasi Web</span>
                    </div>
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 transition-transform duration-200" :class="activeDropdown === 'pengaturan' ? 'rotate-90' : ''"></i>
                </button>
                <div x-show="activeDropdown === 'pengaturan'" x-collapse x-cloak class="mt-1 space-y-1 ml-4 border-l-2 border-gray-50 pl-2">
                    <a href="{{ route('admin.donations.index') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('admin.donations.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                        <span>Donasi Masuk</span>
                        @php $pendingDonations = \App\Models\Donation::where('status', 'pending')->count(); @endphp
                        @if($pendingDonations > 0)
                            <span class="bg-green-500 text-white text-[9px] px-1.5 py-0.5 rounded-full">{{ $pendingDonations }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.galeri.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('admin.galeri.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Galeri Kegiatan</a>
                    <a href="{{ route('admin.security.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('admin.security.*') ? 'text-green-600 bg-green-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Monitoring Keamanan</a>
                </div>
            </div>

        @endif

        {{-- ROLE: KAKAK ASUH --}}
        @if(Auth::check() && Auth::user()->role === 'kakak_asuh')
            <p class="mt-6 mb-2 px-3 text-[10px] font-bold tracking-widest uppercase text-gray-400">Menu Kakak Asuh</p>
            
            <a href="{{ route('galeri.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-2 rounded-xl text-sm font-bold transition-all duration-200
                      {{ request()->routeIs('galeri.*') ? 'text-pink-600 bg-pink-50 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                <i data-lucide="image" class="w-4 h-4"></i>
                Galeri Asuh
            </a>

            {{-- Mentoring Dropdown for Kakak Asuh --}}
            <div class="mb-2">
                <button @click="toggle('mentoring')" 
                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-bold transition-all duration-200
                               {{ request()->routeIs(['absensi_pendampingan.*', 'kebiasaan_baik.*', 'rapor_asuh.*', 'rencana-program.*']) ? 'text-pink-600' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-50' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="heart" class="w-4 h-4"></i>
                        <span>Mentoring</span>
                    </div>
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 transition-transform duration-200" :class="activeDropdown === 'mentoring' ? 'rotate-90' : ''"></i>
                </button>
                <div x-show="activeDropdown === 'mentoring'" x-collapse x-cloak class="mt-1 space-y-1 ml-4 border-l-2 border-gray-50 pl-2">
                    <a href="{{ route('absensi_pendampingan.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('absensi_pendampingan.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Absensi</a>
                    <a href="{{ route('kebiasaan_baik.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('kebiasaan_baik.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Kebiasaan Baik</a>
                    <a href="{{ route('rapor_asuh.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('rapor_asuh.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Rapor Asuh</a>
                    <a href="{{ route('rencana-program.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('rencana-program.*') ? 'text-pink-600 bg-pink-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">Program & Logbook</a>
                </div>
            </div>
        @endif

        {{-- Shared Section: Komunikasi --}}
        <p class="mt-6 mb-2 px-3 text-[10px] font-bold tracking-widest uppercase text-gray-400">Komunikasi</p>
        <a href="{{ route('chat.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 mb-2 rounded-xl text-sm font-bold transition-all duration-200
                  {{ request()->routeIs('chat.*') ? 'text-pink-600 bg-pink-50 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
            <div class="relative">
                <i data-lucide="message-square" class="w-4 h-4"></i>
                <span id="sidebar-unread-badge" class="hidden absolute -top-1 -right-1 flex h-3 w-3 items-center justify-center rounded-full bg-red-500 text-[9px] font-bold text-white ring-2 ring-white"></span>
            </div>
            Ruang Obrolan
        </a>

    </nav>

    {{-- Footer --}}
    <div class="px-5 py-4 border-t border-gray-100">
        <p class="text-[11px] text-gray-400">AsuhBareng &copy; {{ date('Y') }}</p>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #f1f5f9;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #e2e8f0;
    }
</style>

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
                    badge.innerText = data.total > 99 ? '99+' : data.total;
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

        // Initial fetch
        fetchUnreadCount();
        
        // Interval for updates
        setInterval(fetchUnreadCount, 10000);
    });
</script>
@endauth
