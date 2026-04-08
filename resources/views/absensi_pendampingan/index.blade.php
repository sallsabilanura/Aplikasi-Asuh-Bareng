<x-app-layout>
    <x-slot name="header">
        Daftar Absensi Pendampingan
    </x-slot>

    <x-index-header 
        title="Riwayat Absensi Pendampingan" 
        subtitle="Pantau daftar riwayat absensi dan perkembangan pelaksanaan aktivitas pendampingan." 
    />

    <!-- Filter Form & Actions -->
    <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border border-gray-200 mb-6 border-l-4 border-l-pink-500 flex flex-col xl:flex-row justify-between items-start xl:items-end gap-6 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)]">
        
        <form action="{{ route('absensi_pendampingan.index') }}" method="GET" class="w-full xl:flex-1">
            <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-end w-full">
                <!-- Text Search -->
                <div class="w-full lg:flex-1 lg:max-w-xs">
                    <label for="search" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Cari Anak Asuh</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nama anak..." class="pl-9 w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm py-2">
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 w-full lg:w-auto">
                    <!-- Admin Mentor Filter -->
                    @if(Auth::user()->role === 'admin')
                    <div class="flex-1 min-w-[110px]">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Kakak</label>
                        <select name="kakak_asuh_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2">
                            <option value="">Semua</option>
                            @foreach($kakakAsuhs as $kakak)
                                <option value="{{ $kakak->KakakAsuhID }}" {{ request('kakak_asuh_id') == $kakak->KakakAsuhID ? 'selected' : '' }}>
                                    {{ $kakak->NamaLengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    
                    <!-- Month Filter -->
                    <div class="flex-1 min-w-[90px]">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Bulan</label>
                        <select name="bulan" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2">
                            <option value="">Bulan</option>
                            @foreach(range(1, 12) as $m)
                                <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('M') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Year Filter -->
                    <div class="flex-1 min-w-[90px]">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Tahun</label>
                        <select name="tahun" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2">
                            <option value="">Tahun</option>
                            @foreach(range(date('Y') - 2, date('Y') + 2) as $y)
                                <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Action Buttons: Filter, Reset, Add, PDF -->
                <div class="flex flex-wrap lg:flex-nowrap gap-2 w-full lg:w-auto lg:border-l lg:border-gray-200 lg:pl-4">
                    <div class="flex gap-2 flex-1 lg:flex-none">
                        <button type="submit" class="flex-1 lg:flex-none bg-pink-100 hover:bg-pink-200 text-pink-700 font-bold py-2 px-3 rounded-lg shadow-sm transition-all duration-200 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        </button>
                        @if(request()->anyFilled(['search', 'kakak_asuh_id', 'bulan', 'tahun']))
                        <a href="{{ route('absensi_pendampingan.index') }}" class="flex-1 lg:flex-none bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-2 px-3 rounded-lg transition-all duration-200 flex items-center justify-center">
                            Reset
                        </a>
                        @endif
                    </div>
                    
                    <div class="flex gap-2 flex-1 lg:flex-none lg:ml-2">
                        @if(Auth::user()->role !== 'admin')
                        <a href="{{ route('absensi_pendampingan.create') }}" class="flex-1 lg:flex-none bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-all duration-200 flex items-center justify-center">
                            <i data-lucide="plus" class="w-4 h-4 mr-1.5"></i> Tambah
                        </a>
                        @endif
                        <a href="{{ route('absensi_pendampingan.export_pdf', request()->query()) }}" class="flex-shrink-0 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-3 rounded-lg shadow-sm transition-all duration-200 flex items-center justify-center">
                            <i data-lucide="printer" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anak Asuh</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kakak Asuh</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($absensis as $index => $absensi)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $absensis->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $absensi->anakAsuh->NamaLengkap ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $absensi->kakakAsuh->NamaLengkap ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $absensi->JenisPendampingan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $absensi->Tanggal }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $absensi->WaktuMulai }} - {{ $absensi->WaktuSelesai }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $absensi->NilaiPendampingan }} ({{ $absensi->NilaiHuruf }})</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('absensi_pendampingan.show', $absensi->AbsensiID) }}" class="text-pink-600 hover:text-pink-900 mr-3">Detail</a>
                                <a href="{{ route('absensi_pendampingan.export_pdf', ['anak_asuh_id' => $absensi->AnakAsuhID]) }}" class="text-red-600 hover:text-red-900 mr-3">Cetak</a>
                                <a href="{{ route('absensi_pendampingan.edit', $absensi->AbsensiID) }}" class="text-pink-600 hover:text-pink-900 mr-3">Edit</a>
                                <form action="{{ route('absensi_pendampingan.destroy', $absensi->AbsensiID) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $absensis->links() }}
        </div>
    </div>
</x-app-layout>
