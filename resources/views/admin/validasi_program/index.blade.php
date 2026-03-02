<x-app-layout>
    <x-slot name="header">
        Validasi Program Relawan
    </x-slot>

    <x-index-header 
        title="Validasi Rencana Program" 
        subtitle="Review dan setujui rencana kerja relawan (Lead Program, Medinfo, dll) serta pantau logbook aktivitas mereka." 
    />

    <!-- Filters -->
    <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border border-gray-200 mb-6 border-l-4 border-l-green-500 flex flex-col xl:flex-row justify-between items-start xl:items-end gap-4 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)]">
        <form action="{{ route('rencana-program.index') }}" method="GET" class="w-full">
            <div class="flex flex-wrap gap-3 items-end w-full">
                <div class="w-48 min-w-[150px]">
                    <label for="kakak_asuh" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Relawan</label>
                    <select name="kakak_asuh" id="kakak_asuh" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm py-2">
                        <option value="">Semua Relawan</option>
                        @foreach($kakakAsuhs as $ka)
                            <option value="{{ $ka->KakakAsuhID }}" {{ request('kakak_asuh') == $ka->KakakAsuhID ? 'selected' : '' }}>
                                {{ $ka->NamaLengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="w-40 min-w-[120px]">
                    <label for="status" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Status</label>
                    <select name="status" id="status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm py-2">
                        <option value="">Semua Status</option>
                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                
                <div class="flex gap-2">
                    <button type="submit" class="bg-green-100 hover:bg-green-200 text-green-700 font-bold py-2 px-4 rounded-lg shadow-sm transition-all duration-200 flex items-center justify-center">
                        Filter
                    </button>
                    @if(request()->anyFilled(['status', 'kakak_asuh']))
                    <a href="{{ route('rencana-program.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-2 px-4 rounded-lg transition-all duration-200">
                        Reset
                    </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
            <span class="block sm:inline font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Program</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Relawan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($programs as $index => $program)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $programs->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">{{ $program->NamaProgram }}</div>
                                <div class="text-xs text-gray-500 truncate max-w-xs">Target: {{ \Carbon\Carbon::parse($program->TargetSelesai)->format('d M Y') }}</div>
                            </td>
                             <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $program->kakakasuh->NamaLengkap }}</div>
                                <div class="text-[10px] uppercase font-bold text-gray-400">ID: {{ $program->KakakAsuhID }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusClass = match($program->Status) {
                                        'Disetujui' => 'bg-green-100 text-green-800',
                                        'Ditolak' => 'bg-red-100 text-red-800',
                                        'Selesai' => 'bg-indigo-100 text-indigo-800',
                                        default => 'bg-yellow-100 text-yellow-800',
                                    };
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ $program->Status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('rencana-program.show', $program->id) }}" class="inline-flex items-center px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition">
                                    {{ $program->Status == 'Menunggu' ? 'Validasi' : 'Pantau' }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500 italic">
                                Tidak ada ajuan program yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $programs->links() }}
        </div>
    </div>
</x-app-layout>
