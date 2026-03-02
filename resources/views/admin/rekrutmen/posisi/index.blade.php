<x-app-layout>
    <x-slot name="header">
        Kelola Posisi Rekrutmen
    </x-slot>

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Posisi Dibutuhkan</h2>
        <p class="text-sm text-gray-500">Tambahkan atau kelola peran / posisi yang sedang dibuka untuk rekrutmen internal.</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form Tambah Posisi -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="font-bold text-gray-800">Tambah Posisi Baru</h3>
                </div>
                <form action="{{ route('admin.rekrutmen.posisi.store') }}" method="POST" class="p-6">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Posisi</label>
                        <input type="text" name="NamaPosisi" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm" placeholder="Contoh: Lead Program" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kuota / Jumlah Kebutuhan</label>
                        <input type="text" name="Kuota" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm" placeholder="Contoh: 1 Orang" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Keterangan / Gambaran Peran (Opsional)</label>
                        <textarea name="KeteranganPeran" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm" placeholder="Jelaskan peran tugas..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-all duration-200">
                        Tambah Posisi
                    </button>
                </form>
            </div>
        </div>

        <!-- Daftar Posisi -->
        <div class="lg:col-span-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="bg-white px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Daftar Posisi</h3>
                    <span class="bg-pink-100 text-pink-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $posisi->count() }} Posisi</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Posisi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kuota</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($posisi->isEmpty())
                                <tr>
                                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center italic">
                                        Belum ada posisi yang ditambahkan.
                                    </td>
                                </tr>
                            @else
                                @foreach ($posisi as $pos)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-l-4 border-l-pink-500">
                                        {{ $pos->NamaPosisi }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $pos->Kuota }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($pos->IsActive)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Dibuka
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Selesai / Ditutup
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            <form action="{{ route('admin.rekrutmen.posisi.toggle', $pos->PosisiID) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="{{ $pos->IsActive ? 'text-orange-600 hover:text-orange-900 bg-orange-50 hover:bg-orange-100' : 'text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100' }} px-2 py-1 rounded-md transition-colors text-xs" onclick="return confirm('Yakin ingin mengubah status posisi ini?')">
                                                    {{ $pos->IsActive ? 'Tutup Posisi' : 'Buka Posisi' }}
                                                </button>
                                            </form>
                                            <a href="{{ route('admin.rekrutmen.posisi.edit', $pos->PosisiID) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-2 py-1 rounded-md transition-colors text-xs">Edit</a>
                                            <form action="{{ route('admin.rekrutmen.posisi.destroy', $pos->PosisiID) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-2 py-1 rounded-md transition-colors text-xs" onclick="return confirm('Yakin ingin menghapus posisi ini?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
