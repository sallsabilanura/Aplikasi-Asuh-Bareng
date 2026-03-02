<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GaleriAsuh;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminGaleriController extends Controller
{
    private function checkAdmin()
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized action.');
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $galeri = GaleriAsuh::latest()->paginate(12);
        return view('admin.galeri.index', compact('galeri'));
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'Foto' => 'required|image|max:5120', // Max 5MB
            'Caption' => 'nullable|string|max:255',
        ]);

        $path = $request->file('Foto')->store('galeri', 'public');

        GaleriAsuh::create([
            'FotoPath' => $path,
            'Caption' => $request->Caption,
            'IsActive' => true,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil ditambahkan ke galeri.');
    }

    public function destroy($id)
    {
        $this->checkAdmin();
        $galeri = GaleriAsuh::findOrFail($id);

        if (Storage::disk('public')->exists($galeri->FotoPath)) {
            Storage::disk('public')->delete($galeri->FotoPath);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $this->checkAdmin();
        $galeri = GaleriAsuh::findOrFail($id);
        $galeri->IsActive = !$galeri->IsActive;
        $galeri->save();

        $status = $galeri->IsActive ? 'ditampilkan' : 'disembunyikan';
        return redirect()->route('admin.galeri.index')->with('success', "Foto berhasil $status di halaman depan.");
    }
}
