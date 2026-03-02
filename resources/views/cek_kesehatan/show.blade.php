<x-app-layout>
    <x-slot name="header">
        Detail Cek Kesehatan
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('cek_kesehatan.index') }}" class="text-blue-600 hover:underline flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
        <a href="{{ route('cek_kesehatan.edit', $cek) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm">
            Edit Data
        </a>
    </div>

    <div class="space-y-6">
        <!-- 1. Relasi & Umum & 2. Data Fisik Dasar -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 overflow-hidden">
                <div class="bg-blue-600 px-4 py-2">
                    <h3 class="text-white font-semibold">1. Relasi & Umum</h3>
                </div>
                <div class="p-6 space-y-3">
                    <p><span class="text-gray-500">ID Laporan:</span> <span class="font-semibold">#{{ $cek->KesehatanID }}</span></p>
                    <p><span class="text-gray-500">Anak Asuh:</span> <span class="font-semibold">{{ $cek->anakAsuh->NamaLengkap ?? 'N/A' }}</span></p>
                    <p><span class="text-gray-500">Tanggal Pemeriksaan:</span> <span class="font-semibold">{{ \Carbon\Carbon::parse($cek->TanggalPemeriksaan)->translatedFormat('d F Y') }}</span></p>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 overflow-hidden">
                <div class="bg-green-600 px-4 py-2">
                    <h3 class="text-white font-semibold">2. Data Fisik Dasar</h3>
                </div>
                <div class="p-6 grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-400 uppercase">Berat Badan</p>
                        <p class="text-xl font-bold">{{ $cek->BeratBadan }} kg</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase">Tinggi Badan</p>
                        <p class="text-xl font-bold">{{ $cek->TinggiBadan }} cm</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase">Lingkar Kepala</p>
                        <p class="text-xl font-bold">{{ $cek->LingkarKepala ?? '-' }} cm</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase">IMT</p>
                        <p class="text-xl font-bold">{{ $cek->IMT ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Pemeriksaan Kesehatan Umum -->
        <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 overflow-hidden">
            <div class="bg-yellow-600 px-4 py-2">
                <h3 class="text-white font-semibold">3. Pemeriksaan Kesehatan Umum</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-100">
                    <p class="text-xs text-yellow-600 font-bold uppercase mb-1">Status Gizi</p>
                    <p class="font-semibold capitalize text-gray-800">{{ $cek->StatusGizi }}</p>
                </div>
                <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-100">
                    <p class="text-xs text-yellow-600 font-bold uppercase mb-1">Kesehatan Mata</p>
                    <p class="font-semibold capitalize text-gray-800">{{ $cek->KesehatanMata }}</p>
                </div>
                <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-100">
                    <p class="text-xs text-yellow-600 font-bold uppercase mb-1">Kesehatan Gigi</p>
                    <p class="font-semibold capitalize text-gray-800">{{ str_replace('_', ' ', $cek->KesehatanGigi) }}</p>
                </div>
                <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-100">
                    <p class="text-xs text-yellow-600 font-bold uppercase mb-1">Pendengaran</p>
                    <p class="font-semibold capitalize text-gray-800">{{ $cek->Pendengaran }}</p>
                </div>
                <div class="md:col-span-4 border-t border-gray-100 pt-3">
                    <p class="text-xs text-gray-400 uppercase mb-1">Riwayat Penyakit</p>
                    <p class="text-gray-800">{{ $cek->RiwayatPenyakit ?? 'Tidak ada riwayat penyakit dicatat.' }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- 4. Motorik & Sensorik -->
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 overflow-hidden">
                <div class="bg-purple-600 px-4 py-2">
                    <h3 class="text-white font-semibold">4. Motorik & Sensorik</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-600">Motorik Kasar:</span>
                        <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded font-semibold capitalize">{{ str_replace('_', ' ', $cek->MotorikKasar) }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-600">Motorik Halus:</span>
                        <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded font-semibold capitalize">{{ str_replace('_', ' ', $cek->MotorikHalus) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Respons Sensorik:</span>
                        <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded font-semibold capitalize">{{ str_replace('_', ' ', $cek->ResponsSensorik) }}</span>
                    </div>
                </div>
            </div>

            <!-- 5. Perkembangan Psikososial & Emosional -->
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 overflow-hidden">
                <div class="bg-pink-600 px-4 py-2">
                    <h3 class="text-white font-semibold">5. Psikososial & Emosional</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-600">Interaksi Sosial:</span>
                        <span class="px-2 py-1 bg-pink-100 text-pink-700 rounded font-semibold capitalize">{{ str_replace('_', ' ', $cek->InteraksiSosial) }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-600">Fokus Konsentrasi:</span>
                        <span class="px-2 py-1 bg-pink-100 text-pink-700 rounded font-semibold capitalize">{{ str_replace('_', ' ', $cek->FokusKonsentrasi) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Ekspresi Emosi:</span>
                        <span class="px-2 py-1 bg-pink-100 text-pink-700 rounded font-semibold capitalize">{{ $cek->EkspresiEmosi }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 6. Pola Makan & Tidur -->
        <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 overflow-hidden">
            <div class="bg-indigo-600 px-4 py-2">
                <h3 class="text-white font-semibold">6. Pola Makan & Tidur</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="text-xs text-gray-400 uppercase">Frekuensi Makan</label>
                    <p class="text-lg font-bold text-gray-800">{{ $cek->FrekuensiMakan }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-400 uppercase">Jenis Makanan</label>
                    <p class="text-lg font-bold text-gray-800 capitalize">{{ str_replace('_', ' ', $cek->JenisMakanan) }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-400 uppercase">Pola Tidur</label>
                    <p class="text-lg font-bold text-gray-800 capitalize">{{ $cek->PolaTidur }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-400 uppercase">Waktu Tidur</label>
                    <p class="text-lg font-bold text-gray-800">{{ $cek->WaktuTidur ? \Carbon\Carbon::parse($cek->WaktuTidur)->format('H:i') : '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-400 uppercase">Waktu Bangun</label>
                    <p class="text-lg font-bold text-gray-800">{{ $cek->WaktuBangun ? \Carbon\Carbon::parse($cek->WaktuBangun)->format('H:i') : '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-400 uppercase">Kebiasaan Tidur</label>
                    <p class="text-lg font-bold text-gray-800 capitalize">{{ str_replace('_', ' ', $cek->KebiasaanTidur) }}</p>
                </div>
            </div>
        </div>

        <!-- 7. Penutup -->
        <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 overflow-hidden">
            <div class="bg-gray-800 px-4 py-2">
                <h3 class="text-white font-semibold">7. Penutup</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <p class="text-xs text-gray-400 uppercase mb-2">Catatan Pemeriksaan</p>
                    <div class="bg-gray-50 p-4 rounded-lg italic text-gray-700 min-h-[100px]">
                        {{ $cek->CatatanPemeriksaan ?? 'Tidak ada catatan.' }}
                    </div>
                </div>
                <div class="flex flex-col justify-between">
                    <div>
                        <p class="text-xs text-gray-400 uppercase mb-2">Pemeriksa</p>
                        <p class="text-xl font-bold text-gray-900 border-b-2 border-gray-900 inline-block pb-1">
                            {{ $cek->TandaTanganPemeriksa ?? '-' }}
                        </p>
                    </div>
                    @if($cek->Foto)
                        <div class="mt-4">
                            <p class="text-xs text-gray-400 uppercase mb-2">Foto Dokumentasi</p>
                            <img src="{{ asset('storage/' . $cek->Foto) }}" class="rounded-lg border border-gray-200 max-h-48 shadow-sm">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
