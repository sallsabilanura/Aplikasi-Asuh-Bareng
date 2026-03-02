<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran - Asuh Bareng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('bareng.png') }}" type="image/png">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
    </style>
</head>
<body class="text-gray-800 antialiased min-h-screen relative p-4 md:p-8">
    
    <div class="max-w-3xl mx-auto">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <a href="/" class="inline-block mb-4">
                <img src="{{ asset('bareng.png') }}" alt="Logo" class="h-12 mx-auto">
            </a>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Formulir Pendaftaran</h1>
            <p class="text-gray-500 mt-2">Isi data diri Anda dengan lengkap dan jujur.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6 shadow-sm">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                    <span class="font-bold">Mohon periksa kembali isian Anda:</span>
                </div>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rekrutmen.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Section 1: Identitas Diri -->
            <div class="glass-card rounded-2xl p-6 md:p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-2 h-full bg-pink-500"></div>
                <h2 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">1. Identitas Diri</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="NamaLengkap" value="{{ old('NamaLengkap') }}" required class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 h-11 px-4">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Panggilan <span class="text-red-500">*</span></label>
                        <input type="text" name="NamaPanggilan" value="{{ old('NamaPanggilan') }}" required class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 h-11 px-4">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="JenisKelamin" required class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 h-11 px-4">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('JenisKelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('JenisKelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Usia <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="number" name="Usia" min="15" max="60" value="{{ old('Usia') }}" required class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 h-11 px-4">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Tahun</span>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Domisili (Kota/Kecamatan) <span class="text-red-500">*</span></label>
                        <input type="text" name="Domisili" value="{{ old('Domisili') }}" required placeholder="Contoh: Depok, Pancoran Mas" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 h-11 px-4">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nomor WhatsApp Aktif <span class="text-red-500">*</span></label>
                        <input type="text" name="NoWhatsapp" value="{{ old('NoWhatsapp') }}" required placeholder="Contoh: 08123456789" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 h-11 px-4">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Alamat Email <span class="text-red-500">*</span></label>
                        <input type="email" name="Email" value="{{ old('Email') }}" required placeholder="Contoh: nama@email.com" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 h-11 px-4">
                        <p class="text-[10px] text-gray-500 mt-1">Gunakan email aktif untuk keperluan login jika Anda diterima.</p>
                    </div>
                </div>
            </div>

            <!-- Section 2: Latar Belakang -->
            <div class="glass-card rounded-2xl p-6 md:p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-2 h-full bg-indigo-500"></div>
                <h2 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">2. Latar Belakang Pendidikan & Aktivitas</h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Pendidikan Terakhir <span class="text-red-500">*</span></label>
                        <input type="text" name="PendidikanTerakhir" value="{{ old('PendidikanTerakhir') }}" required placeholder="Contoh: S1 / SMA" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 h-11 px-4">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Asal Sekolah / Kampus <span class="text-red-500">*</span></label>
                        <input type="text" name="AsalInstansi" value="{{ old('AsalInstansi') }}" required placeholder="Contoh: Universitas Indonesia" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 h-11 px-4">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Kesibukan Saat Ini <span class="text-red-500">*</span></label>
                        <input type="text" name="KesibukanSaatIni" value="{{ old('KesibukanSaatIni') }}" required placeholder="Contoh: Mahasiswa Semester 5 / Karyawan Swasta" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 h-11 px-4">
                    </div>
                </div>
            </div>

            <!-- Section 3: Posisi & Motivasi -->
            <div class="glass-card rounded-2xl p-6 md:p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-2 h-full bg-emerald-500"></div>
                <h2 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">3. Posisi Dilamar & Motivasi</h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Posisi yang Dilamar <span class="text-red-500">*</span></label>
                        <select name="PosisiID" required class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 h-11 px-4 font-semibold text-pink-700 bg-pink-50">
                            <option value="">-- Pilih Posisi --</option>
                            @foreach($posisi as $pos)
                                <option value="{{ $pos->PosisiID }}" {{ old('PosisiID') == $pos->PosisiID ? 'selected' : '' }}>{{ $pos->NamaPosisi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Ceritakan alasan mendaftar di Asuh Bareng <span class="text-red-500">*</span></label>
                        <textarea name="AlasanMendaftar" required rows="4" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 p-4">{{ old('AlasanMendaftar') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Apa yang membuat Anda tertarik pada posisi yang dilamar? <span class="text-red-500">*</span></label>
                        <textarea name="HalMenarik" required rows="4" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 p-4">{{ old('HalMenarik') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Ceritakan pengalaman Anda yang relevan dengan posisi tersebut <span class="text-red-500">*</span></label>
                        <textarea name="PengalamanRelevan" required rows="4" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 p-4">{{ old('PengalamanRelevan') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Menurut Anda, apa arti sebuah "Komitmen"? <span class="text-red-500">*</span></label>
                        <textarea name="ArtiKomitmen" required rows="4" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 p-4">{{ old('ArtiKomitmen') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section 4: Kesiapan & Komitmen -->
            <div class="glass-card rounded-2xl p-6 md:p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-2 h-full bg-amber-500"></div>
                <h2 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">4. Kesiapan Dasar</h2>
                
                <div class="space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <span class="font-bold text-gray-700 mb-2 sm:mb-0">Apakah Anda siap dikontrak selama 5 Bulan kerja? <span class="text-red-500">*</span></span>
                        <div class="flex items-center gap-4">
                            <label class="inline-flex items-center"><input type="radio" required name="SiapKontrak" value="1" {{ old('SiapKontrak') === '1' ? 'checked' : '' }} class="text-pink-600 focus:ring-pink-500"><span class="ml-2">Ya</span></label>
                            <label class="inline-flex items-center"><input type="radio" required name="SiapKontrak" value="0" {{ old('SiapKontrak') === '0' ? 'checked' : '' }} class="text-pink-600 focus:ring-pink-500"><span class="ml-2">Tidak</span></label>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <span class="font-bold text-gray-700 mb-2 sm:mb-0">Apakah memiliki kendaraan pribadi & siap mobilitas lapangan? <span class="text-red-500">*</span></span>
                        <div class="flex items-center gap-4">
                            <label class="inline-flex items-center"><input type="radio" required name="KendaraanPribadi" value="1" {{ old('KendaraanPribadi') === '1' ? 'checked' : '' }} class="text-pink-600 focus:ring-pink-500"><span class="ml-2">Ya</span></label>
                            <label class="inline-flex items-center"><input type="radio" required name="KendaraanPribadi" value="0" {{ old('KendaraanPribadi') === '0' ? 'checked' : '' }} class="text-pink-600 focus:ring-pink-500"><span class="ml-2">Tidak</span></label>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <span class="font-bold text-gray-700 mb-2 sm:mb-0">Apakah Anda memiliki laptop pribadi? <span class="text-red-500">*</span></span>
                        <div class="flex items-center gap-4">
                            <label class="inline-flex items-center"><input type="radio" required name="LaptopPribadi" value="1" {{ old('LaptopPribadi') === '1' ? 'checked' : '' }} class="text-pink-600 focus:ring-pink-500"><span class="ml-2">Ya</span></label>
                            <label class="inline-flex items-center"><input type="radio" required name="LaptopPribadi" value="0" {{ old('LaptopPribadi') === '0' ? 'checked' : '' }} class="text-pink-600 focus:ring-pink-500"><span class="ml-2">Tidak</span></label>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <span class="font-bold text-gray-700 mb-2 sm:mb-0">Apakah Anda siap mengikuti seluruh aturan & SOP kami? <span class="text-red-500">*</span></span>
                        <div class="flex items-center gap-4">
                            <label class="inline-flex items-center"><input type="radio" required name="SiapSOP" value="1" {{ old('SiapSOP') === '1' ? 'checked' : '' }} class="text-pink-600 focus:ring-pink-500"><span class="ml-2">Ya, Siap</span></label>
                            <label class="inline-flex items-center"><input type="radio" required name="SiapSOP" value="0" {{ old('SiapSOP') === '0' ? 'checked' : '' }} class="text-pink-600 focus:ring-pink-500"><span class="ml-2">Tidak</span></label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 5: Upload Berkas -->
            <div class="glass-card rounded-2xl p-6 md:p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-2 h-full bg-cyan-500"></div>
                <h2 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">5. Berkas Lampiran</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Curriculum Vitae (CV) <span class="text-red-500">*</span></label>
                        <p class="text-xs text-gray-500 mb-2">Maks. 5MB, format PDF</p>
                        <input type="file" name="CV" required accept=".pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 cursor-pointer">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Pas Foto Terbaru <span class="text-red-500">*</span></label>
                        <p class="text-xs text-gray-500 mb-2">Maks. 2MB, format JPG/PNG</p>
                        <input type="file" name="Foto" required accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 cursor-pointer">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Portofolio (Opsional)</label>
                        <p class="text-xs text-gray-500 mb-2">Maks. 10MB, format PDF. Sangat disarankan untuk posisi Media/Desain.</p>
                        <input type="file" name="Portofolio" accept=".pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 cursor-pointer">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center pt-4 pb-12">
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-10 py-4 text-lg font-bold text-white transition-all duration-200 bg-pink-600 border border-transparent rounded-full shadow-lg hover:bg-pink-700 hover:shadow-xl hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-600">
                    Kirim Pendaftaran
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </button>
            </div>
        </form>

    </div>
</body>
</html>
