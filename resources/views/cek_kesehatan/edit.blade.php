<x-app-layout>
    <x-slot name="header">
        Edit Cek Kesehatan
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('cek_kesehatan.index') }}" class="text-pink-600 hover:underline flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 p-8">
        <form action="{{ route('cek_kesehatan.update', $cek->KesehatanID) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- 1. Relasi & Umum -->
            <div class="bg-pink-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-pink-800 mb-4 border-b border-pink-200 pb-2">1. Relasi & Umum</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Anak Asuh</label>
                        <select name="AnakAsuhID" id="AnakAsuhID" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach($anakAsuhs as $a)
                                <option value="{{ $a->id }}" {{ old('AnakAsuhID', $cek->AnakAsuhID) == $a->id ? 'selected' : '' }}>
                                    {{ $a->NamaLengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pemeriksaan</label>
                        <input type="date" name="TanggalPemeriksaan" value="{{ old('TanggalPemeriksaan', $cek->TanggalPemeriksaan) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                </div>
            </div>

            <!-- 2. Data Fisik Dasar -->
            <div class="bg-green-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-green-800 mb-4 border-b border-green-200 pb-2">2. Data Fisik Dasar</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="BeratBadan" value="{{ old('BeratBadan', $cek->BeratBadan) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tinggi Badan (cm)</label>
                        <input type="number" step="0.01" name="TinggiBadan" value="{{ old('TinggiBadan', $cek->TinggiBadan) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lingkar Kepala (cm)</label>
                        <input type="number" step="0.01" name="LingkarKepala" value="{{ old('LingkarKepala', $cek->LingkarKepala) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">IMT</label>
                        <input type="number" step="0.01" name="IMT" value="{{ old('IMT', $cek->IMT) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                </div>
            </div>

            <!-- 3. Pemeriksaan Kesehatan Umum -->
            <div class="bg-yellow-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-yellow-800 mb-4 border-b border-yellow-200 pb-2">3. Pemeriksaan Kesehatan Umum</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Gizi</label>
                        <select name="StatusGizi" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach(['baik', 'kurang', 'berlebih'] as $val)
                                <option value="{{ $val }}" {{ old('StatusGizi', $cek->StatusGizi) == $val ? 'selected' : '' }}>{{ ucfirst($val) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kesehatan Mata</label>
                        <select name="KesehatanMata" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach(['normal', 'minus', 'plus', 'silinder'] as $val)
                                <option value="{{ $val }}" {{ old('KesehatanMata', $cek->KesehatanMata) == $val ? 'selected' : '' }}>{{ ucfirst($val) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kesehatan Gigi</label>
                        <select name="KesehatanGigi" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach(['baik', 'berlubang', 'karang_gigi'] as $val)
                                <option value="{{ $val }}" {{ old('KesehatanGigi', $cek->KesehatanGigi) == $val ? 'selected' : '' }}>{{ str_replace('_', ' ', ucfirst($val)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pendengaran</label>
                        <select name="Pendengaran" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach(['normal', 'gangguan'] as $val)
                                <option value="{{ $val }}" {{ old('Pendengaran', $cek->Pendengaran) == $val ? 'selected' : '' }}>{{ ucfirst($val) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Riwayat Penyakit</label>
                        <textarea name="RiwayatPenyakit" rows="2" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('RiwayatPenyakit', $cek->RiwayatPenyakit) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- 4. Motorik & Sensorik -->
            <div class="bg-purple-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-purple-800 mb-4 border-b border-purple-200 pb-2">4. Motorik & Sensorik</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Motorik Kasar</label>
                        <select name="MotorikKasar" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach(['baik', 'perlu_latihan', 'gangguan'] as $val)
                                <option value="{{ $val }}" {{ old('MotorikKasar', $cek->MotorikKasar) == $val ? 'selected' : '' }}>{{ str_replace('_', ' ', ucfirst($val)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Motorik Halus</label>
                        <select name="MotorikHalus" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach(['baik', 'perlu_latihan', 'gangguan'] as $val)
                                <option value="{{ $val }}" {{ old('MotorikHalus', $cek->MotorikHalus) == $val ? 'selected' : '' }}>{{ str_replace('_', ' ', ucfirst($val)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Respons Sensorik</label>
                        <select name="ResponsSensorik" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach(['baik', 'sensitif', 'kurang_responsif'] as $val)
                                <option value="{{ $val }}" {{ old('ResponsSensorik', $cek->ResponsSensorik) == $val ? 'selected' : '' }}>{{ str_replace('_', ' ', ucfirst($val)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- 5. Perkembangan Psikososial & Emosional -->
            <div class="bg-pink-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-pink-800 mb-4 border-b border-pink-200 pb-2">5. Perkembangan Psikososial & Emosional</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Interaksi Sosial</label>
                        <select name="InteraksiSosial" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach(['baik', 'perlu_pendampingan'] as $val)
                                <option value="{{ $val }}" {{ old('InteraksiSosial', $cek->InteraksiSosial) == $val ? 'selected' : '' }}>{{ str_replace('_', ' ', ucfirst($val)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fokus Konsentrasi</label>
                        <select name="FokusKonsentrasi" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach(['baik', 'perlu_latihan'] as $val)
                                <option value="{{ $val }}" {{ old('FokusKonsentrasi', $cek->FokusKonsentrasi) == $val ? 'selected' : '' }}>{{ str_replace('_', ' ', ucfirst($val)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ekspresi Emosi</label>
                        <select name="EkspresiEmosi" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach(['stabil', 'cemas', 'pemalu', 'agresif', 'lainnya'] as $val)
                                <option value="{{ $val }}" {{ old('EkspresiEmosi', $cek->EkspresiEmosi) == $val ? 'selected' : '' }}>{{ ucfirst($val) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- 6. Pola Makan & Tidur -->
            <div class="bg-pink-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-pink-800 mb-4 border-b border-indigo-200 pb-2">6. Pola Makan & Tidur</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Frekuensi Makan</label>
                        <select name="FrekuensiMakan" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach(['2x', '3x', '4x'] as $val)
                                <option value="{{ $val }}" {{ old('FrekuensiMakan', $cek->FrekuensiMakan) == $val ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Makanan</label>
                        <select name="JenisMakanan" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach(['seimbang', 'kurang_sayur', 'sering_junkfood'] as $val)
                                <option value="{{ $val }}" {{ old('JenisMakanan', $cek->JenisMakanan) == $val ? 'selected' : '' }}>{{ str_replace('_', ' ', ucfirst($val)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pola Tidur</label>
                        <select name="PolaTidur" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach(['cukup', 'kurang'] as $val)
                                <option value="{{ $val }}" {{ old('PolaTidur', $cek->PolaTidur) == $val ? 'selected' : '' }}>{{ ucfirst($val) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Tidur</label>
                        <input type="time" name="WaktuTidur" value="{{ old('WaktuTidur', $cek->WaktuTidur) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Bangun</label>
                        <input type="time" name="WaktuBangun" value="{{ old('WaktuBangun', $cek->WaktuBangun) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kebiasaan Tidur</label>
                        <select name="KebiasaanTidur" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach(['teratur', 'sering_bergadang', 'sering_terbangun'] as $val)
                                <option value="{{ $val }}" {{ old('KebiasaanTidur', $cek->KebiasaanTidur) == $val ? 'selected' : '' }}>{{ str_replace('_', ' ', ucfirst($val)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- 7. Penutup -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">7. Penutup</h3>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Pemeriksaan</label>
                        <textarea name="CatatanPemeriksaan" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('CatatanPemeriksaan', $cek->CatatanPemeriksaan) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanda Tangan Pemeriksa (Nama)</label>
                        <input type="text" name="TandaTanganPemeriksa" value="{{ old('TandaTanganPemeriksa', $cek->TandaTanganPemeriksa) }}" placeholder="Masukkan nama pemeriksa" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                        @if($cek->Foto)
                            <div>
                                <p class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</p>
                                <img src="{{ asset('storage/' . $cek->Foto) }}" class="rounded-lg border border-gray-200 max-h-48">
                            </div>
                        @endif
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Foto Pemeriksaan (Optional)</label>
                            <input type="file" name="Foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition duration-150 transform hover:scale-105">
                    Update Laporan Kesehatan
                </button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#AnakAsuhID').select2({
                placeholder: "-- Pilih Anak Asuh --",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
</x-app-layout>
