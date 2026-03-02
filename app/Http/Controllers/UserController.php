<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserApprovedEmail;

class UserController extends Controller
{
    /**
     * Display a listing of the users (for admin approvals).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        abort_if(auth()->user()->role !== 'admin', 403, 'Akses Ditolak: Hanya Admin yang dapat mengakses halaman ini.');

        // Get all Kakak Asuh requests, newest first
        $users = User::where('role', 'kakak_asuh')->orderBy('created_at', 'desc')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Approve a user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(User $user)
    {
        abort_if(auth()->user()->role !== 'admin', 403, 'Akses Ditolak: Hanya Admin yang dapat menyetujui relawan.');

        $user->is_approved = true;
        $user->save();

        if ($user->kakakAsuh) {
            $user->kakakAsuh->update(['StatusAktif' => 'aktif']);
        }

        // Send email notification (Wrapped in try-catch to prevent Mailtrap rate limits from failing approval)
        try {
            Mail::to($user->email)->send(new UserApprovedEmail($user));
            $message = 'Akun ' . $user->name . ' berhasil disetujui dan email notifikasi telah dikirim.';
        }
        catch (\Exception $e) {
            $message = 'Akun ' . $user->name . ' berhasil disetujui, namun email notifikasi gagal dikirim (Mungkin limit server email).';
        }

        return redirect()->route('users.index')->with('success', $message);
    }
}
