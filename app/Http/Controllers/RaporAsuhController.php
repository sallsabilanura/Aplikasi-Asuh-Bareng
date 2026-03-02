<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaporAsuh;
use App\Models\AnakAsuh;
use App\Models\KebiasaanBaik;
use App\Models\AbsensiPendampingan;
use App\Models\CekKesehatan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class RaporAsuhController extends Controller
{
    private function checkAccess()
    {
        $role = Auth::user()->role;
        if (!in_array($role, ['kakak_asuh', 'admin', 'superadmin'])) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function index(Request $request)
    {
        $this->checkAccess();
        $user = Auth::user();

        $selectedSemester = $request->input('semester', 1);
        $selectedYear = $request->input('year', Carbon::now()->year);

        if ($user->role === 'kakak_asuh' && $user->kakakAsuh) {
            $anakAsuhs = AnakAsuh::whereHas('penugasan', function ($q) use ($user) {
                $q->where('KakakAsuhID', $user->kakakAsuh->KakakAsuhID);
            })->where('Status', 'aktif')->get();
        }
        else {
            $anakAsuhs = AnakAsuh::where('Status', 'aktif')->get();
        }

        $anakAsuhIds = $anakAsuhs->pluck('id')->toArray();
        $raporRecords = RaporAsuh::whereIn('AnakAsuhID', $anakAsuhIds)
            ->where('Semester', $selectedSemester)
            ->where('Tahun', $selectedYear)
            ->get()
            ->keyBy('AnakAsuhID');

        return view('kakak_asuh.rapor_asuh.index', compact('anakAsuhs', 'raporRecords', 'selectedSemester', 'selectedYear'));
    }

    public function form($id, $semester, $year)
    {
        $this->checkAccess();
        $anak = AnakAsuh::findOrFail($id);

        $rapor = RaporAsuh::where('AnakAsuhID', $id)
            ->where('Semester', $semester)
            ->where('Tahun', $year)
            ->first();

        return view('kakak_asuh.rapor_asuh.form', compact('anak', 'semester', 'year', 'rapor'));
    }

    public function store(Request $request, $id, $semester, $year)
    {
        $this->checkAccess();

        $request->validate([
            'RingkasanPerkembangan' => 'required|string',
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

        RaporAsuh::updateOrCreate(
        [
            'AnakAsuhID' => $id,
            'Semester' => $semester,
            'Tahun' => $year,
        ],
        [
            'KakakAsuhID' => $kakakAsuhId,
            'RingkasanPerkembangan' => $request->RingkasanPerkembangan,
        ]
        );

        return redirect()->route('rapor_asuh.index', ['semester' => $semester, 'year' => $year])
            ->with('success', 'Rapor Asuh berhasil disimpan.');
    }

    public function exportPdf(Request $request, $id, $semester, $year)
    {
        $this->checkAccess();
        $anak = AnakAsuh::findOrFail($id);

        $rapor = RaporAsuh::where('AnakAsuhID', $id)
            ->where('Semester', $semester)
            ->where('Tahun', $year)
            ->first();

        // Target months for the semester
        $startMonth = $semester == 1 ? 1 : 7;
        $endMonth = $semester == 1 ? 6 : 12;
        $periodeName = ($semester == 1 ? 'Januari - Juni ' : 'Juli - Desember ') . $year;

        // 1. Calculate PENDAMPINGAN & PENDIDIKAN
        // Target is 4 sessions per month (2 offline, 2 online). So 24 sessions per semester.
        $absensi = AbsensiPendampingan::where('AnakAsuhID', $id)
            ->whereYear('Tanggal', $year)
            ->whereMonth('Tanggal', '>=', $startMonth)
            ->whereMonth('Tanggal', '<=', $endMonth)
            ->get();

        $totalHadir = $absensi->count();
        $targetHadir = 24;

        $avgPendidikan = $totalHadir > 0 ? $absensi->avg('NilaiPendampingan') : 0;
        $starPendidikan = min(5, max(1, round($avgPendidikan / 20))); // 100 max = 5 stars

        // 2. Calculate KEBIASAAN BAIK (Ibadah & Karakter)
        $kebiasaan = KebiasaanBaik::where('AnakAsuhID', $id)
            ->where('Tahun', $year)
            ->whereBetween('Bulan', [$startMonth, $endMonth])
            ->get();

        // Ibadah Calculation (Max 31 days * 5 prayers * 6 months = max approx 930)
        $totalIbadah = 0;
        $totalKarakter = 0;

        foreach ($kebiasaan as $k) {
            $totalIbadah += $k->SholatSubuh + $k->SholatZuhur + $k->SholatAshar + $k->SholatMagrib + $k->SholatIsya;
            $totalKarakter += $k->Mengaji + $k->BerangkatSekolah + $k->BantuOrangTua;
        }

        $maxIbadahPerMonth = 31 * 5;
        $maxKarakterPerMonth = 31 * 3;

        $avgIbadahPct = $kebiasaan->count() > 0 ? ($totalIbadah / ($maxIbadahPerMonth * 6)) * 100 : 0;
        $avgKarakterPct = $kebiasaan->count() > 0 ? ($totalKarakter / ($maxKarakterPerMonth * 6)) * 100 : 0;

        $starIbadah = min(5, max(1, round($avgIbadahPct / 20)));
        $starKarakter = min(5, max(1, round($avgKarakterPct / 20)));

        // 3. Calculate KESEHATAN
        $cekKesehatanCount = CekKesehatan::where('AnakAsuhID', $id)
            ->whereYear('TanggalPemeriksaan', $year)
            ->whereMonth('TanggalPemeriksaan', '>=', $startMonth)
            ->whereMonth('TanggalPemeriksaan', '<=', $endMonth)
            ->count();

        // User requested max 4 stars if it's not perfect
        if ($cekKesehatanCount >= 6) {
             $starKesehatan = 5;
        } elseif ($cekKesehatanCount > 0) {
             // scale remaining to max 4
             $starKesehatan = min(4, max(1, round(($cekKesehatanCount / 5) * 4)));
        } else {
             $starKesehatan = 1;
        }

        // Photo logic
        $photoAktifitas = $absensi->whereNotNull('FotoBukti')->sortByDesc('Tanggal')->first();

        $data = [
            'anak' => $anak,
            'rapor' => $rapor,
            'semester' => $semester,
            'year' => $year,
            'periodeName' => $periodeName,
            'totalHadir' => $totalHadir, // Changed from tidakHadir
            'starPendidikan' => $starPendidikan,
            'starKesehatan' => $starKesehatan,
            'starIbadah' => $starIbadah,
            'starKarakter' => $starKarakter,
            'photoAktifitas' => $photoAktifitas
        ];

        $pdf = Pdf::loadView('pdf.rapor_asuh', $data)->setPaper('a4', 'portrait');

        $filename = 'Rapor_Asuh_' . str_replace(' ', '_', $anak->NamaLengkap) . '_' . ($semester == 1 ? 'Ganjil' : 'Genap') . '_' . $year . '.pdf';
        return $pdf->stream($filename);
    }
}
