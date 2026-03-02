<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GaleriAsuh;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KakakAsuhGaleriController extends Controller
{
    private function checkKakakAsuh()
    {
        if (Auth::user()->role !== 'kakak_asuh') {
            abort(403, 'Unauthorized action.');
        }
    }

    public function index()
    {
        $this->checkKakakAsuh();
        // Kakak Asuh can see all active photos
        $galeri = GaleriAsuh::where('IsActive', true)->latest()->paginate(16);
        return view('kakak_asuh.galeri.index', compact('galeri'));
    }

    public function download($id)
    {
        $this->checkKakakAsuh();
        $galeri = GaleriAsuh::findOrFail($id);

        if (!Storage::disk('public')->exists($galeri->FotoPath)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($galeri->FotoPath);
    }
}
