<x-app-layout>
    <x-slot name="header">
        Monitoring Keamanan
    </x-slot>

    <div class="space-y-6">
        <!-- Security Status Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Token Status -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex items-center gap-5">
                <div class="w-14 h-14 bg-pink-50 text-pink-500 rounded-2xl flex items-center justify-center">
                    <i data-lucide="key" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Token API Aktif</p>
                    <h3 class="text-2xl font-black text-gray-800">{{ $activeTokens }}</h3>
                </div>
            </div>

            <!-- Login Activity -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex items-center gap-5">
                <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center">
                    <i data-lucide="shield-check" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Login (24 Jam)</p>
                    <h3 class="text-2xl font-black text-gray-800">{{ $recentLogins }}</h3>
                </div>
            </div>

            <!-- Security Health -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex items-center gap-5">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center">
                    <i data-lucide="activity" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Status Proteksi</p>
                    <div class="flex gap-1.5 mt-1">
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $securityStatus['sanctum'] ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }}">Sanctum</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $securityStatus['headers'] ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }}">Headers</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-600">Throttle</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Log Table -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-black text-gray-800">Log Aktivitas Terbaru</h3>
                    <p class="text-xs text-gray-400 font-bold">Memantau semua tindakan user di dalam sistem.</p>
                </div>
                <form action="{{ route('admin.security.cleanup') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membersihkan log lama (lebih dari 30 hari)?')">
                    @csrf
                    <button type="submit" class="text-xs font-bold text-red-500 bg-red-50 px-4 py-2 rounded-xl hover:bg-red-100 transition-colors flex items-center gap-2">
                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                        Bersihkan Log Lama
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Waktu</th>
                            <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">User</th>
                            <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Aktivitas</th>
                            <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Keterangan</th>
                            <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Alamat IP</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($logs as $log)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="text-xs font-bold text-gray-800">{{ $log->created_at->format('d/m/Y') }}</p>
                                    <p class="text-[10px] text-gray-400">{{ $log->created_at->format('H:i:s') }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    @if($log->user)
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center text-pink-500 text-[10px] font-bold">
                                                {{ substr($log->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-xs font-bold text-gray-800">{{ $log->user->name }}</p>
                                                <p class="text-[10px] text-gray-400 capitalize">{{ $log->user->role }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-400 italic font-bold">Sistem / Anonim</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider
                                        {{ in_array($log->activity_type, ['Login', 'API Login']) ? 'bg-blue-100 text-blue-600' : 
                                           (in_array($log->activity_type, ['Logout', 'API Logout']) ? 'bg-gray-100 text-gray-600' : 
                                           ($log->activity_type == 'Delete' ? 'bg-red-100 text-red-600' : 'bg-purple-100 text-purple-600')) }}">
                                        {{ $log->activity_type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-xs font-bold text-gray-600 max-w-md truncate">{{ $log->description }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-[10px] font-mono font-bold text-gray-400 bg-gray-50 px-2 py-1 rounded-lg inline-block">
                                        {{ $log->ip_address }}
                                    </p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <i data-lucide="search-x" class="w-12 h-12 mb-3"></i>
                                        <p class="text-sm font-bold">Belum ada log aktivitas tercatat.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($logs->hasPages())
                <div class="px-6 py-4 border-t border-gray-50 bg-gray-50/30">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
