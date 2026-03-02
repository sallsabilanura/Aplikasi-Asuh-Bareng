<?php

namespace App\Http\Controllers;

use App\Models\LogbookRelawan;
use App\Models\RencanaProgram;
use App\Models\KakakAsuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LogbookRelawanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'RencanaProgramID' => 'required|exists:rencana_programs,id',
            'TanggalAktivitas' => 'required|date',
            'NamaAktivitas' => 'required|string|max:255',
            'DeskripsiHasil' => 'required|string',
            'FileBukti' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
        ]);

        $program = RencanaProgram::findOrFail($request->RencanaProgramID);

        // Security check
        $user = Auth::user();
        if ($user->role != 'admin') {
            $kakakAsuh = KakakAsuh::where('user_id', $user->id)->firstOrFail();
            if ($program->KakakAsuhID !== $kakakAsuh->KakakAsuhID || $program->Status != 'Disetujui') {
                return redirect()->back()->with('error', 'Anda tidak diizinkan mengisi logbook untuk program ini.');
            }
        }

        $data = $request->only(['RencanaProgramID', 'TanggalAktivitas', 'NamaAktivitas', 'DeskripsiHasil']);
        $data['StatusValidasi'] = 'Belum Diperiksa';

        if ($request->hasFile('FileBukti')) {
            $path = $request->file('FileBukti')->store('logbook', 'public');
            $data['FileBukti'] = $path;
        }

        LogbookRelawan::create($data);

        return redirect()->back()->with('success', 'Logbook berhasil ditambahkan.');
    }

    public function validateLog(Request $request, $id)
    {
        if (Auth::user()->role != 'admin' && Auth::user()->role != 'superadmin') {
            abort(403);
        }

        $request->validate([
            'StatusValidasi' => 'required|in:Disetujui,Revisi',
            'KomentarAdmin' => 'nullable|string',
        ]);

        $logbook = LogbookRelawan::findOrFail($id);
        $logbook->update([
            'StatusValidasi' => $request->StatusValidasi,
            'KomentarAdmin' => $request->KomentarAdmin,
        ]);

        return redirect()->back()->with('success', 'Status logbook berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $logbook = LogbookRelawan::findOrFail($id);
        $program = $logbook->rencanaProgram;

        // Only owner can delete if not validated yet
        if (Auth::user()->role != 'admin') {
            $kakakAsuh = KakakAsuh::where('user_id', Auth::id())->firstOrFail();
            if ($program->KakakAsuhID !== $kakakAsuh->KakakAsuhID || $logbook->StatusValidasi != 'Belum Diperiksa') {
                return redirect()->back()->with('error', 'Logbook tidak bisa dihapus.');
            }
        }

        if ($logbook->FileBukti) {
            Storage::disk('public')->delete($logbook->FileBukti);
        }

        $logbook->delete();
        return redirect()->back()->with('success', 'Logbook berhasil dihapus.');
    }
}
