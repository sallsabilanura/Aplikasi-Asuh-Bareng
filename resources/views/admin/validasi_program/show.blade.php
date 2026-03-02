<x-app-layout>
    <x-slot name="header">
        Validasi Program & Logbook
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <!-- Breadcrumb -->
        <nav class="flex mb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('rencana-program.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600">
                        Validasi Program
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-bold text-gray-500 md:ml-2">Review Program</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Program Info & Approval Form -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $program->NamaProgram }}</h2>
                        <p class="text-sm text-gray-600 leading-relaxed mb-6">{{ $program->Deskripsi }}</p>
                        
                        <div class="space-y-3 pt-4 border-t border-gray-100 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Relawan:</span>
                                <span class="font-bold text-gray-900">{{ $program->kakakasuh->NamaLengkap }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Target Selesai:</span>
                                <span class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($program->TargetSelesai)->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Status Saat Ini:</span>
                                <span class="px-2 py-0.5 text-xs font-bold rounded-full 
                                    {{ $program->Status == 'Disetujui' ? 'bg-green-100 text-green-800' : ($program->Status == 'Ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $program->Status }}
                                </span>
                            </div>
                        </div>

                        <!-- Approval Form -->
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                            <h3 class="text-sm font-bold text-gray-900 mb-3">Tindakan Admin</h3>
                            <form action="{{ route('rencana-program.update_status', $program->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Set Status</label>
                                    <select name="Status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm py-2">
                                        <option value="Menunggu" {{ $program->Status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="Disetujui" {{ $program->Status == 'Disetujui' ? 'selected' : '' }}>Setujui</option>
                                        <option value="Ditolak" {{ $program->Status == 'Ditolak' ? 'selected' : '' }}>Tolak / Revisi</option>
                                        <option value="Selesai" {{ $program->Status == 'Selesai' ? 'selected' : '' }}>Program Selesai</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Komentar / Feedback</label>
                                    <textarea name="KomentarAdmin" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" placeholder="Berikan alasan atau catatan..."></textarea>
                                </div>
                                <button type="submit" class="w-full bg-green-600 text-white font-bold py-2 rounded-lg hover:bg-green-700 transition shadow-sm">
                                    Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logbooks Comparison -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-900">Monitoring Logbook</h3>
                        <span class="text-sm text-gray-500">{{ $program->logbooks->count() }} Laporan Masuk</span>
                    </div>
                    
                    <div class="divide-y divide-gray-100">
                        @forelse($program->logbooks as $log)
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="text-center bg-gray-100 rounded-lg p-2 min-w-[50px]">
                                        <span class="block text-[10px] font-bold text-gray-500 uppercase">{{ \Carbon\Carbon::parse($log->TanggalAktivitas)->format('M') }}</span>
                                        <span class="block text-base font-black text-gray-900 leading-none">{{ \Carbon\Carbon::parse($log->TanggalAktivitas)->format('d') }}</span>
                                    </div>
                                    <div>
                                        <h4 class="text-base font-bold text-gray-900">{{ $log->NamaAktivitas }}</h4>
                                        <span class="text-[10px] font-bold uppercase tracking-widest 
                                            {{ $log->StatusValidasi == 'Disetujui' ? 'text-green-600' : ($log->StatusValidasi == 'Revisi' ? 'text-red-500' : 'text-gray-400') }}">
                                            &bull; {{ $log->StatusValidasi }}
                                        </span>
                                    </div>
                                </div>
                                
                                @if($log->FileBukti)
                                <a href="{{ asset('storage/' . $log->FileBukti) }}" target="_blank" class="text-green-600 hover:text-green-800 bg-green-50 px-3 py-1.5 rounded-lg text-xs font-bold">
                                    Lihat Bukti
                                </a>
                                @endif
                            </div>

                            <p class="text-sm text-gray-600 mb-4 whitespace-pre-line">{{ $log->DeskripsiHasil }}</p>

                            <!-- Inline Validation for Logbook -->
                            <form action="{{ route('logbook-relawan.validate', $log->id) }}" method="POST" class="mt-4 p-4 bg-gray-50 rounded-lg flex flex-wrap gap-4 items-end border border-gray-200">
                                @csrf
                                <div class="flex-1 min-w-[200px]">
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Review Log</label>
                                    <input type="text" name="KomentarAdmin" value="{{ $log->KomentarAdmin }}" placeholder="Catatan untuk relawan..." class="w-full rounded border-gray-300 text-xs py-1.5 shadow-sm focus:border-green-500">
                                </div>
                                <div class="flex gap-2">
                                    <button type="submit" name="StatusValidasi" value="Disetujui" class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1.5 rounded hover:bg-green-200 transition">
                                        Setujui
                                    </button>
                                    <button type="submit" name="StatusValidasi" value="Revisi" class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1.5 rounded hover:bg-red-200 transition">
                                        Revisi
                                    </button>
                                </div>
                            </form>
                        </div>
                        @empty
                        <div class="px-6 py-12 text-center">
                            <svg class="w-12 h-12 text-gray-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            <p class="text-sm text-gray-400 italic">Belum ada progres logbook yang dikirimkan oleh relawan.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
