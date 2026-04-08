<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 sm:gap-4">
            <div>
                <nav class="flex items-center gap-2 text-[10px] sm:text-xs text-gray-400 mb-2 font-bold uppercase tracking-wider">
                    <a href="{{ route('donor.dashboard') }}" class="hover:text-pink-600 transition-colors">Dashboard</a>
                    <i data-lucide="chevron-right" class="w-3 h-3"></i>
                    <span class="text-gray-900">Anak Asuh</span>
                </nav>
                <h2 class="font-extrabold text-2xl md:text-3xl text-gray-900 leading-tight">
                    Daftar <span class="text-pink-600 font-black">Anak Asuh</span>
                </h2>
            </div>
            
            {{-- Search Bar - Compact --}}
            <div class="w-full md:w-80 relative group">
                <input type="text" placeholder="Cari nama..." 
                    class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm font-medium focus:border-pink-500 focus:ring-2 focus:ring-pink-50 transition-all shadow-sm">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-pink-500 transition-colors">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-[#fafafa]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Main Grid Frame --}}
            <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-sm border border-gray-100 min-h-[500px]">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i data-lucide="users" class="w-5 h-5 mr-2 text-pink-600"></i>
                        Pilih Anak Asuh
                    </h3>
                    <span class="text-[10px] font-black uppercase tracking-widest bg-gray-100 text-gray-500 px-3 py-1 rounded-full border border-gray-100">
                        {{ $anakAsuhs->count() }} Tersedia
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @foreach($anakAsuhs as $anak)
                        <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-pink-200 hover:shadow-xl transition-all duration-300 group flex flex-col h-full relative">
                            
                            {{-- Image Section - Compact height --}}
                            <div class="relative h-56 overflow-hidden bg-gray-50">
                                @if($anak->FotoAnak)
                                    <img src="{{ asset('storage/' . $anak->FotoAnak) }}" alt="{{ $anak->NamaLengkap }}" 
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-pink-100">
                                        <i data-lucide="user-round" class="w-16 h-16"></i>
                                    </div>
                                @endif
                                
                                {{-- Compact Labels --}}
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-pink-600/90 backdrop-blur-sm text-white rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm">
                                        Perlu Bantuan
                                    </span>
                                </div>
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-gray-800 rounded-lg text-[10px] font-black shadow-sm">
                                        {{ \Carbon\Carbon::parse($anak->TanggalLahir)->age }} THN
                                    </span>
                                </div>
                            </div>
                            
                            {{-- Content Section - Compact padding --}}
                            <div class="p-6 flex flex-col flex-1">
                                <div class="mb-5 flex-1 text-gray-900 underline-offset-4">
                                    <h3 class="text-lg font-bold group-hover:text-pink-600 transition-colors line-clamp-1 mb-2">
                                        {{ $anak->NamaLengkap }}
                                    </h3>
                                    
                                    <div class="space-y-2">
                                        <div class="flex items-center text-xs text-gray-600 font-medium">
                                            <i data-lucide="graduation-cap" class="w-4 h-4 mr-2 text-pink-500"></i>
                                            {{ $anak->Sekolah }} <span class="mx-1.5 text-gray-300">|</span> <span class="bg-pink-50 text-pink-600 px-1.5 py-0.5 rounded">Klas {{ $anak->Kelas }}</span>
                                        </div>
                                        <div class="flex items-center text-xs text-gray-400">
                                            <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-gray-300"></i>
                                            <span class="truncate">{{ $anak->Alamat }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-3">
                                    <a href="{{ route('donor.donasi', ['anak_asuh_id' => $anak->id]) }}" 
                                        class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-pink-600 text-white rounded-xl font-bold text-xs hover:bg-pink-700 shadow-md shadow-pink-100 transition-all">
                                        Bantu
                                    </a>
                                    <a href="{{ route('donor.anak_asuh.show', $anak->id) }}" 
                                        class="inline-flex items-center justify-center px-4 py-3 bg-gray-50 text-gray-600 rounded-xl font-bold text-xs hover:bg-gray-100 border border-gray-100">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($anakAsuhs->isEmpty())
                    <div class="py-24 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center mx-auto mb-4 text-gray-300">
                            <i data-lucide="inbox" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Data Kosong</h3>
                        <p class="text-sm text-gray-400">Saat ini belum ada data tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        lucide.createIcons();
    </script>
    @endpush
</x-app-layout>
