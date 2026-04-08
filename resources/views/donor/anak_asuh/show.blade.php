<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 sm:gap-4">
            <div>
                <nav class="flex items-center gap-2 text-[10px] sm:text-xs text-gray-400 mb-2 font-bold uppercase tracking-wider overflow-x-auto whitespace-nowrap pb-1">
                    <a href="{{ route('donor.dashboard') }}" class="hover:text-pink-600 transition-colors">Dashboard</a>
                    <i data-lucide="chevron-right" class="w-3 h-3"></i>
                    <a href="{{ route('donor.anak_asuh.index') }}" class="hover:text-pink-600 transition-colors">Anak Asuh</a>
                    <i data-lucide="chevron-right" class="w-3 h-3"></i>
                    <span class="text-gray-900 line-clamp-1">{{ $anakAsuh->NamaLengkap }}</span>
                </nav>
                <h2 class="font-extrabold text-2xl lg:text-3xl text-gray-900 leading-tight">
                    {{ __('Detail Profil') }}
                </h2>
            </div>
            <div class="flex">
                <a href="{{ route('donor.anak_asuh.index') }}" class="flex-1 sm:flex-none inline-flex items-center justify-center px-5 py-2.5 bg-white border border-gray-200 rounded-xl font-bold text-xs text-gray-600 hover:bg-gray-50 transition-all shadow-sm">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5 mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-[#fafafa]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Main Info Section -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 sm:gap-8 mb-8">
                <!-- Left: Profile Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden lg:sticky lg:top-24">
                        <div class="aspect-square sm:aspect-[3/4] relative overflow-hidden bg-gray-50">
                            @if($anakAsuh->FotoAnak)
                                <img src="{{ asset('storage/' . $anakAsuh->FotoAnak) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-pink-100">
                                    <i data-lucide="user-round" class="w-20 h-20"></i>
                                </div>
                            @endif
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                                <h3 class="text-xl font-bold text-white leading-tight mb-1">{{ $anakAsuh->NamaLengkap }}</h3>
                                <div class="flex items-center text-pink-300 text-[10px] font-bold uppercase tracking-widest">
                                   <i data-lucide="map-pin" class="w-3 h-3 mr-1.5"></i> {{ $anakAsuh->TempatLahir }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6 space-y-6">
                            <div class="space-y-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-pink-50 rounded-xl flex items-center justify-center text-pink-600">
                                        <i data-lucide="calendar" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase mb-0.5">Usia</p>
                                        <p class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($anakAsuh->TanggalLahir)->age }} Tahun</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-pink-50 rounded-xl flex items-center justify-center text-pink-600">
                                        <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase mb-0.5">Sekolah</p>
                                        <p class="text-sm font-bold text-gray-900 truncate max-w-[150px]">{{ $anakAsuh->Sekolah }}</p>
                                        <p class="text-[10px] text-pink-500 font-bold">Kelas {{ $anakAsuh->Kelas }}</p>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('donor.donasi', ['anak_asuh_id' => $anakAsuh->id]) }}" class="w-full inline-flex items-center justify-center px-6 py-4 bg-pink-600 text-white rounded-xl font-bold text-sm hover:bg-pink-700 shadow-lg shadow-pink-100 transition-all">
                                <i data-lucide="heart" class="w-4 h-4 mr-2"></i>
                                Bantu Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right: Details -->
                <div class="lg:col-span-3 space-y-8">
                    <!-- Progress Reports -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <i data-lucide="award" class="w-5 h-5 mr-3 text-pink-600"></i>
                                Rapor Perkembangan
                            </h3>
                        </div>

                        @if($rapor->isEmpty())
                            <div class="text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                                <i data-lucide="clipboard-list" class="w-10 h-10 mx-auto text-gray-200 mb-3"></i>
                                <p class="text-sm text-gray-400">Belum ada laporan.</p>
                            </div>
                        @else
                            <div class="space-y-6">
                                @foreach($rapor as $item)
                                    <div class="p-6 bg-white rounded-2xl border border-gray-100 hover:border-pink-100 transition-all">
                                        <div class="flex justify-between items-start mb-4">
                                            <div>
                                                <h4 class="text-base font-bold text-gray-900">{{ $item->Semester }} - {{ $item->TahunAjaran }}</h4>
                                                <span class="text-[10px] text-pink-500 font-bold uppercase tracking-widest">Update: {{ $item->created_at->format('M Y') }}</span>
                                            </div>
                                            <div class="flex gap-2">
                                                <span class="px-3 py-1 bg-pink-50 text-pink-700 text-[10px] font-bold rounded-lg border border-pink-100">Karakter: {{ $item->NilaiKarakter }}</span>
                                                <span class="px-3 py-1 bg-blue-50 text-blue-700 text-[10px] font-bold rounded-lg border border-blue-100">Akademik: {{ $item->NilaiAkademik }}</span>
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-600 leading-relaxed italic border-l-3 border-pink-100 pl-4">"{{ $item->KeteranganRapor }}"</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Gallery -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <i data-lucide="camera" class="w-5 h-5 mr-3 text-pink-600"></i>
                                Galeri Kegiatan
                            </h3>
                        </div>

                        @if($galeri->isEmpty())
                            <div class="text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                                <i data-lucide="image" class="w-10 h-10 mx-auto text-gray-200 mb-3"></i>
                                <p class="text-sm text-gray-400">Belum ada foto.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-4">
                                @foreach($galeri as $img)
                                    <div class="aspect-square rounded-xl overflow-hidden hover:opacity-90 transition-all group relative border border-gray-50">
                                        <img src="{{ asset('storage/' . $img->PathFoto) }}" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-pink-600/10 sm:bg-pink-600/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <i data-lucide="maximize-2" class="w-5 h-5 text-white drop-shadow-md"></i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        lucide.createIcons();
    </script>
    @endpush
</x-app-layout>

