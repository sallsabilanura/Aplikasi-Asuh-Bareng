<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tulis Rapor Asuh') }}
        </h2>
    </x-slot>

<div class="container mx-auto px-4 py-8 max-w-4xl">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-pink-500 to-pink-600 px-6 py-5 flex justify-between items-center text-white">
            <div>
                <h2 class="text-2xl font-bold">Ringkasan Perkembangan Anak Asuh</h2>
                <p class="text-sm opacity-90">Semester {{ $semester == 1 ? '1 (Jan-Jun)' : '2 (Jul-Des)' }} {{ $year }}</p>
            </div>
            <a href="{{ route('rapor_asuh.index', ['semester' => $semester, 'year' => $year]) }}" class="px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg text-sm font-semibold transition">
                &larr; Kembali
            </a>
        </div>
        
        <div class="p-6">
            @if ($errors->any())
                <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-lg font-medium text-sm border border-red-200">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-100">
                <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-100 flex-shrink-0 border border-gray-200">
                    @if($anak->FotoAnak)
                        <img src="{{ asset('storage/' . $anak->FotoAnak) }}" alt="Foto {{ $anak->NamaLengkap }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-full h-full text-gray-400 p-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    @endif
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-lg">{{ $anak->NamaLengkap }}</h3>
                    <p class="text-sm text-gray-500">Nilai Pendidikan, Kesehatan, Ibadah, dan Karakter akan dihitung otomatis saat dicetak berdasarkan data aktual sistem.</p>
                </div>
            </div>

            <form action="{{ route('rapor_asuh.store', ['id' => $anak->id, 'semester' => $semester, 'year' => $year]) }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label for="RingkasanPerkembangan" class="block text-sm font-semibold text-gray-700 mb-2">Ringkasan Perkembangan / Catatan Kakak Asuh</label>
                    <textarea name="RingkasanPerkembangan" id="RingkasanPerkembangan" rows="6" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm" placeholder="Contoh: Terus semangat ya, jaga kesehatan dan kebersihan. Lebih rajin lagi shalat dan mengajinya, dan jangan pantang menyerah..." required>{{ old('RingkasanPerkembangan', $rapor->RingkasanPerkembangan ?? '') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Gunakan kata-kata yang memotivasi dan mengevaluasi perkembangan anak secara menyeluruh selama 6 bulan terakhir.</p>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100 gap-2">
                     <a href="{{ route('rapor_asuh.pdf', ['id' => $anak->id, 'semester' => $semester, 'year' => $year]) }}" target="_blank" class="px-5 py-2.5 bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-lg text-sm font-bold transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        Pratinjau PDF
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-pink-600 text-white hover:bg-pink-700 rounded-lg text-sm font-bold transition">
                        Simpan Catatan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>
