<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                {{ __('Verifikasi Donasi Masuk') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Search & Stats --}}
            <div class="mb-6 sm:mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                    <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-yellow-50 rounded-xl flex items-center justify-center text-yellow-600">
                            <i data-lucide="clock" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Menunggu</p>
                            <p class="text-xl sm:text-2xl font-black text-gray-900">{{ $donations->total() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 uppercase text-[10px] font-bold text-gray-400 tracking-widest">
                                <th class="px-8 py-5">Donatur</th>
                                <th class="px-8 py-5">Penerima</th>
                                <th class="px-8 py-5">Nominal</th>
                                <th class="px-8 py-5">Tanggal</th>
                                <th class="px-8 py-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 uppercase text-xs font-bold text-gray-600">
                            @forelse($donations as $donation)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center text-pink-600">
                                                {{ substr($donation->user->name ?? 'U', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-gray-900 font-bold mb-0.5">{{ $donation->user->name ?? 'Unknown' }}</p>
                                                <p class="text-[10px] text-gray-400 font-medium">{{ $donation->order_id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        @if($donation->anakAsuh)
                                            <span class="inline-flex items-center px-3 py-1 bg-pink-50 text-pink-600 rounded-lg">
                                                <i data-lucide="user" class="w-3 h-3 mr-1.5"></i> {{ $donation->anakAsuh->NamaLengkap }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 bg-gray-50 text-gray-500 rounded-lg">
                                                <i data-lucide="globe" class="w-3 h-3 mr-1.5"></i> General
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-5 text-emerald-600">
                                        Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-8 py-5 text-gray-400 font-medium">
                                        {{ $donation->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center justify-center gap-2">
                                            <form action="{{ route('admin.donations.approve', $donation->id) }}" method="POST" onsubmit="return confirm('Konfirmasi bahwa uang telah masuk ke rekening?')">
                                                @csrf
                                                <button type="submit" class="p-2.5 bg-green-500 text-white rounded-xl hover:bg-green-600 transition shadow-sm hover:shadow-md" title="Verifikasi">
                                                    <i data-lucide="check" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.donations.reject', $donation->id) }}" method="POST" onsubmit="return confirm('Tolak donasi ini?')">
                                                @csrf
                                                <button type="submit" class="p-2.5 bg-white border border-gray-200 text-gray-400 rounded-xl hover:text-red-500 hover:border-red-200 transition" title="Tolak">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center text-gray-400">
                                        <i data-lucide="coffee" class="w-12 h-12 mx-auto mb-4 opacity-20"></i>
                                        Belum ada donasi yang perlu diverifikasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($donations->hasPages())
                    <div class="p-8 border-t border-gray-50">
                        {{ $donations->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        lucide.createIcons();
    </script>
    @endpush
</x-app-layout>
