<x-app-layout>
    <x-slot name="header">
        Detail Absensi Pendampingan
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('absensi_pendampingan.index') }}" class="text-blue-600 hover:underline flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
        <div class="flex space-x-3">
            <a href="{{ route('absensi_pendampingan.edit', $absensi_pendampingan->AbsensiID) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm">
                Edit Data
            </a>
        </div>
    </div>

    <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 overflow-hidden">
        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-4">
                <div>
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Informasi Dasar</h4>
                    <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                        <p><span class="font-medium text-gray-700">Anak Asuh:</span> {{ $absensi_pendampingan->anakAsuh->NamaLengkap ?? 'N/A' }}</p>
                        <p><span class="font-medium text-gray-700">Kakak Asuh:</span> {{ $absensi_pendampingan->kakakAsuh->NamaLengkap ?? 'N/A' }}</p>
                        <p><span class="font-medium text-gray-700">Jenis:</span> {{ $absensi_pendampingan->JenisPendampingan }}</p>
                        <p><span class="font-medium text-gray-700">Tanggal:</span> {{ $absensi_pendampingan->Tanggal }}</p>
                        <p><span class="font-medium text-gray-700">Waktu:</span> {{ $absensi_pendampingan->WaktuMulai }} - {{ $absensi_pendampingan->WaktuSelesai }}</p>
                    </div>
                </div>

                <div>
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Penilaian</h4>
                    <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                        <p><span class="font-medium text-gray-700">Nilai:</span> <span class="text-lg font-bold text-blue-600">{{ $absensi_pendampingan->NilaiPendampingan }}</span> ({{ $absensi_pendampingan->NilaiHuruf }})</p>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Keterangan</h4>
                    <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                        <div>
                            <p class="font-medium text-gray-700 border-b border-gray-200 pb-1 mb-1">Deskripsi Perkembangan:</p>
                            <p class="text-gray-800 italic">{{ $absensi_pendampingan->DeskripsiPerkembangan }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-700 border-b border-gray-200 pb-1 mb-1">Kendala:</p>
                            <p class="text-gray-800 italic">{{ $absensi_pendampingan->Kendala ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                @if($absensi_pendampingan->FotoBukti)
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Foto Bukti</h4>
                        <img src="{{ asset('storage/' . $absensi_pendampingan->FotoBukti) }}" class="rounded-lg border border-gray-200 w-full shadow-sm">
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
