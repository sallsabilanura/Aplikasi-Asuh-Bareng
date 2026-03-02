<x-app-layout>
    <x-slot name="header">
        Penyaluran Dana Anak Asuh
    </x-slot>

    <x-index-header 
        title="Data Penyaluran Dana" 
        subtitle="Kelola pencatatan penyaluran dana bulanan untuk seluruh Anak Asuh yang aktif." 
    />

    <!-- Compact Action & Filter Bar -->
    <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border border-gray-200 mb-6 border-l-4 border-l-pink-500 flex flex-col xl:flex-row justify-between items-start xl:items-end gap-4 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)]" x-data="{ showBulkModal: false }">
        
        <form action="{{ route('penyaluran.index') }}" method="GET" class="w-full">
            <div class="flex flex-wrap gap-3 items-end w-full">
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Cari Nama Anak Asuh</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Ketik nama anak..." class="pl-9 w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm py-2">
                    </div>
                </div>

                <div class="w-32 min-w-[120px]">
                    <label for="Bulan" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Bulan</label>
                    <select name="Bulan" id="Bulan" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm py-2">
                        <option value="">Semua Bulan</option>
                        @for($i=1; $i<=12; $i++)
                            <option value="{{ $i }}" {{ request('Bulan') == $i ? 'selected' : '' }}>
                                {{ \DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="w-24 min-w-[100px]">
                    <label for="Tahun" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Tahun</label>
                    <input type="number" name="Tahun" id="Tahun" value="{{ request('Tahun') }}" placeholder="{{ date('Y') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm py-2">
                </div>
                
                <div class="flex gap-2">
                    <button type="submit" class="bg-pink-100 hover:bg-pink-200 text-pink-700 font-bold py-2 px-4 rounded-lg shadow-sm transition-all duration-200 flex items-center justify-center" title="Filter Data">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Filter
                    </button>
                    @if(request()->anyFilled(['search', 'Bulan', 'Tahun']))
                    <a href="{{ route('penyaluran.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-2 px-4 rounded-lg transition-all duration-200 flex items-center justify-center" title="Reset Pencarian">
                        Reset
                    </a>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-2 ml-auto lg:border-l lg:border-gray-200 lg:pl-3 w-full lg:w-auto mt-3 lg:mt-0">
                    <button type="button" @click="showBulkModal = true" class="flex-1 lg:flex-none bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-all duration-200 flex items-center justify-center hover:-translate-y-0.5" title="Generate Data Bulanan Otomatis">
                        <svg class="w-4 h-4 mr-1.5 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Otomatis
                    </button>
                    @if(request()->filled('Bulan') && request()->filled('Tahun'))
                        <a href="{{ route('penyaluran.export_pdf', ['Bulan' => request('Bulan'), 'Tahun' => request('Tahun')]) }}" target="_blank" class="flex-1 lg:flex-none bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-all duration-200 flex items-center justify-center hover:-translate-y-0.5" title="Cetak Formulir Tanda Tangan untuk Periode ini">
                            <svg class="w-4 h-4 mr-1.5 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Cetak
                        </a>
                    @endif
                    <a href="{{ route('penyaluran.create') }}" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-3 rounded-lg shadow-sm transition-all duration-200 flex items-center justify-center hover:-translate-y-0.5" title="Tambah Data Manual">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </a>
                </div>
            </div>
        </form>

        <!-- Bulk Generate Modal -->
        <div x-show="showBulkModal" 
             class="fixed inset-0 z-[100] overflow-y-auto" 
             style="display: none;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showBulkModal = false"></div>

                <div class="bg-white rounded-xl overflow-hidden shadow-2xl transform transition-all sm:max-w-lg sm:w-full z-10 border border-gray-100">
                    <form action="{{ route('penyaluran.bulk') }}" method="POST">
                        @csrf
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                            <h3 class="text-lg font-bold text-gray-900">Buat Data Penyaluran Serentak</h3>
                            <button type="button" @click="showBulkModal = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        <div class="p-6">
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-5">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">Fitur ini akan otomatis membuatkan catatan penyaluran dana untuk <strong>semua Anak Asuh yang aktif</strong> di bulan yang Anda pilih.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Bulan <span class="text-red-500">*</span></label>
                                    <select name="Bulan" required class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm">
                                        @for($i=1; $i<=12; $i++)
                                            <option value="{{ $i }}" {{ date('n') == $i ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Tahun <span class="text-red-500">*</span></label>
                                    <input type="number" name="Tahun" value="{{ date('Y') }}" required class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nominal Salur (Rp) <span class="text-red-500">*</span></label>
                                <input type="number" name="NominalDef" value="350000" required class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm">
                                <p class="mt-1 text-xs text-gray-500">Nominal dasar (default Rp 350.000) yang akan diberikan ke semua anak. Jika ada anak yang berbeda bisa diedit manual nanti.</p>
                            </div>
                        </div>
                        <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3 border-t border-gray-100">
                            <button type="button" @click="showBulkModal = false" class="bg-white border border-gray-300 text-gray-700 font-bold px-5 py-2.5 rounded-lg hover:bg-gray-50 transition shadow-sm">Batal</button>
                            <button type="submit" class="bg-green-600 text-white font-bold px-5 py-2.5 rounded-lg hover:bg-green-700 transition shadow-sm">Generate Data</button>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Anak Asuh</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal Salur</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($penyalurans as $index => $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $penyalurans->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                {{ \DateTime::createFromFormat('!m', $item->Bulan)->format('F') }} {{ $item->Tahun }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $item->anakAsuh->NamaLengkap ?? 'Data Terhapus' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">
                                Rp {{ number_format($item->Nominal, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ Str::limit($item->Keterangan, 50) ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('penyaluran.edit', $item->id) }}" class="text-pink-600 hover:text-pink-900 mr-3 transition duration-150">Edit</a>
                                <form action="{{ route('penyaluran.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition duration-150" onclick="return confirm('Yakin ingin menghapus data penyaluran dana ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                                Belum ada data penyaluran dana yang tersimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $penyalurans->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>
