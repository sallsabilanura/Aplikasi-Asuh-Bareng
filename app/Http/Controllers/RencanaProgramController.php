<?php

namespace App\Http\Controllers;

use App\Models\RencanaProgram;
use App\Models\KakakAsuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RencanaProgramController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = RencanaProgram::with('kakakasuh');

        if ($user->role == 'admin') {
            // Admin can see all
            if ($request->filled('status')) {
                $query->where('Status', $request->status);
            }
            if ($request->filled('kakak_asuh')) {
                $query->where('KakakAsuhID', $request->kakak_asuh);
            }
        }
        else {
            // Relawan can only see their own
            $kakakAsuh = KakakAsuh::where('user_id', $user->id)->firstOrFail();
            $query->where('KakakAsuhID', $kakakAsuh->KakakAsuhID);
        }

        $programs = $query->latest()->paginate(10);
        $kakakAsuhs = ($user->role == 'admin') ?KakakAsuh::all() : [];

        if ($user->role == 'admin') {
            return view('admin.validasi_program.index', compact('programs', 'kakakAsuhs'));
        }
        return view('kakak_asuh.rencana_program.index', compact('programs'));
    }

    public function create()
    {
        return view('kakak_asuh.rencana_program.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'NamaProgram' => 'required|string|max:255',
            'Deskripsi' => 'required|string',
            'TargetSelesai' => 'required|date|after_or_equal:today',
        ]);

        $kakakAsuh = KakakAsuh::where('user_id', Auth::id())->firstOrFail();

        $validated['KakakAsuhID'] = $kakakAsuh->KakakAsuhID;
        $validated['Status'] = 'Menunggu'; // Standard Title Case

        $rencanaProgram = RencanaProgram::create($validated);

        return redirect()->route('rencana-program.show', $rencanaProgram->id)->with('success', 'Program berhasil diajukan! Tunggu konfirmasi admin.');
    }

    public function show($id)
    {
        $program = RencanaProgram::with(['kakakasuh', 'logbooks' => function ($q) {
            $q->latest();
        }])->findOrFail($id);

        // Security check for relawan
        if (Auth::user()->role === 'kakak_asuh') {
            if ($program->KakakAsuhID !== Auth::user()->kakakAsuh->KakakAsuhID) {
                abort(403);
            }
        }

        if (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin') {
            return view('admin.validasi_program.show', compact('program'));
        }

        return view('kakak_asuh.rencana_program.show', compact('program'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Admin only
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'superadmin') {
            abort(403);
        }

        $request->validate([
            'Status' => 'required|in:Disetujui,Ditolak,Selesai',
            'KomentarAdmin' => 'nullable|string'
        ]);

        $program = RencanaProgram::findOrFail($id);
        $program->update($request->only('Status', 'KomentarAdmin'));

        return redirect()->route('rencana-program.index')->with('success', 'Status program berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $program = RencanaProgram::findOrFail($id);

        // Only owner can delete if still pending
        if (Auth::user()->role != 'admin') {
            $kakakAsuh = KakakAsuh::where('user_id', Auth::id())->firstOrFail();
            if ($program->KakakAsuhID !== $kakakAsuh->KakakAsuhID || $program->Status !== 'Menunggu') {
                return redirect()->back()->with('error', 'Program tidak bisa dihapus.');
            }
        }

        $program->delete();
        return redirect()->route('rencana-program.index')->with('success', 'Program berhasil dihapus.');
    }
}
