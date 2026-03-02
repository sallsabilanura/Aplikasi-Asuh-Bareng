<?php

namespace App\Http\Controllers;

use App\Models\SettingRekrutmen;
use App\Models\PosisiRekrutmen;
use App\Models\PendaftarRekrutmen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\NewApplicantNotification;

class PublicRekrutmenController extends Controller
{
    public function panduan()
    {
        $setting = SettingRekrutmen::first();

        if (!$setting || !$setting->IsActive) {
            return redirect('/')->with('error', 'Rekrutmen sedang ditutup.');
        }

        $posisi = PosisiRekrutmen::where('IsActive', true)->get();

        if ($posisi->isEmpty()) {
            return redirect('/')->with('error', 'Saat ini tidak ada posisi rekrutmen yang dibuka.');
        }

        return view('rekrutmen.panduan', compact('setting', 'posisi'));
    }

    public function create()
    {
        $setting = SettingRekrutmen::first();

        if (!$setting || !$setting->IsActive) {
            return redirect('/')->with('error', 'Rekrutmen sedang ditutup.');
        }

        $posisi = PosisiRekrutmen::where('IsActive', true)->get();

        if ($posisi->isEmpty()) {
            return redirect('/')->with('error', 'Saat ini tidak ada posisi rekrutmen yang dibuka.');
        }
        return view('rekrutmen.daftar', compact('posisi'));
    }

    public function store(Request $request)
    {
        $setting = SettingRekrutmen::first();
        if (!$setting || !$setting->IsActive) {
            return redirect('/')->with('error', 'Rekrutmen sedang ditutup.');
        }

        $validated = $request->validate([
            'NamaLengkap' => 'required|string|max:255',
            'NamaPanggilan' => 'required|string|max:255',
            'JenisKelamin' => 'required|in:Laki-laki,Perempuan',
            'Usia' => 'required|integer|min:15|max:60',
            'Domisili' => 'required|string|max:255',
            'NoWhatsapp' => 'required|string|max:255',
            'Email' => 'required|email|max:255|unique:pendaftar_rekrutmens,Email',
            'PendidikanTerakhir' => 'required|string|max:255',
            'AsalInstansi' => 'required|string|max:255',
            'KesibukanSaatIni' => 'required|string|max:255',

            'PosisiID' => 'required|exists:posisi_rekrutmens,PosisiID',
            'AlasanMendaftar' => 'required|string',
            'HalMenarik' => 'required|string',
            'PengalamanRelevan' => 'required|string',
            'ArtiKomitmen' => 'required|string',

            'SiapKontrak' => 'required|boolean',
            'KendaraanPribadi' => 'required|boolean',
            'LaptopPribadi' => 'required|boolean',
            'SiapSOP' => 'required|boolean',

            'CV' => 'required|file|mimes:pdf|max:5120',
            'Foto' => 'required|image|max:2048',
            'Portofolio' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('CV')) {
            $validated['CVPath'] = $request->file('CV')->store('rekrutmen/cv', 'public');
        }
        if ($request->hasFile('Foto')) {
            $validated['FotoPath'] = $request->file('Foto')->store('rekrutmen/foto', 'public');
        }
        if ($request->hasFile('Portofolio')) {
            $validated['PortofolioPath'] = $request->file('Portofolio')->store('rekrutmen/portofolio', 'public');
        }

        // Cleanup boolean strings if needed (frontend usually sends '1' or '0')
        unset($validated['CV'], $validated['Foto'], $validated['Portofolio']);

        $pendaftar = PendaftarRekrutmen::create($validated);

        // Notify admins
        try {
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new NewApplicantNotification($pendaftar));
            }
        }
        catch (\Exception $e) {
        // Log or ignore email fail so user still sees success page
        }

        return redirect()->route('rekrutmen.sukses')->with('success', 'Pendaftaran berhasil dikirim! Kami akan segera menghubungi Anda.');
    }

    public function sukses()
    {
        return view('rekrutmen.sukses');
    }
}
