<?php

namespace App\Http\Controllers;

use App\Models\PenugasanAsuh;
use App\Models\AnakAsuh;
use App\Models\KakakAsuh;
use Illuminate\Http\Request;

class PenugasanAsuhController extends Controller
{
    public function index(Request $request)
    {
        $query = PenugasanAsuh::with(['anakAsuh', 'kakakAsuh'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('kakakAsuh', function ($q) use ($search) {
                $q->where('NamaLengkap', 'like', '%' . $search . '%');
            })->orWhereHas('anakAsuh', function ($q) use ($search) {
                $q->where('NamaLengkap', 'like', '%' . $search . '%');
            });
        }

        // Grouping by KakakAsuhID to show grouped children per caretaker
        $penugasans = $query->get()->groupBy('KakakAsuhID');

        return view('penugasan_asuh.index', compact('penugasans'));
    }

    public function create()
    {
        // Only children who are NOT yet assigned
        $anakAsuhs = AnakAsuh::doesntHave('penugasan')->get();
        $kakakAsuhs = KakakAsuh::all();
        return view('penugasan_asuh.create', compact('anakAsuhs', 'kakakAsuhs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'AnakAsuhIDs' => 'required|array',
            'AnakAsuhIDs.*' => 'required|exists:anak_asuhs,id',
            'KakakAsuhID' => 'required|exists:kakak_asuhs,KakakAsuhID',
            'TanggalMulai' => 'required|date',
            'TanggalSelesai' => 'nullable|date|after_or_equal:TanggalMulai',
        ]);

        foreach ($validatedData['AnakAsuhIDs'] as $anakAsuhID) {
            PenugasanAsuh::create([
                'AnakAsuhID' => $anakAsuhID,
                'KakakAsuhID' => $validatedData['KakakAsuhID'],
                'TanggalMulai' => $validatedData['TanggalMulai'],
                'TanggalSelesai' => $validatedData['TanggalSelesai'],
            ]);
        }

        return redirect()->route('penugasan_asuh.index')->with('success', 'Penugasan berhasil dibuat.');
    }

    public function edit($id)
    {
        $penugasan = PenugasanAsuh::findOrFail($id);
        $anakAsuhs = AnakAsuh::all();
        $kakakAsuhs = KakakAsuh::all();
        return view('penugasan_asuh.edit', compact('penugasan', 'anakAsuhs', 'kakakAsuhs'));
    }

    public function update(Request $request, $id)
    {
        $penugasan = PenugasanAsuh::findOrFail($id);

        $validatedData = $request->validate([
            'AnakAsuhID' => 'required|exists:anak_asuhs,id',
            'KakakAsuhID' => 'required|exists:kakak_asuhs,KakakAsuhID',
            'TanggalMulai' => 'required|date',
            'TanggalSelesai' => 'nullable|date|after_or_equal:TanggalMulai',
        ]);

        $penugasan->update($validatedData);

        return redirect()->route('penugasan_asuh.index')->with('success', 'Penugasan berhasil diperbarui.');
    }
}
