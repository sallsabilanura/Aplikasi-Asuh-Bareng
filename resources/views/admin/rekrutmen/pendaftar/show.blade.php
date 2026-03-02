<x-app-layout>
    <x-slot name="header">
        Detail Aplikasi Pelamar
    </x-slot>

    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Aplikasi: {{ $pendaftar->NamaLengkap }}</h2>
            <p class="text-sm text-pink-600 font-bold">Posisi: {{ $pendaftar->posisi->NamaPosisi ?? '-' }}</p>
        </div>
        <a href="{{ route('admin.rekrutmen.pendaftar.index') }}" class="text-gray-600 hover:text-gray-900 bg-white border border-gray-300 hover:bg-gray-50 px-4 py-2 rounded-lg font-semibold transition-colors shadow-sm">
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        
        <!-- Kolom Kiri: Profil & Lampiran -->
        <div class="xl:col-span-1 space-y-6">
            
            <!-- Pas Foto & Profil Ringkas -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
                @if($pendaftar->FotoPath)
                    <img src="{{ Storage::url($pendaftar->FotoPath) }}" alt="Foto Pelamar" class="w-32 h-32 object-cover rounded-full mx-auto border-4 border-pink-100 mb-4 shadow-sm">
                @else
                    <div class="w-32 h-32 rounded-full mx-auto bg-gray-200 flex items-center justify-center mb-4 text-gray-400 text-3xl font-bold">
                        {{ strtoupper(substr($pendaftar->NamaLengkap, 0, 1)) }}
                    </div>
                @endif
                <h3 class="text-xl font-bold text-gray-800">{{ $pendaftar->NamaLengkap }}</h3>
                <p class="text-gray-500 mb-4">"{{ $pendaftar->NamaPanggilan }}" &bull; {{ $pendaftar->Usia }} Tahun</p>
                
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pendaftar->NoWhatsapp) }}" target="_blank" class="w-full inline-flex justify-center items-center bg-green-100 hover:bg-green-200 text-green-700 font-bold py-2 px-4 rounded-lg transition-colors">
                    Hubungi WhatsApp
                </a>
            </div>

            <!-- Informasi Kontak & Latar Belakang -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 font-bold text-gray-700 text-lg">Identitas & Kontak</div>
                <div class="p-6 space-y-5">
                    <div>
                        <span class="block text-xs text-gray-400 uppercase font-bold tracking-widest mb-1">Jenis Kelamin</span>
                        <span class="text-gray-900 font-semibold text-base">{{ $pendaftar->JenisKelamin }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-400 uppercase font-bold tracking-widest mb-1">Domisili</span>
                        <span class="text-gray-900 font-semibold text-base">{{ $pendaftar->Domisili }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-400 uppercase font-bold tracking-widest mb-1">Pendidikan Terakhir</span>
                        <span class="text-gray-900 font-semibold text-base">{{ $pendaftar->PendidikanTerakhir }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-400 uppercase font-bold tracking-widest mb-1">Asal Sekolah/Kampus</span>
                        <span class="text-gray-900 font-semibold text-base">{{ $pendaftar->AsalInstansi }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-400 uppercase font-bold tracking-widest mb-1">Kesibukan Saat Ini</span>
                        <span class="text-gray-900 font-semibold text-base">{{ $pendaftar->KesibukanSaatIni }}</span>
                    </div>
                </div>
            </div>

            <!-- Berkas Unduhan -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 font-bold text-gray-700 text-lg">Berkas Lampiran</div>
                <div class="p-6 space-y-4 flex flex-col">
                    @if($pendaftar->CVPath)
                        <a href="{{ Storage::url($pendaftar->CVPath) }}" target="_blank" class="flex items-center justify-between p-4 bg-indigo-50 border border-indigo-100 rounded-lg hover:bg-indigo-100 transition-colors">
                            <span class="font-bold text-indigo-700 text-base">Curriculum Vitae (CV)</span>
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    @else
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-100 flex justify-between items-center">
                            <span class="text-sm text-gray-500 font-medium">Curriculum Vitae (CV)</span>
                            <span class="text-xs font-bold text-gray-400 bg-white px-2 py-1 rounded border">Tidak Ada</span>
                        </div>
                    @endif

                    @if($pendaftar->PortofolioPath)
                        <a href="{{ Storage::url($pendaftar->PortofolioPath) }}" target="_blank" class="flex items-center justify-between p-4 bg-pink-50 border border-pink-100 rounded-lg hover:bg-pink-100 transition-colors">
                            <span class="font-bold text-pink-700 text-base">Portofolio</span>
                            <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    @else
                        <div class="flex items-center justify-between p-4 bg-gray-50 border border-gray-100 rounded-lg">
                            <span class="font-medium text-gray-500 text-sm">Portofolio</span>
                            <span class="text-xs font-bold text-gray-400 bg-white px-2 py-1 rounded border">Tidak Ada</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Bridge -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 font-bold text-gray-700 text-lg">Tindakan Admin</div>
                <div class="p-6">
                    @if($isAlreadyUser)
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-lg flex items-center">
                            <svg class="w-5 h-5 text-blue-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-sm text-blue-700 font-bold">Pelamar ini sudah terdaftar sebagai User/Relawan.</p>
                        </div>
                    @else
                        <p class="text-xs text-gray-500 mb-4 mb-4">Menerima pelamar ini akan otomatis membuatkan akun **User** dan profil **Kakak Asuh**. Email login akan menggunakan email pelamar.</p>
                        <form action="{{ route('admin.rekrutmen.pendaftar.terima', $pendaftar->PendaftarID) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition-all duration-200 flex items-center justify-center transform hover:-translate-y-1 active:scale-95" onclick="return confirm('Daftarkan pelamar ini menjadi Kakak Asuh?')">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                Terima sebagai Kakak Asuh
                            </button>
                        </form>
                    @endif
                </div>
            </div>

        </div>

        <!-- Kolom Kanan: Kuisioner & Essay -->
        <div class="xl:col-span-2 space-y-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-5 border-b border-gray-200 flex items-center gap-3">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    <h3 class="font-bold text-gray-800 text-xl">Esai & Motivasi</h3>
                </div>
                <div class="p-8 space-y-8">
                    <div>
                        <span class="block font-bold text-gray-800 text-lg mb-3">1. Ceritakan alasan mendaftar di Asuh Bareng</span>
                        <p class="text-gray-600 text-base leading-relaxed whitespace-pre-line bg-gray-50 p-5 rounded-xl border border-gray-100">{{ $pendaftar->AlasanMendaftar }}</p>
                    </div>
                    <div>
                        <span class="block font-bold text-gray-800 text-lg mb-3">2. Apa yang membuat anda tertarik pada posisi ini?</span>
                        <p class="text-gray-600 text-base leading-relaxed whitespace-pre-line bg-gray-50 p-5 rounded-xl border border-gray-100">{{ $pendaftar->HalMenarik }}</p>
                    </div>
                    <div>
                        <span class="block font-bold text-gray-800 text-lg mb-3">3. Pengalaman yang relevan</span>
                        <p class="text-gray-600 text-base leading-relaxed whitespace-pre-line bg-gray-50 p-5 rounded-xl border border-gray-100">{{ $pendaftar->PengalamanRelevan }}</p>
                    </div>
                    <div>
                        <span class="block font-bold text-gray-800 text-lg mb-3">4. Menurut anda, apa arti komitmen?</span>
                        <p class="text-gray-600 text-base leading-relaxed whitespace-pre-line bg-gray-50 p-5 rounded-xl border border-gray-100">{{ $pendaftar->ArtiKomitmen }}</p>
                    </div>
                </div>
            </div>

            <!-- Kesiapan & Komitmen -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="font-bold text-gray-800 text-lg">Kesiapan & Komitmen</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <div class="flex items-center justify-between p-4 {{ $pendaftar->SiapKontrak ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }} border rounded-lg">
                        <span class="text-sm font-bold text-gray-700">Siap Dikontrak Selama 5 Bulan</span>
                        @if($pendaftar->SiapKontrak)
                            <span class="bg-green-600 text-white text-xs font-bold px-2 py-1 rounded">Ya, Siap</span>
                        @else
                            <span class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">Tidak</span>
                        @endif
                    </div>
                    
                    <div class="flex items-center justify-between p-4 {{ $pendaftar->KendaraanPribadi ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }} border rounded-lg">
                        <span class="text-sm font-bold text-gray-700">Punya Kendaraan & Siap Mobilitas</span>
                        @if($pendaftar->KendaraanPribadi)
                            <span class="bg-green-600 text-white text-xs font-bold px-2 py-1 rounded">Ya, Siap</span>
                        @else
                            <span class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">Tidak</span>
                        @endif
                    </div>

                    <div class="flex items-center justify-between p-4 {{ $pendaftar->LaptopPribadi ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }} border rounded-lg">
                        <span class="text-sm font-bold text-gray-700">Punya Laptop Pribadi</span>
                        @if($pendaftar->LaptopPribadi)
                            <span class="bg-green-600 text-white text-xs font-bold px-2 py-1 rounded">Ya</span>
                        @else
                            <span class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">Tidak</span>
                        @endif
                    </div>

                    <div class="flex items-center justify-between p-4 {{ $pendaftar->SiapSOP ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }} border rounded-lg">
                        <span class="text-sm font-bold text-gray-700">Siap Mengikuti SOP/Aturan</span>
                        @if($pendaftar->SiapSOP)
                            <span class="bg-green-600 text-white text-xs font-bold px-2 py-1 rounded">Ya, Siap</span>
                        @else
                            <span class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">Tidak</span>
                        @endif
                    </div>

                </div>
            </div>

        </div>

    </div>
</x-app-layout>
