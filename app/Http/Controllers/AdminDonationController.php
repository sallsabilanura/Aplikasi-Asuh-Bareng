<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Mail\DonationConfirmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Helpers\ActivityLogger;

class AdminDonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with(['user', 'anakAsuh'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(15);

        return view('admin.donations.index', compact('donations'));
    }

    public function approve($id)
    {
        $donation = Donation::findOrFail($id);
        $donation->update(['status' => 'success']);

        ActivityLogger::log('Update', "Admin menyetujui donasi sebesar Rp" . number_format($donation->amount, 0, ',', '.') . " dari " . ($donation->user->name ?? 'Anonim'));

        // Send Email to Donor
        if ($donation->user && $donation->user->email) {
            try {
                Mail::to($donation->user->email)->send(new DonationConfirmed($donation));
            } catch (\Exception $e) {
                // Log error or handle silently if mail fails
                \Log::error('Gagal mengirim email konfirmasi donasi: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Donasi berhasil diverifikasi dan email ucapan terima kasih telah dikirim.');
    }

    public function reject($id)
    {
        $donation = Donation::findOrFail($id);
        $donation->update(['status' => 'failed']);

        ActivityLogger::log('Update', "Admin menolak donasi sebesar Rp" . number_format($donation->amount, 0, ',', '.') . " dari " . ($donation->user->name ?? 'Anonim'));

        return redirect()->back()->with('info', 'Donasi telah ditolak.');
    }
}
