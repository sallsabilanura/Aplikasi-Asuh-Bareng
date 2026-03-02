<x-app-layout>
    <x-slot name="header">
        Edit Profil
    </x-slot>

    <div class="max-w-2xl mx-auto py-10 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf

                <div class="flex flex-col items-center mb-8 pb-8 border-b border-gray-100">
                    <div class="relative group mb-4">
                        @php
                            $currentAvatar = null;
                            if ($user->kakakAsuh && $user->kakakAsuh->Foto) {
                                $currentAvatar = $user->kakakAsuh->Foto;
                            } elseif ($user->avatar) {
                                $currentAvatar = $user->avatar;
                            }
                        @endphp

                        @if($currentAvatar)
                            <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-pink-100 shadow-xl">
                                <img id="avatar-preview" src="{{ asset('storage/' . $currentAvatar) }}" alt="Avatar" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div id="avatar-placeholder" class="w-16 h-16 rounded-full bg-pink-50 flex items-center justify-center border-4 border-pink-100 shadow-lg">
                                <span class="text-pink-300 text-2xl uppercase font-bold">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                            <div id="avatar-preview-container" class="hidden w-16 h-16 rounded-full overflow-hidden border-4 border-pink-100 shadow-xl">
                                <img id="avatar-preview" src="#" alt="Avatar Preview" class="w-full h-full object-cover">
                            </div>
                        @endif
                        
                        <label for="avatar" class="absolute -bottom-1 -right-1 bg-pink-600 p-1.5 rounded-full text-white cursor-pointer hover:bg-pink-700 transition shadow-lg">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </label>
                    </div>

                    <div class="text-center">
                        <label for="avatar" class="inline-flex items-center px-3 py-1.5 bg-white border border-pink-300 rounded-md font-semibold text-xs text-pink-700 uppercase tracking-widest shadow-sm hover:text-pink-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 cursor-pointer">
                            Pilih Foto Baru
                        </label>
                    </div>

                    <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*" onchange="previewImage(event)">
                    
                    @error('avatar')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <script>
                    function previewImage(event) {
                        const reader = new FileReader();
                        reader.onload = function(){
                            const output = document.getElementById('avatar-preview');
                            const placeholder = document.getElementById('avatar-placeholder');
                            const previewContainer = document.getElementById('avatar-preview-container');
                            
                            if (output && previewContainer) {
                                output.src = reader.result;
                                if (placeholder) placeholder.classList.add('hidden');
                                previewContainer.classList.remove('hidden');
                            }
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    }
                </script>

                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition duration-150 ease-in-out border p-2" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition duration-150 ease-in-out border p-2" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-500 mb-3 italic">Kosongkan jika tidak ingin mengubah kata sandi.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru</label>
                                <input type="password" name="password" id="password" 
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition duration-150 ease-in-out border p-2">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition duration-150 ease-in-out border p-2">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center pt-6 pb-2">
                    <button type="submit" 
                            class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition-all duration-200 text-base">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>