<x-app-layout>
    <x-slot name="header">
        Tambah Absensi Pendampingan
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('absensi_pendampingan.index') }}" class="text-pink-600 hover:underline flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
    </div>

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 p-8">
        <form action="{{ route('absensi_pendampingan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if(Auth::check() && Auth::user()->role === 'kakak_asuh' && $kakakAsuh)
                    <input type="hidden" name="KakakAsuhID" value="{{ $kakakAsuh->KakakAsuhID }}">
                @else
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Kakak Asuh</label>
                        <select name="KakakAsuhID" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="">-- Pilih --</option>
                            @foreach($kakakAsuhs as $k)
                                <option value="{{ $k->KakakAsuhID }}" {{ old('KakakAsuhID') == $k->KakakAsuhID ? 'selected' : '' }}>
                                    {{ $k->NamaLengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Anak Asuh</label>
                    <select name="AnakAsuhID" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        <option value="">-- Pilih --</option>
                        @foreach($anakAsuhs as $a)
                            <option value="{{ $a->id }}" {{ old('AnakAsuhID') == $a->id ? 'selected' : '' }}>
                                {{ $a->NamaLengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Pendampingan</label>
                    <select name="JenisPendampingan" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        <option value="Offline" {{ old('JenisPendampingan') == 'Offline' ? 'selected' : '' }}>Offline</option>
                        <option value="Online" {{ old('JenisPendampingan') == 'Online' ? 'selected' : '' }}>Online</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="Tanggal" value="{{ old('Tanggal', date('Y-m-d')) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai</label>
                    <input type="time" name="WaktuMulai" value="{{ old('WaktuMulai') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Selesai</label>
                    <input type="time" name="WaktuSelesai" value="{{ old('WaktuSelesai') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nilai Pendampingan (1-100)</label>
                    <input type="number" name="NilaiPendampingan" min="1" max="100" value="{{ old('NilaiPendampingan') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Perkembangan</label>
                <textarea name="DeskripsiPerkembangan" rows="4" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('DeskripsiPerkembangan') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kendala</label>
                <textarea name="Kendala" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('Kendala') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Foto Bukti</label>
                <input type="file" name="FotoBukti" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-6 rounded-lg shadow-sm transition duration-150">
                    Simpan Absensi
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
