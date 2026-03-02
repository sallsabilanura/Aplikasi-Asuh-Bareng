<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KebiasaanBaik;
use App\Models\AnakAsuh;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KebiasaanBaikController extends Controller
{
    // Restrict access to Kakak Asuh (or admin)
    private function checkAccess()
    {
        $role = Auth::user()->role;
        if ($role !== 'kakak_asuh' && $role !== 'admin' && $role !== 'superadmin') {
            abort(403, 'Unauthorized action.');
        }
    }

    public function index(Request $request)
    {
        $this->checkAccess();
        $user = Auth::user();

        $selectedMonth = $request->input('month', Carbon::now()->month);
        $selectedYear = $request->input('year', Carbon::now()->year);

        // Fetch children assigned to this user if they are a kakak_asuh
        if ($user->role === 'kakak_asuh' && $user->kakakAsuh) {
            $anakAsuhs = AnakAsuh::whereHas('penugasan', function ($q) use ($user) {
                $q->where('KakakAsuhID', $user->kakakAsuh->KakakAsuhID);
            })->where('Status', 'aktif')->get();
        }
        else {
            // Admins can see all active children
            $anakAsuhs = AnakAsuh::where('Status', 'aktif')->get();
        }

        // Fetch all kebiasaan records for the selected month/year for these children
        $anakAsuhIds = $anakAsuhs->pluck('id')->toArray();
        $kebiasaanRecords = KebiasaanBaik::whereIn('AnakAsuhID', $anakAsuhIds)
            ->where('Bulan', $selectedMonth)
            ->where('Tahun', $selectedYear)
            ->get()
            ->keyBy('AnakAsuhID');

        return view('kakak_asuh.kebiasaan_baik.index', compact('anakAsuhs', 'kebiasaanRecords', 'selectedMonth', 'selectedYear'));
    }

    public function form($id, $month, $year)
    {
        $this->checkAccess();
        $anak = AnakAsuh::findOrFail($id);

        // Find existing record or return empty instance
        $kebiasaan = KebiasaanBaik::where('AnakAsuhID', $id)
            ->where('Bulan', $month)
            ->where('Tahun', $year)
            ->first();

        return view('kakak_asuh.kebiasaan_baik.form', compact('anak', 'month', 'year', 'kebiasaan'));
    }

    public function store(Request $request, $id, $month, $year)
    {
        $this->checkAccess();

        $request->validate([
            'SholatSubuh' => 'required|integer|min:0|max:31',
            'SholatZuhur' => 'required|integer|min:0|max:31',
            'SholatAshar' => 'required|integer|min:0|max:31',
            'SholatMagrib' => 'required|integer|min:0|max:31',
            'SholatIsya' => 'required|integer|min:0|max:31',
            'Mengaji' => 'required|integer|min:0|max:31',
            'BerangkatSekolah' => 'required|integer|min:0|max:31',
            'BantuOrangTua' => 'required|integer|min:0|max:31',
        ]);

        $anak = AnakAsuh::findOrFail($id);

        $kakakAsuhId = null;
        if (Auth::user()->role === 'kakak_asuh' && Auth::user()->kakakAsuh) {
            $kakakAsuhId = Auth::user()->kakakAsuh->KakakAsuhID;
        }
        else {
            // Find the child's assigned KakakAsuh if filled by admin
            $penugasan = $anak->penugasan()->latest('TanggalMulai')->first();
            if ($penugasan) {
                $kakakAsuhId = $penugasan->KakakAsuhID;
            }
        }

        if (!$kakakAsuhId) {
            return back()->withErrors(['message' => 'Anak asuh ini belum memiliki Kakak Asuh yang ditugaskan, data tidak dapat disimpan.']);
        }

        KebiasaanBaik::updateOrCreate(
        [
            'AnakAsuhID' => $id,
            'Bulan' => $month,
            'Tahun' => $year,
        ],
        [
            'KakakAsuhID' => $kakakAsuhId, // Will be null if admin saves it, or needs adjustment based on policy. usually kakak asuh fills this
            'SholatSubuh' => $request->SholatSubuh,
            'SholatZuhur' => $request->SholatZuhur,
            'SholatAshar' => $request->SholatAshar,
            'SholatMagrib' => $request->SholatMagrib,
            'SholatIsya' => $request->SholatIsya,
            'Mengaji' => $request->Mengaji,
            'BerangkatSekolah' => $request->BerangkatSekolah,
            'BantuOrangTua' => $request->BantuOrangTua,
        ]
        );

        return redirect()->route('kebiasaan_baik.index', ['month' => $month, 'year' => $year])
            ->with('success', 'Data Kebiasaan Baik berhasil disimpan.');
    }
    public function exportPdf(Request $request, $id, $month, $year)
    {
        $this->checkAccess();
        $anak = AnakAsuh::findOrFail($id);

        $kebiasaan = KebiasaanBaik::where('AnakAsuhID', $id)
            ->where('Bulan', $month)
            ->where('Tahun', $year)
            ->first();

        $kakakAsuhName = '-';
        if ($anak->penugasan->count() > 0) {
            $kakakAsuhName = $anak->penugasan->first()->kakakAsuh->NamaLengkap ?? '-';
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.kebiasaan_baik', compact('anak', 'month', 'year', 'kebiasaan', 'kakakAsuhName'))->setPaper('a4', 'landscape');

        $filename = 'Kebiasaan_Baik_' . str_replace(' ', '_', $anak->NamaLengkap) . '_' . date('F_Y', mktime(0, 0, 0, $month, 10)) . '.pdf';

        return $pdf->stream($filename);
    }
}
