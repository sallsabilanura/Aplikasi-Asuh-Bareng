<x-app-layout>
    <x-slot name="header">
        Edit Posisi: {{ $pos->NamaPosisi }}
    </x-slot>

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Posisi Rekrutmen</h2>
            <p class="text-sm text-gray-500">Perbarui detail posisi untuk rekrutmen internal.</p>
        </div>
        <a href="{{ route('admin.rekrutmen.posisi.index') }}" class="text-gray-500 hover:text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg font-semibold transition-colors">
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden max-w-2xl">
        <form action="{{ route('admin.rekrutmen.posisi.update', $pos->PosisiID) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="mb-5">
                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Posisi</label>
                <input type="text" name="NamaPosisi" value="{{ $pos->NamaPosisi }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm" required>
            </div>
            
            <div class="mb-5">
                <label class="block text-sm font-bold text-gray-700 mb-2">Kuota / Jumlah Kebutuhan</label>
                <input type="text" name="Kuota" value="{{ $pos->Kuota }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm" required>
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Keterangan / Gambaran Peran</label>
                <textarea name="KeteranganPeran" rows="6" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm">{{ $pos->KeteranganPeran }}</textarea>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition-all duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
