<x-app-layout>
    <x-slot name="header">
        Isi Kebiasaan Baik: {{ $anak->NamaLengkap }}
    </x-slot>

    <div class="mb-6 bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Capaian: {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}</h2>
                <p class="text-sm text-gray-500">Masukkan total hitungan (akumulasi hari) untuk tiap elemen kebiasaan baik anak asuh selama bulan ini. Maksimal 31 hari.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('kebiasaan_baik.pdf', ['id' => $anak->id, 'month' => $month, 'year' => $year]) }}" target="_blank" class="px-4 py-2 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 rounded-lg text-sm font-semibold transition flex items-center gap-2 border border-indigo-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak PDF
                </a>
                <a href="{{ route('kebiasaan_baik.index', ['month' => $month, 'year' => $year]) }}" class="px-4 py-2 bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-lg text-sm font-semibold transition flex items-center">
                    &larr; Kembali
                </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-4 bg-red-50 text-red-700 p-4 rounded-xl border border-red-200">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kebiasaan_baik.store', ['id' => $anak->id, 'month' => $month, 'year' => $year]) }}" method="POST" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        @csrf
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Group 1: Ibadah Wajib -->
                <div class="col-span-1 md:col-span-2 bg-indigo-50/50 p-5 rounded-xl border border-indigo-100">
                    <h3 class="text-lg font-bold text-indigo-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Salat 5 Waktu
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Subuh</label>
                            <input type="number" name="SholatSubuh" value="{{ old('SholatSubuh', $kebiasaan->SholatSubuh ?? 0) }}" min="0" max="31" required class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Zuhur</label>
                            <input type="number" name="SholatZuhur" value="{{ old('SholatZuhur', $kebiasaan->SholatZuhur ?? 0) }}" min="0" max="31" required class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Ashar</label>
                            <input type="number" name="SholatAshar" value="{{ old('SholatAshar', $kebiasaan->SholatAshar ?? 0) }}" min="0" max="31" required class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Magrib</label>
                            <input type="number" name="SholatMagrib" value="{{ old('SholatMagrib', $kebiasaan->SholatMagrib ?? 0) }}" min="0" max="31" required class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Isya</label>
                            <input type="number" name="SholatIsya" value="{{ old('SholatIsya', $kebiasaan->SholatIsya ?? 0) }}" min="0" max="31" required class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                </div>

                <!-- Group 2: Aktivitas Lainnya -->
                <div class="col-span-1 md:col-span-2 bg-emerald-50/50 p-5 rounded-xl border border-emerald-100">
                    <h3 class="text-lg font-bold text-emerald-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Kegiatan Harian
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Mengaji</label>
                            <input type="number" name="Mengaji" value="{{ old('Mengaji', $kebiasaan->Mengaji ?? 0) }}" min="0" max="31" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Berangkat Sekolah</label>
                            <input type="number" name="BerangkatSekolah" value="{{ old('BerangkatSekolah', $kebiasaan->BerangkatSekolah ?? 0) }}" min="0" max="31" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Bantu Orang Tua</label>
                            <input type="number" name="BantuOrangTua" value="{{ old('BantuOrangTua', $kebiasaan->BantuOrangTua ?? 0) }}" min="0" max="31" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-pink-600 hover:bg-pink-700 text-white rounded-lg font-bold shadow-md transform hover:scale-105 transition-all">
                Simpan Rekam Jejak
            </button>
        </div>
    </form>
</x-app-layout>
