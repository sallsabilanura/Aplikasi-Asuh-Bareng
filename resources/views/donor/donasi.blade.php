<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                    <a href="{{ route('donor.dashboard') }}" class="hover:text-pink-600 transition-colors">Dashboard</a>
                    <i data-lucide="chevron-right" class="w-3 h-3"></i>
                    <span class="text-gray-900 font-medium">Proses Donasi</span>
                </div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    {{ __('Donasi Asuh Bareng') }}
                </h2>
            </div>
            <div>
                @if($anakAsuh)
                    <a href="{{ route('donor.anak_asuh.show', $anakAsuh->id) }}" class="inline-flex items-center px-6 py-3 bg-white border border-gray-200 rounded-2xl font-bold text-sm text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-all shadow-sm">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                        Kembali
                    </a>
                @else
                    <a href="{{ route('donor.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-white border border-gray-200 rounded-2xl font-bold text-sm text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-all shadow-sm">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                        Kembali
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-[#fafafa]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 overflow-hidden min-h-[450px] sm:min-h-[500px] flex flex-col">
                {{-- Progress Bar --}}
                <div class="flex border-b border-gray-50">
                    <div id="progress-1" class="flex-1 py-4 text-center text-xs font-bold uppercase tracking-widest border-b-2 border-pink-500 text-pink-600 transition-all duration-300">
                        1. Pilih Nominal
                    </div>
                    <div id="progress-2" class="flex-1 py-4 text-center text-xs font-bold uppercase tracking-widest border-b-2 border-transparent text-gray-300 transition-all duration-300">
                        2. Bayar QRIS
                    </div>
                </div>

                <div class="p-6 md:p-12 flex-1 flex flex-col justify-center">
                    <form id="donation-form" action="{{ route('donor.donasi.process') }}" method="POST">
                        @csrf
                        @if($anakAsuh)
                            <input type="hidden" name="anak_asuh_id" value="{{ $anakAsuh->id }}">
                        @endif

                        {{-- Step 1: Amount Selection --}}
                        <div id="step-1" class="space-y-8 animate-fade-in">
                            <div class="text-center mb-8">
                                <h1 class="text-2xl font-bold text-gray-900 mb-2">Berapa besar donasi Anda?</h1>
                                <p class="text-gray-500 text-sm">Pilih nominal atau masukkan jumlah kustom.</p>
                            </div>

                            @if($anakAsuh)
                                <div class="p-4 bg-pink-50 rounded-2xl border border-pink-100 flex items-center gap-4 mb-6">
                                    <div class="w-12 h-12 rounded-xl overflow-hidden shadow-sm border-2 border-white">
                                        @if($anakAsuh->FotoAnak)
                                            <img src="{{ asset('storage/' . $anakAsuh->FotoAnak) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-pink-200 flex items-center justify-center text-pink-400">
                                                <i data-lucide="user" class="w-6 h-6"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-[9px] text-pink-600 font-bold uppercase tracking-widest">Donasi Untuk</p>
                                        <h4 class="text-sm font-bold text-gray-900">{{ $anakAsuh->NamaLengkap }}</h4>
                                    </div>
                                </div>
                            @endif

                            <div>
                                <div class="grid grid-cols-2 gap-3 mb-6">
                                    <button type="button" onclick="setAmount(50000)" class="nominal-btn py-4 px-4 bg-white border border-gray-200 rounded-xl font-bold text-gray-600 hover:border-pink-500 hover:text-pink-600 transition-all shadow-sm">Rp 50rb</button>
                                    <button type="button" onclick="setAmount(100000)" class="nominal-btn py-4 px-4 bg-white border border-gray-200 rounded-xl font-bold text-gray-600 hover:border-pink-500 hover:text-pink-600 transition-all shadow-sm">Rp 100rb</button>
                                    <button type="button" onclick="setAmount(250000)" class="nominal-btn py-4 px-4 bg-white border border-gray-200 rounded-xl font-bold text-gray-600 hover:border-pink-500 hover:text-pink-600 transition-all shadow-sm">Rp 250rb</button>
                                    <button type="button" onclick="setAmount(500000)" class="nominal-btn py-4 px-4 bg-white border border-gray-200 rounded-xl font-bold text-gray-600 hover:border-pink-500 hover:text-pink-600 transition-all shadow-sm">Rp 500rb</button>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 font-bold">Rp</div>
                                    <input type="number" id="amount" name="amount" required min="10000" class="block w-full pl-12 pr-4 py-4 bg-gray-50 border-gray-200 rounded-xl text-lg font-bold focus:ring-pink-500 focus:border-pink-500 transition-all" placeholder="Minimal 10.000">
                                </div>
                            </div>

                            <div class="pt-6">
                                <button type="button" onclick="nextStep()" class="w-full inline-flex items-center justify-center px-8 py-4 bg-pink-600 text-white rounded-2xl font-extrabold text-lg hover:bg-pink-700 transition shadow-lg shadow-pink-100 group">
                                    Lanjut ke Pembayaran
                                    <i data-lucide="arrow-right" class="w-5 h-5 ml-3 group-hover:translate-x-1 transition"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Step 2: Payment (Hidden Initially) --}}
                        <div id="step-2" class="hidden space-y-8 animate-fade-in">
                            <div class="text-center mb-8">
                                <h1 class="text-2xl font-bold text-gray-900 mb-2">Selesaikan Pembayaran</h1>
                                <p class="text-gray-500 text-sm">Scan QRIS di bawah ini dengan aplikasi favoritmu.</p>
                            </div>

                            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 flex flex-col items-center">
                                <div class="mb-4 text-center">
                                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-1">Nominal Donasi</p>
                                    <h2 id="final-amount" class="text-3xl font-black text-pink-600">Rp 0</h2>
                                </div>
                                <div class="w-56 h-56 bg-white p-3 rounded-2xl shadow-sm border border-gray-200 mb-6 group cursor-zoom-in">
                                    <img src="{{ asset('qris.jpeg') }}" class="w-full h-full object-contain transition-transform group-hover:scale-105">
                                </div>
                                <div class="text-center space-y-1">
                                    <p class="text-xs font-bold text-gray-900 uppercase tracking-widest">ASUH BARENG ZAKAT SUKSES</p>
                                    <p class="text-[10px] text-gray-400 italic">Mendukung GoPay, OVO, ShopeePay, Dana, LinkAja, & Mobile Banking</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <button type="submit" class="w-full inline-flex items-center justify-center px-8 py-5 bg-pink-600 text-white rounded-2xl font-extrabold text-lg hover:bg-pink-700 transition shadow-xl shadow-pink-200 group">
                                    <i data-lucide="check-circle" class="w-5 h-5 mr-3"></i>
                                    Konfirmasi Sudah Transfer
                                </button>
                                <button type="button" onclick="prevStep()" class="w-full text-center text-sm font-bold text-gray-400 hover:text-pink-600 transition-colors">
                                    Kembali & Ubah Nominal
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        lucide.createIcons();

        function setAmount(val) {
            const input = document.getElementById('amount');
            input.value = val;
            updateButtons(val);
        }

        function updateButtons(val) {
            document.querySelectorAll('.nominal-btn').forEach(btn => {
                btn.classList.remove('border-pink-500', 'text-pink-600', 'bg-pink-50', 'ring-2', 'ring-pink-100');
                if (btn.innerText.includes(val.toLocaleString('id-ID').replace(',00', '').replace(/\.000$/, 'rb').replace('000', 'rb'))) {
                    btn.classList.add('border-pink-500', 'text-pink-600', 'bg-pink-50', 'ring-2', 'ring-pink-100');
                }
            });
        }

        // Listen to manual input
        document.getElementById('amount').addEventListener('input', function(e) {
            updateButtons(parseInt(e.target.value) || 0);
        });

        function nextStep() {
            const amount = document.getElementById('amount').value;
            if (!amount || amount < 10000) {
                alert('Silakan pilih atau masukkan nominal minimal Rp 10.000');
                return;
            }

            // Update summary in step 2
            document.getElementById('final-amount').innerText = 'Rp ' + parseInt(amount).toLocaleString('id-ID');

            // Toggle visibility
            document.getElementById('step-1').classList.add('hidden');
            document.getElementById('step-2').classList.remove('hidden');

            // Update Progress
            document.getElementById('progress-1').classList.replace('border-pink-500', 'border-transparent');
            document.getElementById('progress-1').classList.replace('text-pink-600', 'text-gray-400');
            document.getElementById('progress-2').classList.replace('border-transparent', 'border-pink-500');
            document.getElementById('progress-2').classList.replace('text-gray-300', 'text-pink-600');
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function prevStep() {
            // Toggle visibility
            document.getElementById('step-2').classList.add('hidden');
            document.getElementById('step-1').classList.remove('hidden');

            // Update Progress
            document.getElementById('progress-2').classList.replace('border-pink-500', 'border-transparent');
            document.getElementById('progress-2').classList.replace('text-pink-600', 'text-gray-300');
            document.getElementById('progress-1').classList.replace('border-transparent', 'border-pink-500');
            document.getElementById('progress-1').classList.replace('text-gray-400', 'text-pink-600');
        }
    </script>
    <style>
        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @endpush
</x-app-layout>
