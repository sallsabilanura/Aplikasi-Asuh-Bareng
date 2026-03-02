<x-app-layout>
    <x-slot name="header">
        Edit Data Kakak Asuh
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('kakak_asuh.index') }}" class="text-pink-600 hover:underline flex items-center">
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
        <form action="{{ route('kakak_asuh.update', $kakakAsuh->KakakAsuhID) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="NamaLengkap" value="{{ old('NamaLengkap', $kakakAsuh->NamaLengkap) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                    <input type="text" name="NomorHP" value="{{ old('NomorHP', $kakakAsuh->NomorHP) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="Email" value="{{ old('Email', $kakakAsuh->Email) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Password (Biarkan kosong jika tidak berubah)</label>
                    <input type="password" name="password" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 placeholder-gray-400" placeholder="••••••••">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Aktif</label>
                    <select name="StatusAktif" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        <option value="aktif" {{ old('StatusAktif', $kakakAsuh->StatusAktif) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('StatusAktif', $kakakAsuh->StatusAktif) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Profil</label>
                    <div class="flex items-center space-x-4">
                        @if ($kakakAsuh->Foto)
                            <img src="{{ asset('storage/' . $kakakAsuh->Foto) }}" class="h-16 w-16 rounded-full object-cover border border-gray-200">
                        @endif
                        <input type="file" name="Foto" class="flex-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <textarea name="Alamat" required rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('Alamat', $kakakAsuh->Alamat) }}</textarea>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-6 rounded-lg shadow-sm transition duration-150">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
