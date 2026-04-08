<?php

namespace App\Http\Controllers;

use App\Models\AnakAsuh;
use App\Models\Donation;
use App\Models\GaleriAsuh;
use App\Models\RaporAsuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DonorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $donations = Donation::where('user_id', $user->id)->latest()->take(5)->get();
        $totalDonation = Donation::where('user_id', $user->id)->where('status', 'success')->sum('amount');
        
        return view('donor.dashboard', compact('donations', 'totalDonation'));
    }

    public function anakAsuhList()
    {
        $anakAsuhs = AnakAsuh::where('Status', 'aktif')->get();
        return view('donor.anak_asuh.index', compact('anakAsuhs'));
    }

    public function anakAsuhDetail($id)
    {
        $anakAsuh = AnakAsuh::findOrFail($id);
        $rapor = RaporAsuh::where('AnakAsuhID', $id)->latest()->get();
        $galeri = GaleriAsuh::where('AnakAsuhID', $id)->latest()->get();
        
        return view('donor.anak_asuh.show', compact('anakAsuh', 'rapor', 'galeri'));
    }

    public function donationForm(Request $request)
    {
        $anak_asuh_id = $request->query('anak_asuh_id');
        $anakAsuh = null;
        if ($anak_asuh_id) {
            $anakAsuh = AnakAsuh::find($anak_asuh_id);
        }
        
        return view('donor.donasi', compact('anakAsuh'));
    }

    public function processDonation(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
            'anak_asuh_id' => 'nullable|exists:anak_asuhs,id',
        ]);

        $donation = Donation::create([
            'order_id' => 'DON-' . Str::random(10),
            'user_id' => Auth::id(),
            'anak_asuh_id' => $request->anak_asuh_id,
            'amount' => $request->amount,
            'status' => 'pending',
            'payment_type' => 'QRIS (Manual)',
        ]);

        // Redirect back to dashboard with a success message waiting for admin approval
        return redirect()->route('donor.dashboard')->with('success', 'Konfirmasi donasi berhasil dikirim! Silakan tunggu verifikasi admin.');
    }
}
