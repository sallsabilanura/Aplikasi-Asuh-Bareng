<x-app-layout>
    <div class="sm:flex sm:items-center mb-6">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold text-gray-900">Edit Data Donatur</h1>
            <p class="mt-2 text-sm text-gray-700">Perbarui informasi donatur yang sudah ada.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('donatur.index') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 sm:w-auto">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('donatur.update', $donatur->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="NamaLengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap Donatur <span class="text-red-500">*</span></label>
                        <div class="mt-1">
                            <input type="text" name="NamaLengkap" id="NamaLengkap" value="{{ old('NamaLengkap', $donatur->NamaLengkap) }}" required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                        </div>
                        @error('NamaLengkap') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="TipeDonatur" class="block text-sm font-medium text-gray-700">Tipe Donatur <span class="text-red-500">*</span></label>
                        <div class="mt-1">
                            <select id="TipeDonatur" name="TipeDonatur" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                                <option value="Individu" {{ old('TipeDonatur', $donatur->TipeDonatur) == 'Individu' ? 'selected' : '' }}>Individu / Perorangan</option>
                                <option value="Lembaga/Perusahaan" {{ old('TipeDonatur', $donatur->TipeDonatur) == 'Lembaga/Perusahaan' ? 'selected' : '' }}>Lembaga / Perusahaan</option>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="NomorTelepon" class="block text-sm font-medium text-gray-700">Nomor Telepon / WhatsApp</label>
                        <div class="mt-1">
                            <input type="text" name="NomorTelepon" id="NomorTelepon" value="{{ old('NomorTelepon', $donatur->NomorTelepon) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="Email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1">
                            <input type="email" name="Email" id="Email" value="{{ old('Email', $donatur->Email) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="Alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                        <div class="mt-1">
                            <textarea id="Alamat" name="Alamat" rows="3"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">{{ old('Alamat', $donatur->Alamat) }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="Keterangan" class="block text-sm font-medium text-gray-700">Keterangan / Catatan Tersendiri</label>
                        <div class="mt-1">
                            <textarea id="Keterangan" name="Keterangan" rows="2"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">{{ old('Keterangan', $donatur->Keterangan) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-pink-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                        Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
