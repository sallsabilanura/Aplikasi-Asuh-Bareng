<x-app-layout>
    <x-slot name="header">
        Kelola Galeri Asuh
    </x-slot>

    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Galeri Foto Kegiatan</h2>
            <p class="text-sm text-gray-500">Kelola foto dokumentasi yang akan tampil di halaman utama website.</p>
        </div>
        <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm flex items-center gap-2 transition-colors">
            <i data-lucide="upload" class="w-5 h-5"></i>
            Upload Foto Baru
        </button>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Upload Modal -->
    <div id="uploadModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-[90%] max-w-md shadow-lg rounded-xl bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900">Upload Foto Baru</h3>
                <button onclick="document.getElementById('uploadModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Foto (Max 5MB)</label>
                    <input type="file" name="Foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100" required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Caption Singkat (Opsional)</label>
                    <input type="text" name="Caption" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm" placeholder="Ex: Kegiatan belajar anak asuh di Depok...">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('uploadModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-lg font-medium transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-pink-600 text-white hover:bg-pink-700 rounded-lg font-medium transition-colors">Upload</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Gallery Grid -->
    @if($galeri->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i data-lucide="image" class="w-8 h-8 text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-1">Galeri Masih Kosong</h3>
            <p class="text-gray-500">Belum ada foto yang diupload. Silakan upload foto pertama.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($galeri as $item)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden group">
                    <div class="relative h-48 bg-gray-100">
                        <img src="{{ Storage::url($item->FotoPath) }}" alt="Galeri" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100 gap-2">
                            <form action="{{ route('admin.galeri.toggle', $item->GaleriID) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="p-2 {{ $item->IsActive ? 'bg-orange-500 hover:bg-orange-600' : 'bg-green-500 hover:bg-green-600' }} text-white rounded-full transition-colors" title="{{ $item->IsActive ? 'Sembunyikan dari depan' : 'Tampilkan di depan' }}" onclick="return confirm('Ubah status tampilan foto ini?')">
                                    <i data-lucide="{{ $item->IsActive ? 'eye-off' : 'eye' }}" class="w-4 h-4"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.galeri.destroy', $item->GaleriID) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-600 hover:bg-red-700 text-white rounded-full transition-colors" title="Hapus foto" onclick="return confirm('Yakin ingin menghapus foto permanen?')">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                        @if(!$item->IsActive)
                            <div class="absolute top-2 right-2 bg-black bg-opacity-75 text-white text-xs px-2 py-1 rounded">
                                Sembunyi
                            </div>
                        @endif
                    </div>
                    @if($item->Caption)
                        <div class="p-3">
                            <p class="text-sm text-gray-600 truncate" title="{{ $item->Caption }}">{{ $item->Caption }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $galeri->links() }}
        </div>
    @endif
</x-app-layout>
