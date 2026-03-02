<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenyaluranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Penyaluran::with('anakAsuh');

        if ($request->filled('Bulan')) {
            $query->where('Bulan', $request->Bulan);
        }
        if ($request->filled('Tahun')) {
            $query->where('Tahun', $request->Tahun);
        }
        if ($request->filled('search')) {
            $query->whereHas('anakAsuh', function($q) use ($request) {
                $q->where('NamaLengkap', 'like', '%' . $request->search . '%');
            });
        }

        $penyalurans = $query->latest('Tahun')->latest('Bulan')->latest('id')->paginate(15);
        return view('admin.penyaluran.index', compact('penyalurans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anakAsuhs = \App\Models\AnakAsuh::where('Status', 'aktif')->get();
        return view('admin.penyaluran.create', compact('anakAsuhs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'AnakAsuhID' => 'required|exists:anak_asuhs,id',
            'Bulan' => 'required|integer|min:1|max:12',
            'Tahun' => 'required|integer',
            'Nominal' => 'required|numeric|min:0',
            'Keterangan' => 'nullable|string'
        ]);

        // Cek duplikasi
        $exists = \App\Models\Penyaluran::where('AnakAsuhID', $request->AnakAsuhID)
            ->where('Bulan', $request->Bulan)
            ->where('Tahun', $request->Tahun)
            ->first();

        if ($exists) {
            return redirect()->back()->with('error', 'Data penyaluran untuk anak tersebut pada bulan dan tahun ini sudah ada.');
        }

        \App\Models\Penyaluran::create($request->all());

        return redirect()->route('penyaluran.index')
                         ->with('success', 'Data penyaluran berhasil ditambahkan.');
    }

    /**
     * Generate penyaluran bulk for all active anak asuh for a specific month and year.
     */
    public function bulkGenerate(Request $request)
    {
        $request->validate([
            'Bulan' => 'required|integer|min:1|max:12',
            'Tahun' => 'required|integer',
            'NominalDef' => 'required|numeric|min:0'
        ]);

        $activeAnakAsuhs = \App\Models\AnakAsuh::where('Status', 'aktif')->get();
        $count = 0;

        foreach ($activeAnakAsuhs as $anak) {
            $exists = \App\Models\Penyaluran::where('AnakAsuhID', $anak->id)
                ->where('Bulan', $request->Bulan)
                ->where('Tahun', $request->Tahun)
                ->exists();

            if (!$exists) {
                \App\Models\Penyaluran::create([
                    'AnakAsuhID' => $anak->id,
                    'Bulan' => $request->Bulan,
                    'Tahun' => $request->Tahun,
                    'Nominal' => $request->NominalDef,
                    'Keterangan' => 'Generated automatically'
                ]);
                $count++;
            }
        }

        return redirect()->route('penyaluran.index', ['Bulan' => $request->Bulan, 'Tahun' => $request->Tahun])
                         ->with('success', "$count data penyaluran berhasil di-generate untuk bulan {$request->Bulan} / {$request->Tahun}.");
    }

    /**
     * Generate PDF for Tanda Terima
     */
    public function exportPdf(Request $request)
    {
        $request->validate([
            'Bulan' => 'required|integer|min:1|max:12',
            'Tahun' => 'required|integer'
        ]);

        $penyalurans = \App\Models\Penyaluran::with(['anakAsuh', 'anakAsuh.penugasan.kakakAsuh'])
            ->where('Bulan', $request->Bulan)
            ->where('Tahun', $request->Tahun)
            ->get()
            ->sortBy(function($penyaluran) {
                return $penyaluran->anakAsuh->NamaLengkap ?? 'Z';
            });
            
        if($penyalurans->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data penyaluran untuk bulan dan tahun tersebut yang bisa dicetak.');
        }

        $bulanNama = \DateTime::createFromFormat('!m', $request->Bulan)->format('F');
        $judul = "DAFTAR HADIR PENDAMPINGAN BERSAMA BULAN : " . strtoupper($bulanNama) . " " . $request->Tahun;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.tanda_terima_penyaluran', compact('penyalurans', 'judul'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Tanda_Terima_Penyaluran_' . $bulanNama . '_' . $request->Tahun . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $penyaluran = \App\Models\Penyaluran::with('anakAsuh')->findOrFail($id);
        $anakAsuhs = \App\Models\AnakAsuh::where('Status', 'aktif')->get();
        return view('admin.penyaluran.edit', compact('penyaluran', 'anakAsuhs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'AnakAsuhID' => 'required|exists:anak_asuhs,id',
            'Bulan' => 'required|integer|min:1|max:12',
            'Tahun' => 'required|integer',
            'Nominal' => 'required|numeric|min:0',
            'Keterangan' => 'nullable|string'
        ]);

        $penyaluran = \App\Models\Penyaluran::findOrFail($id);
        
        // Cek duplikasi (jika mengganti anak/bulan/tahun namun bentrok dg record lain)
        $exists = \App\Models\Penyaluran::where('AnakAsuhID', $request->AnakAsuhID)
            ->where('Bulan', $request->Bulan)
            ->where('Tahun', $request->Tahun)
            ->where('id', '!=', $id)
            ->first();

        if ($exists) {
            return redirect()->back()->with('error', 'Data penyaluran untuk anak tersebut pada bulan dan tahun terpilih sudah ada.');
        }

        $penyaluran->update($request->all());

        return redirect()->route('penyaluran.index')
                         ->with('success', 'Data penyaluran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penyaluran = \App\Models\Penyaluran::findOrFail($id);
        $penyaluran->delete();

        return redirect()->route('penyaluran.index')
                         ->with('success', 'Data penyaluran berhasil dihapus.');
    }
}
