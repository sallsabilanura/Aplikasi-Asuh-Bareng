<?php

namespace App\Http\Controllers;

use App\Models\AbsensiPendampingan;
use App\Models\AnakAsuh;
use App\Models\KakakAsuh;
use App\Models\PenugasanAsuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class AbsensiPendampinganController extends Controller
{
    public function index(Request $request)
    {
        $query = AbsensiPendampingan::with(['anakAsuh', 'kakakAsuh'])->latest();

        // Role-based restriction & Mentor Filter
        if (Auth::user()->role === 'kakak_asuh') {
            $kakakAsuh = Auth::user()->kakakAsuh;
            if ($kakakAsuh) {
                $query->where('KakakAsuhID', $kakakAsuh->KakakAsuhID);
            }
        }
        elseif ($request->filled('kakak_asuh_id')) {
            $query->where('KakakAsuhID', $request->kakak_asuh_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('anakAsuh', function ($q) use ($search) {
                $q->where('NamaLengkap', 'like', '%' . $search . '%');
            });
        }

        // Date Filters
        if ($request->filled('bulan')) {
            $query->whereMonth('Tanggal', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('Tanggal', $request->tahun);
        }

        $absensis = $query->paginate(10)->withQueryString();
        $kakakAsuhs = KakakAsuh::all();

        return view('absensi_pendampingan.index', compact('absensis', 'kakakAsuhs'));
    }

    public function create()
    {
        $user = Auth::user();
        $kakakAsuh = $user ? $user->kakakAsuh : null;

        if ($user && $user->role === 'kakak_asuh' && $kakakAsuh) {
            // Only children assigned to this mentor
            $anakAsuhs = AnakAsuh::whereHas('penugasan', function ($query) use ($kakakAsuh) {
                $query->where('KakakAsuhID', $kakakAsuh->KakakAsuhID);
            })->get();
        }
        else {
            $anakAsuhs = AnakAsuh::all();
        }

        $kakakAsuhs = KakakAsuh::all();

        return view('absensi_pendampingan.create', compact('anakAsuhs', 'kakakAsuhs', 'kakakAsuh'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'AnakAsuhID' => 'required|exists:anak_asuhs,id',
            'KakakAsuhID' => 'required|exists:kakak_asuhs,KakakAsuhID',
            'JenisPendampingan' => 'required|in:Offline,Online',
            'Tanggal' => 'required|date',
            'WaktuMulai' => 'required',
            'WaktuSelesai' => 'required|after:WaktuMulai',
            'DeskripsiPerkembangan' => 'required',
            'NilaiPendampingan' => 'nullable|integer|between:1,100',
            'Kendala' => 'nullable',
            'FotoBukti' => 'nullable|image|max:2048',
        ]);

        // Automatic Checks
        $month = Carbon::parse($validated['Tanggal'])->month;
        $year = Carbon::parse($validated['Tanggal'])->year;

        $count = AbsensiPendampingan::where('KakakAsuhID', $validated['KakakAsuhID'])
            ->where('JenisPendampingan', $validated['JenisPendampingan'])
            ->whereMonth('Tanggal', $month)
            ->whereYear('Tanggal', $year)
            ->count();

        if ($count >= 2) {
            return back()->withInput()->with('error', "Batas pendampingan {$validated['JenisPendampingan']} bulan ini sudah mencapai 2x.");
        }

        if ($request->hasFile('FotoBukti')) {
            $validated['FotoBukti'] = $request->file('FotoBukti')->store('foto_bukti', 'public');
        }

        // Logic for NilaiHuruf
        if (isset($validated['NilaiPendampingan'])) {
            $nilai = $validated['NilaiPendampingan'];
            if ($nilai >= 85)
                $validated['NilaiHuruf'] = 'A';
            elseif ($nilai >= 70)
                $validated['NilaiHuruf'] = 'B';
            elseif ($nilai >= 55)
                $validated['NilaiHuruf'] = 'C';
            else
                $validated['NilaiHuruf'] = 'D';
        }

        AbsensiPendampingan::create($validated);

        return redirect()->route('absensi_pendampingan.index')->with('success', 'Absensi pendampingan berhasil disimpan.');
    }

    public function show(AbsensiPendampingan $absensi_pendampingan)
    {
        return view('absensi_pendampingan.show', compact('absensi_pendampingan'));
    }

    public function edit(AbsensiPendampingan $absensi_pendampingan)
    {
        $user = Auth::user();
        if ($user && $user->role === 'kakak_asuh') {
            $kakakAsuh = $user->kakakAsuh;
            $anakAsuhs = AnakAsuh::whereHas('penugasan', function ($query) use ($kakakAsuh) {
                $query->where('KakakAsuhID', $kakakAsuh->KakakAsuhID);
            })->get();
        }
        else {
            $anakAsuhs = AnakAsuh::all();
        }
        $kakakAsuhs = KakakAsuh::all();

        return view('absensi_pendampingan.edit', compact('absensi_pendampingan', 'anakAsuhs', 'kakakAsuhs'));
    }

    public function update(Request $request, AbsensiPendampingan $absensi_pendampingan)
    {
        $validated = $request->validate([
            'AnakAsuhID' => 'required|exists:anak_asuhs,id',
            'KakakAsuhID' => 'required|exists:kakak_asuhs,KakakAsuhID',
            'JenisPendampingan' => 'required|in:Offline,Online',
            'Tanggal' => 'required|date',
            'WaktuMulai' => 'required',
            'WaktuSelesai' => 'required|after:WaktuMulai',
            'DeskripsiPerkembangan' => 'required',
            'NilaiPendampingan' => 'nullable|integer|between:1,100',
            'Kendala' => 'nullable',
            'FotoBukti' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('FotoBukti')) {
            $validated['FotoBukti'] = $request->file('FotoBukti')->store('foto_bukti', 'public');
        }

        if (isset($validated['NilaiPendampingan'])) {
            $nilai = $validated['NilaiPendampingan'];
            if ($nilai >= 85)
                $validated['NilaiHuruf'] = 'A';
            elseif ($nilai >= 70)
                $validated['NilaiHuruf'] = 'B';
            elseif ($nilai >= 55)
                $validated['NilaiHuruf'] = 'C';
            else
                $validated['NilaiHuruf'] = 'D';
        }

        $absensi_pendampingan->update($validated);

        return redirect()->route('absensi_pendampingan.index')->with('success', 'Absensi pendampingan berhasil diperbarui.');
    }

    public function destroy(AbsensiPendampingan $absensi_pendampingan)
    {
        $absensi_pendampingan->delete();
        return redirect()->route('absensi_pendampingan.index')->with('success', 'Absensi pendampingan berhasil dihapus.');
    }

    public function exportPDF(Request $request)
    {
        $query = AbsensiPendampingan::with(['anakAsuh', 'kakakAsuh'])->latest();

        // Apply same filters as index
        if (Auth::user()->role === 'kakak_asuh') {
            $kakakAsuh = Auth::user()->kakakAsuh;
            if ($kakakAsuh) {
                $query->where('KakakAsuhID', $kakakAsuh->KakakAsuhID);
            }
        }
        elseif ($request->filled('kakak_asuh_id')) {
            $query->where('KakakAsuhID', $request->kakak_asuh_id);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('Tanggal', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('Tanggal', $request->tahun);
        }

        // Specific child filter (from table row button)
        if ($request->filled('anak_asuh_id')) {
            $query->where('AnakAsuhID', $request->anak_asuh_id);
        }

        $absensis = $query->get();

        // Generate filename
        $filename = 'laporan-absensi';
        if ($request->filled('bulan'))
            $filename .= '-bulan-' . $request->bulan;
        if ($request->filled('tahun'))
            $filename .= '-' . $request->tahun;

        $pdf = Pdf::loadView('absensi_pendampingan.pdf', compact('absensis'));
        return $pdf->download($filename . '.pdf');
    }
}
