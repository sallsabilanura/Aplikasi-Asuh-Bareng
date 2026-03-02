<x-app-layout>
    <x-slot name="header">
        Daftar Kakak Asuh
    </x-slot>

    <x-index-header 
        title="Data Kakak Asuh" 
        subtitle="Kelola daftar informasi profil, kontak, dan status keaktifan mentor/Kakak Asuh." 
    />

    <!-- Compact Action & Filter Bar -->
    <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border border-gray-200 mb-6 border-l-4 border-l-pink-500 flex flex-col xl:flex-row justify-between items-start xl:items-end gap-4 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)]">
        
        <form action="{{ route('kakak_asuh.index') }}" method="GET" class="w-full">
            <div class="flex flex-wrap gap-3 items-end w-full">
                <div class="flex-1 min-w-[200px] max-w-md">
                    <label for="search" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Cari Nama</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Ketik nama kakak asuh..." class="pl-9 w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm py-2">
                    </div>
                </div>
                
                <div class="flex gap-2">
                    <button type="submit" class="bg-pink-100 hover:bg-pink-200 text-pink-700 font-bold py-2 px-4 rounded-lg shadow-sm transition-all duration-200 flex items-center justify-center" title="Cari Data">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Cari
                    </button>
                    @if(request()->filled('search'))
                    <a href="{{ route('kakak_asuh.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-2 px-4 rounded-lg transition-all duration-200 flex items-center justify-center" title="Reset Pencarian">
                        Reset
                    </a>
                    @endif
                </div>

                <!-- Action Buttons: Add -->
                <div class="flex gap-2 ml-auto lg:border-l lg:border-gray-200 lg:pl-3 w-full lg:w-auto mt-3 lg:mt-0">
                    <a href="{{ route('kakak_asuh.create') }}" class="flex-1 lg:flex-none bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-all duration-200 flex items-center justify-center hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah
                    </a>
                </div>
            </div>
        </form>
    </div>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No HP</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($kakakAsuhs as $index => $kakak)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kakakAsuhs->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($kakak->Foto)
                                    <img src="{{ asset('storage/' . $kakak->Foto) }}" class="h-10 w-10 rounded-full object-cover">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-xs text-gray-500">N/A</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $kakak->NamaLengkap }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kakak->NomorHP }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kakak->Email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $kakak->StatusAktif == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $kakak->StatusAktif }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('kakak_asuh.edit', $kakak->KakakAsuhID) }}" class="text-pink-600 hover:text-pink-900 mr-3">Edit</a>
                                <form action="{{ route('kakak_asuh.destroy', $kakak->KakakAsuhID) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus mentor ini beserta akunnya?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $kakakAsuhs->links() }}
        </div>
    </div>
</x-app-layout>
