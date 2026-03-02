<x-app-layout>
    <x-slot name="header">
        Pengaturan Panduan Rekrutmen
    </x-slot>

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Panduan Rekrutmen</h2>
        <p class="text-sm text-gray-500">Kelola konten panduan dan informasi rekrutmen internal komunitas Asuh Bareng.</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <form action="{{ route('admin.rekrutmen.pengaturan.update') }}" method="POST" class="p-6">
            @csrf

            <!-- Status Aktif Toggle -->
            <div class="mb-8 p-4 bg-gray-50 rounded-lg border border-gray-200 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h3 class="font-bold text-gray-800 text-lg">Status Pendaftaran Rekrutmen</h3>
                    <p class="text-sm text-gray-500">Aktifkan untuk membuka tautan dan formulir pendaftaran publik.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="IsActive" value="1" class="sr-only peer" {{ $setting->IsActive ? 'checked' : '' }}>
                    <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-green-500"></div>
                    <span class="ml-3 text-sm font-bold text-gray-900 peer-checked:text-green-600">Terbuka</span>
                </label>
            </div>

            <div class="grid grid-cols-1 gap-6">
                <!-- Pengenalan -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">1. Pengenalan Komunitas Asuh Bareng</label>
                    <textarea name="Pengenalan" rows="6" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm" placeholder="Masukkan latar belakang, nilai, prinsip program, dll">{{ $setting->Pengenalan }}</textarea>
                </div>

                <!-- Tujuan -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">2. Tujuan Rekrutmen Internal</label>
                    <textarea name="Tujuan" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm">{{ $setting->Tujuan }}</textarea>
                </div>

                <!-- Ketentuan Umum -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">3. Ketentuan Umum Pendaftar</label>
                    <textarea name="KetentuanUmum" rows="6" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm" placeholder="Gunakan format list misal: - Poin 1 \n - Poin 2">{{ $setting->KetentuanUmum }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Anda dapat menggunakan baris baru untuk membuat daftar.</p>
                </div>

                <!-- Sistem Kafalah -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">4. Sistem Kafalah</label>
                    <textarea name="SistemKafalah" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm">{{ $setting->SistemKafalah }}</textarea>
                </div>

                <!-- Mekanisme -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">5. Mekanisme Rekrutmen</label>
                    <textarea name="Mekanisme" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm" placeholder="Deadline, kontak resmi, info tes, dll">{{ $setting->Mekanisme }}</textarea>
                </div>

                <!-- Penutup -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">6. Penutup (Quotes / Pesan Terakhir)</label>
                    <textarea name="Penutup" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm">{{ $setting->Penutup }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-md transition-all duration-200">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Panduan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
