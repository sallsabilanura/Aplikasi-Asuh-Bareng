<?php

namespace App\Http\Controllers;

use App\Models\AnakAsuh;
use Illuminate\Http\Request;
use App\Imports\AnakAsuhImport;
use App\Exports\AnakAsuhExport;
use Maatwebsite\Excel\Facades\Excel;

class AnakAsuhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = AnakAsuh::query();

        if ($request->filled('search')) {
            $query->where('NamaLengkap', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('umur')) {
            $age = $request->umur;
            $startDate = now()->subYears($age + 1)->addDay()->toDateString();
            $endDate = now()->subYears($age)->toDateString();
            $query->whereBetween('TanggalLahir', [$startDate, $endDate]);
        }

        $anakAsuhs = $query->latest()->paginate(10)->withQueryString();
        return view('anak_asuh.index', compact('anakAsuhs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('anak_asuh.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'NamaLengkap' => 'required|string|max:255',
            'NamaOrangTua' => 'nullable|string|max:255',
            'NomorTelp' => 'nullable|string|max:20',
            'TempatLahir' => 'required|string|max:255',
            'TanggalLahir' => 'required|date',
            'JenisKelamin' => 'required|in:L,P',
            'Alamat' => 'required|string',
            'Sekolah' => 'required|string|max:255',
            'Kelas' => 'required|string|max:255',
            'Status' => 'required|in:aktif,nonaktif',
            'FotoAnak' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'KakakAsuhID' => 'nullable|exists:kakak_asuhs,KakakAsuhID',
        ]);

        if ($request->hasFile('FotoAnak')) {
            $path = $request->file('FotoAnak')->store('anak_asuh', 'public');
            $validatedData['FotoAnak'] = $path;
        }

        AnakAsuh::create($validatedData);

        return redirect()->route('anak_asuh.index')->with('success', 'Data anak asuh berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $anakAsuh = AnakAsuh::findOrFail($id);
        return view('anak_asuh.edit', compact('anakAsuh'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $anakAsuh = AnakAsuh::findOrFail($id);

        $validatedData = $request->validate([
            'NamaLengkap' => 'required|string|max:255',
            'NamaOrangTua' => 'nullable|string|max:255',
            'NomorTelp' => 'nullable|string|max:20',
            'TempatLahir' => 'required|string|max:255',
            'TanggalLahir' => 'required|date',
            'JenisKelamin' => 'required|in:L,P',
            'Alamat' => 'required|string',
            'Sekolah' => 'required|string|max:255',
            'Kelas' => 'required|string|max:255',
            'Status' => 'required|in:aktif,nonaktif',
            'FotoAnak' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'KakakAsuhID' => 'nullable|exists:kakak_asuhs,KakakAsuhID',
        ]);

        if ($request->hasFile('FotoAnak')) {
            // Delete old photo if exists
            if ($anakAsuh->FotoAnak) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($anakAsuh->FotoAnak);
            }
            $path = $request->file('FotoAnak')->store('anak_asuh', 'public');
            $validatedData['FotoAnak'] = $path;
        }

        $anakAsuh->update($validatedData);

        return redirect()->route('anak_asuh.index')->with('success', 'Data anak asuh berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $anakAsuh = AnakAsuh::findOrFail($id);

        if ($anakAsuh->FotoAnak) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($anakAsuh->FotoAnak);
        }

        $anakAsuh->delete();

        return redirect()->route('anak_asuh.index')->with('success', 'Data anak asuh berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new AnakAsuhImport, $request->file('file_excel'));
            return redirect()->route('anak_asuh.index')->with('success', 'Data anak asuh berhasil diimport.');
        }
        catch (\Exception $e) {
            return redirect()->route('anak_asuh.index')->with('error', 'Gagal mengimport data: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        return Excel::download(new AnakAsuhExport, 'template-import-anak-asuh.xlsx');
    }
}
