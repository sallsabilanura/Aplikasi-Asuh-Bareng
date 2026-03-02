<x-app-layout>
    <x-slot name="header">
        Tambah Cek Kesehatan Baru
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('cek_kesehatan.index') }}" class="text-pink-600 hover:underline flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 p-8">
        <form action="{{ route('cek_kesehatan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- 1. Relasi & Umum -->
            <div class="bg-pink-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-pink-800 mb-4 border-b border-pink-200 pb-2">1. Relasi & Umum</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Anak Asuh</label>
                        <select name="AnakAsuhID" id="AnakAsuhID" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="">-- Pilih --</option>
                            @foreach($anakAsuhs as $a)
                                <option value="{{ $a->id }}" {{ old('AnakAsuhID') == $a->id ? 'selected' : '' }}>
                                    {{ $a->NamaLengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pemeriksaan</label>
                        <input type="date" name="TanggalPemeriksaan" value="{{ old('TanggalPemeriksaan', date('Y-m-d')) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                </div>
            </div>

            <!-- 2. Data Fisik Dasar -->
            <div class="bg-green-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-green-800 mb-4 border-b border-green-200 pb-2">2. Data Fisik Dasar</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="BeratBadan" value="{{ old('BeratBadan') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tinggi Badan (cm)</label>
                        <input type="number" step="0.01" name="TinggiBadan" value="{{ old('TinggiBadan') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lingkar Kepala (cm)</label>
                        <input type="number" step="0.01" name="LingkarKepala" value="{{ old('LingkarKepala') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">IMT</label>
                        <input type="number" step="0.01" name="IMT" value="{{ old('IMT') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
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
                            <option value="baik">Baik</option>
                            <option value="kurang">Kurang</option>
                            <option value="berlebih">Berlebih</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kesehatan Mata</label>
                        <select name="KesehatanMata" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="normal">Normal</option>
                            <option value="minus">Minus</option>
                            <option value="plus">Plus</option>
                            <option value="silinder">Silinder</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kesehatan Gigi</label>
                        <select name="KesehatanGigi" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="baik">Baik</option>
                            <option value="berlubang">Berlubang</option>
                            <option value="karang_gigi">Karang Gigi</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pendengaran</label>
                        <select name="Pendengaran" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="normal">Normal</option>
                            <option value="gangguan">Gangguan</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Riwayat Penyakit</label>
                        <textarea name="RiwayatPenyakit" rows="2" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('RiwayatPenyakit') }}</textarea>
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
                            <option value="baik">Baik</option>
                            <option value="perlu_latihan">Perlu Latihan</option>
                            <option value="gangguan">Gangguan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Motorik Halus</label>
                        <select name="MotorikHalus" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="baik">Baik</option>
                            <option value="perlu_latihan">Perlu Latihan</option>
                            <option value="gangguan">Gangguan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Respons Sensorik</label>
                        <select name="ResponsSensorik" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="baik">Baik</option>
                            <option value="sensitif">Sensitif</option>
                            <option value="kurang_responsif">Kurang Responsif</option>
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
                            <option value="baik">Baik</option>
                            <option value="perlu_pendampingan">Perlu Pendampingan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fokus Konsentrasi</label>
                        <select name="FokusKonsentrasi" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="baik">Baik</option>
                            <option value="perlu_latihan">Perlu Latihan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ekspresi Emosi</label>
                        <select name="EkspresiEmosi" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="stabil">Stabil</option>
                            <option value="cemas">Cemas</option>
                            <option value="pemalu">Pemalu</option>
                            <option value="agresif">Agresif</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- 6. Pola Makan & Tidur -->
            <div class="bg-indigo-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-indigo-800 mb-4 border-b border-indigo-200 pb-2">6. Pola Makan & Tidur</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Frekuensi Makan</label>
                        <select name="FrekuensiMakan" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="2x">2x</option>
                            <option value="3x">3x</option>
                            <option value="4x">4x</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Makanan</label>
                        <select name="JenisMakanan" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="seimbang">Seimbang</option>
                            <option value="kurang_sayur">Kurang Sayur</option>
                            <option value="sering_junkfood">Sering Junkfood</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pola Tidur</label>
                        <select name="PolaTidur" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="cukup">Cukup</option>
                            <option value="kurang">Kurang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Tidur</label>
                        <input type="time" name="WaktuTidur" value="{{ old('WaktuTidur') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Bangun</label>
                        <input type="time" name="WaktuBangun" value="{{ old('WaktuBangun') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kebiasaan Tidur</label>
                        <select name="KebiasaanTidur" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="teratur">Teratur</option>
                            <option value="sering_bergadang">Sering Bergadang</option>
                            <option value="sering_terbangun">Sering Terbangun</option>
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
                        <textarea name="CatatanPemeriksaan" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('CatatanPemeriksaan') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanda Tangan Pemeriksa (Nama)</label>
                        <input type="text" name="TandaTanganPemeriksa" value="{{ old('TandaTanganPemeriksa') }}" placeholder="Masukkan nama pemeriksa" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Foto Pemeriksaan (Optional)</label>
                        <input type="file" name="Foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition duration-150 transform hover:scale-105">
                    Simpan Laporan Kesehatan
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
