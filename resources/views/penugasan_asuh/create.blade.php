<x-app-layout>
    <x-slot name="header">
        Buat Penugasan Asuh Baru
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
        <form action="{{ route('penugasan_asuh.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Kakak Asuh</label>
                    <select name="KakakAsuhID" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        <option value="">-- Pilih --</option>
                        @foreach ($kakakAsuhs as $kakak)
                            <option value="{{ $kakak->KakakAsuhID }}" {{ old('KakakAsuhID') == $kakak->KakakAsuhID ? 'selected' : '' }}>
                                {{ $kakak->NamaLengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Anak Asuh</label>
                    <div id="anak-container" class="space-y-3">
                        <div class="anak-item flex items-center space-x-2">
                            <select name="AnakAsuhIDs[]" required class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                <option value="">-- Pilih --</option>
                                @foreach ($anakAsuhs as $anak)
                                    <option value="{{ $anak->id }}">
                                        {{ $anak->NamaLengkap }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" class="remove-anak text-red-600 hover:text-red-800 transition duration-150" style="display: none;">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
                    </div>
                    <button type="button" id="add-anak" class="text-sm text-pink-600 hover:text-pink-800 font-semibold flex items-center space-x-1 transition duration-150 underline decoration-dotted">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path></svg>
                        <span>Tambah Anak Lagi</span>
                    </button>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                    <input type="date" name="TanggalMulai" value="{{ old('TanggalMulai', date('Y-m-d')) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai (Opsional)</label>
                    <input type="date" name="TanggalSelesai" value="{{ old('TanggalSelesai') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-6 rounded-lg shadow-sm transition duration-150">
                    Simpan Penugasan
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-anak').addEventListener('click', function() {
            const container = document.getElementById('anak-container');
            const newItem = container.querySelector('.anak-item').cloneNode(true);
            newItem.querySelector('select').value = ""; 
            newItem.querySelector('.remove-anak').style.display = 'inline'; 
            container.appendChild(newItem);
        });

        document.getElementById('anak-container').addEventListener('click', function(e) {
            if (e.target.closest('.remove-anak')) {
                e.target.closest('.anak-item').remove();
            }
        });
    </script>
</x-app-layout>
