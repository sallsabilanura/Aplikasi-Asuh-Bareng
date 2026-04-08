<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 leading-tight">
            {{ __('Dashboard Donatur') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Welcome & Stats Section --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 mb-8 sm:mb-12">
                {{-- Welcome Card --}}
                <div class="md:col-span-2 bg-pink-600 rounded-2xl sm:rounded-3xl p-6 sm:p-10 text-white shadow-xl shadow-pink-100 relative overflow-hidden group">
                    <div class="relative z-10 text-center md:text-left">
                        <h3 class="text-2xl sm:text-3xl font-bold mb-3 sm:mb-4">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-pink-50 text-base sm:text-xl max-w-md mb-6 sm:mb-8 mx-auto md:mx-0">Terima kasih telah menjadi bagian dari keluarga besar AsuhBareng.</p>
                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center md:justify-start">
                            <a href="{{ route('donor.anak_asuh.index') }}" class="inline-flex items-center justify-center px-6 py-3.5 bg-white text-pink-600 rounded-xl sm:rounded-2xl font-bold text-sm hover:bg-pink-50 transition-all shadow-lg">
                                Lihat Anak Asuh
                                <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                            </a>
                            <a href="{{ route('donor.donasi') }}" class="inline-flex items-center justify-center px-6 py-3.5 bg-pink-700 text-white rounded-xl sm:rounded-2xl font-bold text-sm hover:bg-pink-800 transition-all border border-pink-500">
                                <i data-lucide="plus-circle" class="w-4 h-4 mr-2"></i>
                                Donasi Baru
                            </a>
                        </div>
                    </div>
                    {{-- Decorative Icon --}}
                    <div class="absolute -bottom-10 -right-10 opacity-20 group-hover:scale-110 transition-transform duration-700">
                        <i data-lucide="heart" class="w-64 h-64 text-pink-400"></i>
                    </div>
                </div>

                <div class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-10 shadow-sm border border-gray-100 flex flex-col justify-center text-center md:text-left">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-pink-50 rounded-xl sm:rounded-2xl flex items-center justify-center text-pink-600 mb-4 sm:mb-6 mx-auto md:mx-0">
                        <i data-lucide="wallet" class="w-6 h-6 sm:w-8 sm:h-8"></i>
                    </div>
                    <p class="text-gray-400 font-bold uppercase tracking-wider text-[10px] sm:text-xs mb-1 sm:mb-2">Total Donasi Anda</p>
                    <h4 class="text-3xl sm:text-4xl font-black text-gray-900">Rp {{ number_format($totalDonation, 0, ',', '.') }}</h4>
                </div>
            </div>

            {{-- History Section --}}
            <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-10">
                <div class="flex items-center justify-between mb-8 sm:mb-10">
                    <h3 class="text-xl sm:text-2xl font-black text-gray-900 flex items-center">
                        <i data-lucide="history" class="w-6 h-6 sm:w-8 sm:h-8 mr-3 sm:mr-4 text-pink-600"></i>
                        Riwayat Donasi
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 font-bold text-xs uppercase tracking-widest border-b border-gray-50">
                                <th class="pb-6 pl-4">Order ID & Metode</th>
                                <th class="pb-6">Untuk</th>
                                <th class="pb-6">Nominal</th>
                                <th class="pb-6">Status</th>
                                <th class="pb-6 pr-4">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($donations as $donation)
                                <tr class="group hover:bg-gray-50 transition-colors">
                                    <td class="py-6 pl-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 border border-gray-100 group-hover:bg-white transition-colors">
                                                <i data-lucide="credit-card" class="w-5 h-5"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900 uppercase text-xs">#{{ $donation->order_id }}</p>
                                                <p class="text-xs text-gray-400">{{ $donation->payment_type ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-6">
                                        @if($donation->anakAsuh)
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-lg overflow-hidden border border-gray-100">
                                                    @if($donation->anakAsuh->FotoAnak)
                                                        <img src="{{ asset('storage/' . $donation->anakAsuh->FotoAnak) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full bg-pink-50 text-pink-200 flex items-center justify-center">
                                                            <i data-lucide="user" class="w-4 h-4"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <span class="font-bold text-gray-700 text-sm">{{ $donation->anakAsuh->NamaLengkap }}</span>
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-sm font-medium italic">Donasi Umum</span>
                                        @endif
                                    </td>
                                    <td class="py-6 font-black text-gray-900">
                                        Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="py-6">
                                        @if($donation->status === 'success')
                                            <span class="px-4 py-1.5 bg-green-50 text-green-600 rounded-full text-[11px] font-black uppercase tracking-wider border border-green-100">Berhasil</span>
                                        @elseif($donation->status === 'pending')
                                            <span class="px-4 py-1.5 bg-yellow-50 text-yellow-600 rounded-full text-[11px] font-black uppercase tracking-wider border border-yellow-100">Pending</span>
                                        @else
                                            <span class="px-4 py-1.5 bg-red-50 text-red-600 rounded-full text-[11px] font-black uppercase tracking-wider border border-red-100">Gagal</span>
                                        @endif
                                    </td>
                                    <td class="py-6 pr-4 text-sm text-gray-500 font-medium">
                                        {{ $donation->created_at->format('d M Y, H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-20 text-center">
                                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-200 border border-dashed border-gray-200">
                                            <i data-lucide="inbox" class="w-10 h-10"></i>
                                        </div>
                                        <p class="text-gray-400 font-medium">Belum ada riwayat donasi.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        lucide.createIcons();
    </script>
    @endpush
</x-app-layout>
