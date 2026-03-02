<?php

namespace App\Http\Controllers;

use App\Models\CekKesehatan;
use App\Models\AnakAsuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class CekKesehatanController extends Controller
{
    public function index(Request $request)
    {
        $query = CekKesehatan::with('anakAsuh')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('anakAsuh', function ($q) use ($search) {
                $q->where('NamaLengkap', 'like', '%' . $search . '%');
            });
        }

        $ceks = $query->paginate(10)->withQueryString();
        return view('cek_kesehatan.index', compact('ceks'));
    }

    public function create()
    {
        $today = now()->format('Y-m-d');
        // Only children who DON'T have a health check today
        $anakAsuhs = AnakAsuh::whereDoesntHave('cekKesehatan', function ($query) use ($today) {
            $query->whereDate('TanggalPemeriksaan', $today);
        })->get();
        return view('cek_kesehatan.create', compact('anakAsuhs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'AnakAsuhID' => 'required|exists:anak_asuhs,id',
            'TanggalPemeriksaan' => 'required|date',
            'BeratBadan' => 'required|numeric',
            'TinggiBadan' => 'required|numeric',
            'LingkarKepala' => 'nullable|numeric',
            'IMT' => 'nullable|numeric',
            'StatusGizi' => 'required|string',
            'KesehatanMata' => 'required|string',
            'KesehatanGigi' => 'required|string',
            'Pendengaran' => 'required|string',
            'RiwayatPenyakit' => 'nullable|string',
            'MotorikKasar' => 'required|string',
            'MotorikHalus' => 'required|string',
            'ResponsSensorik' => 'required|string',
            'InteraksiSosial' => 'required|string',
            'FokusKonsentrasi' => 'required|string',
            'EkspresiEmosi' => 'required|string',
            'FrekuensiMakan' => 'required|string',
            'JenisMakanan' => 'required|string',
            'PolaTidur' => 'required|string',
            'WaktuTidur' => 'nullable',
            'WaktuBangun' => 'nullable',
            'KebiasaanTidur' => 'required|string',
            'CatatanPemeriksaan' => 'nullable|string',
            'TandaTanganPemeriksa' => 'nullable|string',
            'Foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('Foto')) {
            $validated['Foto'] = $request->file('Foto')->store('cek_kesehatan', 'public');
        }

        CekKesehatan::create($validated);

        return redirect()->route('cek_kesehatan.index')->with('success', 'Data cek kesehatan berhasil disimpan.');
    }

    public function show(CekKesehatan $cek_kesehatan)
    {
        $cek = $cek_kesehatan;
        return view('cek_kesehatan.show', compact('cek'));
    }

    public function edit(CekKesehatan $cek_kesehatan)
    {
        $cek = $cek_kesehatan;
        $anakAsuhs = AnakAsuh::all();
        return view('cek_kesehatan.edit', compact('cek', 'anakAsuhs'));
    }

    public function update(Request $request, CekKesehatan $cek_kesehatan)
    {
        $cek = $cek_kesehatan;
        $validated = $request->validate([
            'AnakAsuhID' => 'required|exists:anak_asuhs,id',
            'TanggalPemeriksaan' => 'required|date',
            'BeratBadan' => 'required|numeric',
            'TinggiBadan' => 'required|numeric',
            'LingkarKepala' => 'nullable|numeric',
            'IMT' => 'nullable|numeric',
            'StatusGizi' => 'required|string',
            'KesehatanMata' => 'required|string',
            'KesehatanGigi' => 'required|string',
            'Pendengaran' => 'required|string',
            'RiwayatPenyakit' => 'nullable|string',
            'MotorikKasar' => 'required|string',
            'MotorikHalus' => 'required|string',
            'ResponsSensorik' => 'required|string',
            'InteraksiSosial' => 'required|string',
            'FokusKonsentrasi' => 'required|string',
            'EkspresiEmosi' => 'required|string',
            'FrekuensiMakan' => 'required|string',
            'JenisMakanan' => 'required|string',
            'PolaTidur' => 'required|string',
            'WaktuTidur' => 'nullable',
            'WaktuBangun' => 'nullable',
            'KebiasaanTidur' => 'required|string',
            'CatatanPemeriksaan' => 'nullable|string',
            'TandaTanganPemeriksa' => 'nullable|string',
            'Foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('Foto')) {
            if ($cek->Foto) {
                Storage::disk('public')->delete($cek->Foto);
            }
            $validated['Foto'] = $request->file('Foto')->store('cek_kesehatan', 'public');
        }

        $cek->update($validated);

        return redirect()->route('cek_kesehatan.index')->with('success', 'Data cek kesehatan berhasil diperbarui.');
    }

    public function destroy(CekKesehatan $cek_kesehatan)
    {
        $cek = $cek_kesehatan;
        if ($cek->Foto) {
            Storage::disk('public')->delete($cek->Foto);
        }
        $cek->delete();

        return redirect()->route('cek_kesehatan.index')->with('success', 'Data cek kesehatan berhasil dihapus.');
    }

    public function exportPDF(Request $request)
    {
        $query = CekKesehatan::with('anakAsuh')->latest();

        if ($request->has('anak_asuh_id')) {
            $query->where('AnakAsuhID', $request->anak_asuh_id);
            $anakAsuh = AnakAsuh::find($request->anak_asuh_id);
            $ceks = $query->get();
            $pdf = Pdf::loadView('cek_kesehatan.pdf', compact('ceks', 'anakAsuh'));
            return $pdf->download("laporan-kesehatan-{$anakAsuh->NamaLengkap}.pdf");
        }

        $ceks = $query->get();
        $pdf = Pdf::loadView('cek_kesehatan.pdf', compact('ceks'));
        return $pdf->download('laporan-kesehatan-semua.pdf');
    }
}
