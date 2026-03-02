<x-app-layout>
    <x-slot name="header">
        Detail Program & Logbook
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <!-- Breadcrumb -->
        <nav class="flex mb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('rencana-program.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-pink-600">
                        Rencana Program
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-bold text-gray-500 md:ml-2">Detail & Logbook</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Sidebar: Program Info -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                             @php
                                $statusClass = match($program->Status) {
                                    'Disetujui' => 'bg-green-100 text-green-800',
                                    'Ditolak' => 'bg-red-100 text-red-800',
                                    'Selesai' => 'bg-indigo-100 text-indigo-800',
                                    default => 'bg-yellow-100 text-yellow-800',
                                };
                            @endphp
                            <span class="px-3 py-1 text-xs font-bold rounded-full {{ $statusClass }}">
                                {{ $program->Status }}
                            </span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $program->NamaProgram }}</h2>
                        <div class="text-sm text-gray-600 leading-relaxed mb-6">
                            {{ $program->Deskripsi }}
                        </div>
                        
                        <div class="space-y-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Target: {{ \Carbon\Carbon::parse($program->TargetSelesai)->format('d M Y') }}
                            </div>
                             <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Relawan: {{ $program->kakakasuh->NamaLengkap }}
                            </div>
                        </div>

                        @if($program->KomentarAdmin)
                        <div class="mt-6 p-4 bg-red-50 rounded-lg border border-red-100">
                            <h4 class="text-xs font-bold text-red-800 uppercase tracking-wider mb-1">Catatan Admin:</h4>
                            <p class="text-sm text-red-700 italic">"{{ $program->KomentarAdmin }}"</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main Content: Logbook -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Logbook Form (Only if Approved) -->
                @if($program->Status == 'Disetujui')
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" x-data="{ openForm: false }">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-900">Logbook Aktivitas</h3>
                            <button @click="openForm = !openForm" class="bg-pink-600 text-white text-sm font-bold px-4 py-2 rounded-lg hover:bg-pink-700 transition">
                                <span x-show="!openForm">+ Tambah Logbook</span>
                                <span x-show="openForm">Tutup Form</span>
                            </button>
                        </div>

                        <div x-show="openForm" x-transition class="mt-4 pt-4 border-t border-gray-100 bg-gray-50 p-4 rounded-xl">
                            <form action="{{ route('logbook-relawan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="RencanaProgramID" value="{{ $program->id }}">
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Tanggal <span class="text-red-500">*</span></label>
                                        <input type="date" name="TanggalAktivitas" value="{{ date('Y-m-d') }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Judul Aktivitas <span class="text-red-500">*</span></label>
                                        <input type="text" name="NamaAktivitas" required placeholder="Contoh: Rapat koordinasi kurikulum" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi Hasil <span class="text-red-500">*</span></label>
                                    <textarea name="DeskripsiHasil" rows="3" required placeholder="Apa saja yang dikerjakan dan hasilnya?" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm"></textarea>
                                </div>

                                <div class="mb-6">
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Bukti Aktivitas (Foto/PDF)</label>
                                    <input type="file" name="FileBukti" accept="image/*,application/pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                                    <p class="text-[10px] text-gray-400 mt-1">Maks 5MB. Format: JPG, PNG, PDF.</p>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="bg-pink-600 text-white font-bold px-6 py-2.5 rounded-lg hover:bg-pink-700 transition shadow-sm">Simpan Kegiatan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg flex items-center">
                    <svg class="w-5 h-5 text-yellow-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <p class="text-sm text-yellow-700">Logbook hanya bisa diisi jika status rencana program sudah <strong>Disetujui</strong> oleh Admin.</p>
                </div>
                @endif

                <!-- Logbook History -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-gray-900 border-b border-gray-200 pb-2">Riwayat Progress</h3>
                    
                    @forelse($program->logbooks as $log)
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 relative group transition hover:border-pink-300">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="text-center bg-gray-100 rounded-lg p-2 min-w-[60px]">
                                    <span class="block text-xs font-bold text-gray-500 uppercase">{{ \Carbon\Carbon::parse($log->TanggalAktivitas)->format('M') }}</span>
                                    <span class="block text-lg font-black text-gray-900 leading-none">{{ \Carbon\Carbon::parse($log->TanggalAktivitas)->format('d') }}</span>
                                </div>
                                <div>
                                    <h4 class="text-base font-bold text-gray-900">{{ $log->NamaAktivitas }}</h4>
                                    @php
                                        $validStatusClass = match($log->StatusValidasi) {
                                            'Disetujui' => 'text-green-600',
                                            'Revisi' => 'text-red-600',
                                            default => 'text-gray-400',
                                        };
                                    @endphp
                                    <span class="text-[10px] font-bold uppercase tracking-wider {{ $validStatusClass }}">
                                        &bull; {{ $log->StatusValidasi == 'Disetujui' ? 'Disetujui Admin' : $log->StatusValidasi }}
                                    </span>
                                </div>
                            </div>
                            
                            @if($log->StatusValidasi == 'Belum Diperiksa' && Auth::id() == $program->kakakasuh->user_id)
                            <form action="{{ route('logbook-relawan.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Hapus logbook ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-red-500 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                            @endif
                        </div>

                        <p class="text-sm text-gray-600 mb-4 whitespace-pre-line">{{ $log->DeskripsiHasil }}</p>

                        <div class="flex items-center justify-between mt-auto pt-3 border-t border-gray-50">
                            @if($log->FileBukti)
                            <a href="{{ asset('storage/' . $log->FileBukti) }}" target="_blank" class="flex items-center text-xs font-bold text-pink-600 hover:text-pink-800 bg-pink-50 px-3 py-1.5 rounded-lg transition">
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                Lihat Bukti
                            </a>
                            @else
                            <span class="text-[10px] text-gray-400 italic">Tanpa Bukti File</span>
                            @endif

                            @if($log->KomentarAdmin)
                            <div class="text-[11px] bg-yellow-50 px-2 py-1 rounded text-yellow-700 italic border border-yellow-100">
                                Feedback: {{ $log->KomentarAdmin }}
                            </div>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="bg-gray-50 rounded-xl p-8 text-center border-2 border-dashed border-gray-200">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        <p class="text-sm text-gray-500 italic">Belum ada progres yang dicatat. Mulai catat progres pertama Anda!</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
