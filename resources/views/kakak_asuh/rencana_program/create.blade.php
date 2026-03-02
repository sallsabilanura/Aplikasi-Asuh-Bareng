<x-app-layout>
    <x-slot name="header">
        Tambah Rencana Program
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
            <div class="p-6">
                <form action="{{ route('rencana-program.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="NamaProgram" class="block text-sm font-bold text-gray-700 mb-2">Nama Program / Tugas <span class="text-red-500">*</span></label>
                        <input type="text" name="NamaProgram" id="NamaProgram" required 
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm"
                               placeholder="Contoh: Membuat Desain Feed Instagram Bulanan">
                        @error('NamaProgram') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="Deskripsi" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi & Tujuan <span class="text-red-500">*</span></label>
                        <textarea name="Deskripsi" id="Deskripsi" rows="5" required 
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm"
                                  placeholder="Jelaskan apa saja yang akan dikerjakan, target luaran (output), dan tujuannya..."></textarea>
                        @error('Deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="TargetSelesai" class="block text-sm font-bold text-gray-700 mb-2">Target Waktu Selesai <span class="text-red-500">*</span></label>
                        <input type="date" name="TargetSelesai" id="TargetSelesai" required 
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm">
                        <p class="text-xs text-gray-500 mt-1">Kapan rencana program ini diharapkan selesai atau berakhir.</p>
                        @error('TargetSelesai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('rencana-program.index') }}" class="bg-white border border-gray-300 text-gray-700 font-bold px-6 py-2.5 rounded-lg hover:bg-gray-50 transition shadow-sm">
                            Batal
                        </a>
                        <button type="submit" class="bg-pink-600 text-white font-bold px-6 py-2.5 rounded-lg hover:bg-pink-700 transition shadow-sm">
                            Ajukan Rencana
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
