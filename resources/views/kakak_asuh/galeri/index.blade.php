<x-app-layout>
    <x-slot name="header">
        Galeri Asuh
    </x-slot>

    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Galeri Foto Kegiatan</h2>
            <p class="text-sm text-gray-500">Kumpulan potret momen bahagia dan kegiatan pendampingan Asuh Bareng.</p>
        </div>
    </div>

    <!-- Gallery Grid -->
    @if($galeri->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i data-lucide="image" class="w-8 h-8 text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-1">Galeri Masih Kosong</h3>
            <p class="text-gray-500">Belum ada foto kegiatan yang diunggah.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($galeri as $item)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden group relative flex flex-col">
                    <div class="relative aspect-[4/3] bg-gray-100 flex-shrink-0">
                        <img src="{{ Storage::url($item->FotoPath) }}" alt="Galeri" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 gap-3">
                            <a href="{{ route('galeri.download', $item->GaleriID) }}" class="flex items-center gap-2 px-4 py-2 bg-white text-gray-900 hover:bg-gray-100 rounded-lg font-semibold shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Download
                            </a>
                        </div>
                    </div>
                    
                    @if($item->Caption)
                        <div class="p-4 border-t border-gray-100 bg-white flex-1">
                            <p class="text-sm text-gray-700 line-clamp-2" title="{{ $item->Caption }}">{{ $item->Caption }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $galeri->links() }}
        </div>
    @endif
</x-app-layout>
