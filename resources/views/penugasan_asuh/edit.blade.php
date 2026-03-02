<x-app-layout>
    <x-slot name="header">
        Edit Penugasan Asuh
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('penugasan_asuh.index') }}" class="text-pink-600 hover:underline flex items-center transition duration-150">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 p-8">
        <form action="{{ route('penugasan_asuh.update', $penugasan->PenugasanID) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Kakak Asuh</label>
                    <select name="KakakAsuhID" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        @foreach ($kakakAsuhs as $kakak)
                            <option value="{{ $kakak->KakakAsuhID }}" {{ old('KakakAsuhID', $penugasan->KakakAsuhID) == $kakak->KakakAsuhID ? 'selected' : '' }}>
                                {{ $kakak->NamaLengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Anak Asuh</label>
                    <select name="AnakAsuhID" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        @foreach ($anakAsuhs as $anak)
                            <option value="{{ $anak->id }}" {{ old('AnakAsuhID', $penugasan->AnakAsuhID) == $anak->id ? 'selected' : '' }}>
                                {{ $anak->NamaLengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                    <input type="date" name="TanggalMulai" value="{{ old('TanggalMulai', $penugasan->TanggalMulai) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai (Opsional)</label>
                    <input type="date" name="TanggalSelesai" value="{{ old('TanggalSelesai', $penugasan->TanggalSelesai) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <div class="flex space-x-3">
                    <a href="{{ route('penugasan_asuh.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-6 rounded-lg shadow-sm transition duration-150">
                        Batal
                    </a>
                    <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-6 rounded-lg shadow-sm transition duration-150">
                        Update Penugasan
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
