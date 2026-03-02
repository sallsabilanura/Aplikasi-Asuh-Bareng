<x-app-layout>
    <div class="sm:flex sm:items-center mb-6">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold text-gray-900">Input Manual Penyaluran Dana</h1>
            <p class="mt-2 text-sm text-gray-700">Masukkan riwayat penyaluran dana secara spesifik untuk satu anak asuh.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('penyaluran.index') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 sm:w-auto">
                Kembali
            </a>
        </div>
    </div>

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
            <span class="block sm:inline font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('penyaluran.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <label for="AnakAsuhID" class="block text-sm font-medium text-gray-700">Nama Anak Asuh <span class="text-red-500">*</span></label>
                        <div class="mt-1">
                            <select id="AnakAsuhID" name="AnakAsuhID" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                                <option value="">-- Pilih Anak Asuh --</option>
                                @foreach($anakAsuhs as $anak)
                                    <option value="{{ $anak->id }}" {{ old('AnakAsuhID') == $anak->id ? 'selected' : '' }}>
                                        {{ $anak->NamaLengkap }} ({{ $anak->Sekolah }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('AnakAsuhID') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="Bulan" class="block text-sm font-medium text-gray-700">Bulan <span class="text-red-500">*</span></label>
                        <div class="mt-1">
                            <select id="Bulan" name="Bulan" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                                @for($i=1; $i<=12; $i++)
                                    <option value="{{ $i }}" {{ (old('Bulan') ?? date('n')) == $i ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="Tahun" class="block text-sm font-medium text-gray-700">Tahun <span class="text-red-500">*</span></label>
                        <div class="mt-1">
                            <input type="number" name="Tahun" id="Tahun" value="{{ old('Tahun') ?? date('Y') }}" required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="Nominal" class="block text-sm font-medium text-gray-700">Nominal Salur (Rp) <span class="text-red-500">*</span></label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" name="Nominal" id="Nominal" value="{{ old('Nominal', 350000) }}" required
                                class="block w-full pl-10 rounded-md border-gray-300 focus:border-pink-500 focus:ring-pink-500 sm:text-sm" placeholder="350000">
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="Keterangan" class="block text-sm font-medium text-gray-700">Keterangan / Catatan Tersendiri</label>
                        <div class="mt-1">
                            <textarea id="Keterangan" name="Keterangan" rows="2"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm" placeholder="Opsional: misal pemotongan dana karena telat absen, dsb...">{{ old('Keterangan') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-pink-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                        Simpan Data Manual
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
