<x-app-layout>
    <x-slot name="header">
        Kebiasaan Baik Anak Asuh
    </x-slot>

    <div class="mb-6 bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Ceklis Kebiasaan Baik</h2>
                <p class="text-sm text-gray-500">Pilih Anak Asuh dan bulan untuk merekam total capaian kebiasaan baik.</p>
            </div>

            <!-- Month / Year Filter -->
            <form action="{{ route('kebiasaan_baik.index') }}" method="GET" class="flex items-center gap-2">
                <select name="month" class="rounded-lg border-gray-300 text-sm focus:ring-pink-500 focus:border-pink-500">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ $m == $selectedMonth ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
                <select name="year" class="rounded-lg border-gray-300 text-sm focus:ring-pink-500 focus:border-pink-500">
                    @php $currentYear = date('Y'); @endphp
                    @foreach(range($currentYear - 2, $currentYear + 1) as $y)
                        <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
                <button type="submit" class="px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                    Tampilkan
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-xl border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-gray-700 font-semibold border-b border-gray-200">
                    <tr>
                        <th class="p-4">Nama Anak Asuh</th>
                        <th class="p-4">Bulan</th>
                        <th class="p-4 text-center">Status Isian</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($anakAsuhs as $anak)
                        @php
                            $recordExists = isset($kebiasaanRecords[$anak->id]);
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-medium text-gray-900">{{ $anak->NamaLengkap }}</td>
                            <td class="p-4">{{ \Carbon\Carbon::create()->month($selectedMonth)->translatedFormat('F') }} {{ $selectedYear }}</td>
                            <td class="p-4 text-center">
                                @if($recordExists)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Sudah Diisi
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Belum Diisi
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                <a href="{{ route('kebiasaan_baik.form', ['id' => $anak->id, 'month' => $selectedMonth, 'year' => $selectedYear]) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 rounded-lg text-xs font-semibold transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Isi / Edit Data
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-gray-500">
                                Tidak ada anak asuh yang dutugaskan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
