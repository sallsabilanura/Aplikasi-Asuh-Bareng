<?php

namespace App\Http\Controllers;

use App\Models\SettingRekrutmen;
use App\Models\PosisiRekrutmen;
use App\Models\PendaftarRekrutmen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRekrutmenController extends Controller
{
    // Make sure only admin can access these methods
    public function __construct()
    {
    // Add middleware if available, or handle in methods. For now we assume auth middleware is active.
    }

    private function checkAdmin()
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized action.');
        }
    }

    // ==========================================
    // PENGATURAN PANDUAN REKRUTMEN
    // ==========================================
    public function pengaturan()
    {
        $this->checkAdmin();
        $setting = SettingRekrutmen::first() ?? new SettingRekrutmen();
        return view('admin.rekrutmen.pengaturan', compact('setting'));
    }

    public function updatePengaturan(Request $request)
    {
        $this->checkAdmin();
        $setting = SettingRekrutmen::first() ?? new SettingRekrutmen();

        $setting->IsActive = $request->has('IsActive');
        $setting->Pengenalan = $request->Pengenalan;
        $setting->Tujuan = $request->Tujuan;
        $setting->KetentuanUmum = $request->KetentuanUmum;
        $setting->SistemKafalah = $request->SistemKafalah;
        $setting->Mekanisme = $request->Mekanisme;
        $setting->Penutup = $request->Penutup;

        $setting->save();

        return redirect()->route('admin.rekrutmen.pengaturan')->with('success', 'Panduan Rekrutmen berhasil diperbarui.');
    }

    // ==========================================
    // POSISI REKRUTMEN (CRUD)
    // ==========================================
    public function posisiIndex()
    {
        $this->checkAdmin();
        $posisi = PosisiRekrutmen::all();
        return view('admin.rekrutmen.posisi.index', compact('posisi'));
    }

    public function posisiStore(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'NamaPosisi' => 'required',
            'Kuota' => 'required',
            'KeteranganPeran' => 'nullable'
        ]);

        PosisiRekrutmen::create($request->all());
        return redirect()->route('admin.rekrutmen.posisi.index')->with('success', 'Posisi berhasil ditambahkan.');
    }

    public function posisiEdit($id)
    {
        $this->checkAdmin();
        $pos = PosisiRekrutmen::findOrFail($id);

        // This can just be returned as JSON if using modal, or full view. We'll use a full view for simplicity if needed, or redirect.
        // If the user wants a simple edit, we'll return a view.
        return view('admin.rekrutmen.posisi.edit', compact('pos'));
    }

    public function posisiUpdate(Request $request, $id)
    {
        $this->checkAdmin();
        $pos = PosisiRekrutmen::findOrFail($id);

        $request->validate([
            'NamaPosisi' => 'required',
            'Kuota' => 'required',
            'KeteranganPeran' => 'nullable'
        ]);

        $pos->update($request->all());
        return redirect()->route('admin.rekrutmen.posisi.index')->with('success', 'Posisi berhasil diperbarui.');
    }

    public function posisiDestroy($id)
    {
        $this->checkAdmin();
        $pos = PosisiRekrutmen::findOrFail($id);
        $pos->delete();
        return redirect()->route('admin.rekrutmen.posisi.index')->with('success', 'Posisi berhasil dihapus.');
    }

    public function posisiToggleStatus($id)
    {
        $this->checkAdmin();
        $pos = PosisiRekrutmen::findOrFail($id);
        $pos->IsActive = !$pos->IsActive;
        $pos->save();

        $status = $pos->IsActive ? 'dibuka' : 'ditutup';
        return redirect()->route('admin.rekrutmen.posisi.index')->with('success', "Status posisi berhasil $status.");
    }

    // ==========================================
    // PENDAFTAR REKRUTMEN
    // ==========================================
    public function pendaftarIndex()
    {
        $this->checkAdmin();
        $pendaftars = PendaftarRekrutmen::with('posisi')->latest()->paginate(10);
        return view('admin.rekrutmen.pendaftar.index', compact('pendaftars'));
    }

    public function pendaftarShow($id)
    {
        $this->checkAdmin();
        $pendaftar = PendaftarRekrutmen::with('posisi')->findOrFail($id);
        
        // Check if already onboarded
        $isAlreadyUser = \App\Models\User::where('email', $pendaftar->Email)->exists();
        
        return view('admin.rekrutmen.pendaftar.show', compact('pendaftar', 'isAlreadyUser'));
    }

    /**
     * Bridge recruitment to User & Kakak Asuh account
     */
    public function terimaPendaftar(Request $request, $id)
    {
        $this->checkAdmin();
        $pendaftar = PendaftarRekrutmen::findOrFail($id);

        if (!$pendaftar->Email) {
            return redirect()->back()->with('error', 'Pendaftar ini belum menyertakan email. Mohon update manual atau minta pelamar mendaftar ulang.');
        }

        if (\App\Models\User::where('email', $pendaftar->Email)->exists()) {
            return redirect()->back()->with('error', 'Email account ' . $pendaftar->Email . ' already exists in User table.');
        }

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            $password = '12345678';

            // 1. Create User
            $user = \App\Models\User::create([
                'name' => $pendaftar->NamaLengkap,
                'email' => $pendaftar->Email,
                'password' => \Illuminate\Support\Facades\Hash::make($password),
                'role' => 'kakak_asuh',
                'is_approved' => true,
            ]);

            // 2. Create Kakak Asuh Profile
            \App\Models\KakakAsuh::create([
                'user_id' => $user->id,
                'NamaLengkap' => $pendaftar->NamaLengkap,
                'NomorHP' => $pendaftar->NoWhatsapp,
                'Email' => $pendaftar->Email,
                'Alamat' => $pendaftar->Domisili,
                'StatusAktif' => 'aktif',
                'Foto' => $pendaftar->FotoPath,
            ]);

            // 3. Send Welcome Email
            try {
                \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\VolunteerWelcomeEmail($user, $password));
            } catch (\Exception $e) {
                // Log the error but don't fail the transaction if email fails
                \Illuminate\Support\Facades\Log::error('Gagal mengirim email onboarding: ' . $e->getMessage());
            }

            \Illuminate\Support\Facades\DB::commit();

            return redirect()->route('admin.rekrutmen.pendaftar.index')->with('success', 'Relawan berhasil diterima! Akun User & Profil Kakak Asuh telah otomatis dibuat. Kredensial login telah dikirimkan ke email pelamar.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses pendaftar: ' . $e->getMessage());
        }
    }
}
