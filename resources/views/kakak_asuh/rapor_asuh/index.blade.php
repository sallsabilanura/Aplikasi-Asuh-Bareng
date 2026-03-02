<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rapor Asuh') }}
        </h2>
    </x-slot>

<div class="container mx-auto px-4 py-8 max-w-7xl">

    <!-- Header & Filter -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Rapor Asuh Anak</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola dan cetak rapor evaluasi perkembangan anak asuh per semester.</p>
        </div>

        <form action="{{ route('rapor_asuh.index') }}" method="GET" class="flex gap-2">
            <select name="semester" class="border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 text-sm" onchange="this.form.submit()">
                <option value="1" {{ $selectedSemester == 1 ? 'selected' : '' }}>Semester 1 (Jan-Jun)</option>
                <option value="2" {{ $selectedSemester == 2 ? 'selected' : '' }}>Semester 2 (Jul-Des)</option>
            </select>
            <select name="year" class="border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 text-sm" onchange="this.form.submit()">
                @for($y = date('Y') - 2; $y <= date('Y'); $y++)
                    <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-lg font-medium text-sm border border-green-200">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 bg-red-50 text-red-700 p-4 rounded-lg font-medium text-sm border border-red-200">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <ul class="divide-y divide-gray-100">
            @forelse($anakAsuhs as $anak)
                <li class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-4 hover:bg-gray-50 transition-colors gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-100 flex-shrink-0 border border-gray-200">
                            @if($anak->FotoAnak)
                                <img src="{{ asset('storage/' . $anak->FotoAnak) }}" alt="Foto {{ $anak->NamaLengkap }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-full h-full text-gray-400 p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-bold text-gray-800 text-base">{{ $anak->NamaLengkap }}</p>
                            <p class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                                @if(isset($raporRecords[$anak->id]))
                                    <span class="w-2 h-2 rounded-full bg-green-500 inline-block"></span>
                                    Rapor Ditulis
                                @else
                                    <span class="w-2 h-2 rounded-full bg-red-400 inline-block"></span>
                                    Belum Ditulis
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-2 self-end sm:self-auto">
                        <a href="{{ route('rapor_asuh.form', ['id' => $anak->id, 'semester' => $selectedSemester, 'year' => $selectedYear]) }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg text-sm font-semibold transition">
                            Tulis Rapor
                        </a>
                        <a href="{{ route('rapor_asuh.pdf', ['id' => $anak->id, 'semester' => $selectedSemester, 'year' => $selectedYear]) }}" target="_blank" class="px-4 py-2 bg-pink-50 border border-pink-200 text-pink-700 hover:bg-pink-100 rounded-lg text-sm font-semibold transition flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Cetak
                        </a>
                    </div>
                </li>
            @empty
                <li class="p-8 text-center text-gray-500 text-sm">
                    Tidak ada data anak asuh aktif yang ditampilkan.
                </li>
            @endforelse
        </ul>
    </div>

</div>
</x-app-layout>
