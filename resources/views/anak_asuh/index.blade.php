<x-app-layout>
    <x-slot name="header">
        Daftar Anak Asuh
    </x-slot>

    <x-index-header 
        title="Data Anak Asuh" 
        subtitle="Kelola daftar informasi profil dan status keaktifan seluruh anak asuh." 
    />

    <!-- Compact Action & Filter Bar -->
    <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border border-gray-200 mb-6 border-l-4 border-l-pink-500 flex flex-col xl:flex-row justify-between items-start xl:items-end gap-4 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)]" x-data="{ showImportModal: false }">
        
        <form action="{{ route('anak_asuh.index') }}" method="GET" class="w-full">
            <div class="flex flex-wrap gap-3 items-end w-full">
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Cari Nama</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Ketik nama anak..." class="pl-9 w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm py-2">
                    </div>
                </div>
                <div class="w-24 min-w-[90px]">
                    <label for="umur" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Umur</label>
                    <input type="number" name="umur" id="umur" value="{{ request('umur') }}" placeholder="Tahun" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm py-2">
                </div>
                
                <div class="flex gap-2">
                    <button type="submit" class="bg-pink-100 hover:bg-pink-200 text-pink-700 font-bold py-2 px-4 rounded-lg shadow-sm transition-all duration-200 flex items-center justify-center" title="Cari Data">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Cari
                    </button>
                    @if(request()->anyFilled(['search', 'umur']))
                    <a href="{{ route('anak_asuh.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-2 px-4 rounded-lg transition-all duration-200 flex items-center justify-center" title="Reset Pencarian">
                        Reset
                    </a>
                    @endif
                </div>

                <!-- Action Buttons: Add + Import Excel Icon -->
                <div class="flex gap-2 ml-auto lg:border-l lg:border-gray-200 lg:pl-3 w-full lg:w-auto mt-3 lg:mt-0">
                    <a href="{{ route('anak_asuh.create') }}" class="flex-1 lg:flex-none bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-all duration-200 flex items-center justify-center hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah
                    </a>
                    <button type="button" @click="showImportModal = true" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-3 rounded-lg shadow-sm transition-all duration-200 flex items-center justify-center hover:-translate-y-0.5" title="Import Data Excel">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </button>
                </div>
            </div>
        </form>

        <!-- Import Modal -->
        <div x-show="showImportModal" 
             class="fixed inset-0 z-[100] overflow-y-auto" 
             style="display: none;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showImportModal = false"></div>

                <div class="bg-white rounded-xl overflow-hidden shadow-2xl transform transition-all sm:max-w-lg sm:w-full z-10 border border-gray-100">
                    <form action="{{ route('anak_asuh.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                            <h3 class="text-lg font-bold text-gray-900">Import Data Anak Asuh</h3>
                            <button type="button" @click="showImportModal = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        <div class="p-6">
                            <div class="mb-5">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Pilih File Excel</label>
                                <input type="file" name="file_excel" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 border border-gray-200 rounded-lg p-2 transition-all cursor-pointer">
                                <p class="mt-2 text-xs text-gray-500 font-medium">Format: .xlsx, .xls, .csv</p>
                            </div>
                            <div class="bg-pink-50 p-4 rounded-lg border border-pink-100/60 flex items-center justify-between">
                                <p class="text-sm text-pink-800 font-medium">Belum memiliki format yang tepat?</p>
                                <a href="{{ route('anak_asuh.template') }}" class="text-sm font-bold text-pink-600 hover:text-pink-800 transition-colors flex items-center">
                                    Unduh Template
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </a>
                            </div>
                        </div>
                        <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3 border-t border-gray-100">
                            <button type="button" @click="showImportModal = false" class="bg-white border border-gray-300 text-gray-700 font-bold px-5 py-2.5 rounded-lg hover:bg-gray-50 transition shadow-sm">Batal</button>
                            <button type="submit" class="bg-pink-600 text-white font-bold px-5 py-2.5 rounded-lg hover:bg-pink-700 transition shadow-sm">Mulai Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
            <span class="block sm:inline font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
            <span class="block sm:inline font-medium">{{ session('error') }}</span>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tempat, Tgl Lahir</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Umur</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sekolah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($anakAsuhs as $index => $anak)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $anakAsuhs->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($anak->FotoAnak)
                                    <img src="{{ asset('storage/' . $anak->FotoAnak) }}" class="h-10 w-10 rounded-full object-cover border border-gray-200">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-xs text-gray-500 italic">N/A</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="block text-sm font-semibold text-gray-900">{{ $anak->NamaLengkap }}</span>
                                <span class="block text-xs text-gray-500 mt-1">
                                    <span class="font-medium text-gray-700">Ortu:</span> {{ $anak->NamaOrangTua ?? '-' }} <br>
                                    <span class="font-medium text-gray-700">Telp:</span> {{ $anak->NomorTelp ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $anak->TempatLahir }}, {{ $anak->TanggalLahir }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $anak->umur }} Thn</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $anak->JenisKelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="block font-medium">{{ $anak->Sekolah }}</span>
                                <span class="text-xs text-gray-500">Kelas {{ $anak->Kelas }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $anak->Status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $anak->Status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('anak_asuh.edit', $anak->id) }}" class="text-pink-600 hover:text-pink-900 mr-3 transition duration-150">Edit</a>
                                <form action="{{ route('anak_asuh.destroy', $anak->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition duration-150" onclick="return confirm('Yakin ingin menghapus data anak asuh ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $anakAsuhs->links() }}
        </div>
    </div>
</x-app-layout>
