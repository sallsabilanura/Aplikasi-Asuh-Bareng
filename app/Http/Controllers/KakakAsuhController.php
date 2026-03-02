<?php

namespace App\Http\Controllers;

use App\Models\KakakAsuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KakakAsuhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = KakakAsuh::query();

        if ($request->filled('search')) {
            $query->where('NamaLengkap', 'like', '%' . $request->search . '%');
        }

        $kakakAsuhs = $query->latest()->paginate(10)->withQueryString();
        return view('kakak_asuh.index', compact('kakakAsuhs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('kakak_asuh.create');
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
            'NomorHP' => 'required|string|max:20',
            'Email' => 'required|email|unique:kakak_asuhs,Email|unique:users,email',
            'password' => 'required|string|min:8',
            'Alamat' => 'required|string',
            'StatusAktif' => 'required|in:aktif,nonaktif',
            'Foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create User first
        $user = \App\Models\User::create([
            'name' => $validatedData['NamaLengkap'],
            'email' => $validatedData['Email'],
            'password' => \Illuminate\Support\Facades\Hash::make($validatedData['password']),
            'role' => 'kakak_asuh',
            'is_approved' => true,
        ]);

        if ($request->hasFile('Foto')) {
            $path = $request->file('Foto')->store('kakak_asuh', 'public');
            $validatedData['Foto'] = $path;
        }

        $validatedData['user_id'] = $user->id;
        KakakAsuh::create($validatedData);

        return redirect()->route('kakak_asuh.index')->with('success', 'Data kakak asuh dan akun berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $kakakAsuh = KakakAsuh::findOrFail($id);
        return view('kakak_asuh.edit', compact('kakakAsuh'));
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
        $kakakAsuh = KakakAsuh::findOrFail($id);
        $user = $kakakAsuh->user;

        $validatedData = $request->validate([
            'NamaLengkap' => 'required|string|max:255',
            'NomorHP' => 'required|string|max:20',
            'Email' => 'required|email|unique:kakak_asuhs,Email,' . $kakakAsuh->KakakAsuhID . ',KakakAsuhID|unique:users,email,' . ($user ? $user->id : 0),
            'password' => 'nullable|string|min:8',
            'Alamat' => 'required|string',
            'StatusAktif' => 'required|in:aktif,nonaktif',
            'Foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('Foto')) {
            if ($kakakAsuh->Foto) {
                Storage::disk('public')->delete($kakakAsuh->Foto);
            }
            $path = $request->file('Foto')->store('kakak_asuh', 'public');
            $validatedData['Foto'] = $path;
        }

        $kakakAsuh->update($validatedData);

        // Sync with User
        if ($user) {
            $user->update([
                'name' => $validatedData['NamaLengkap'],
                'email' => $validatedData['Email'],
            ]);

            if (!empty($validatedData['password'])) {
                $user->update([
                    'password' => \Illuminate\Support\Facades\Hash::make($validatedData['password']),
                ]);
            }
        }

        return redirect()->route('kakak_asuh.index')->with('success', 'Data kakak asuh berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kakakAsuh = KakakAsuh::findOrFail($id);

        if ($kakakAsuh->Foto) {
            Storage::disk('public')->delete($kakakAsuh->Foto);
        }

        // Delete associated user
        if ($kakakAsuh->user) {
            $kakakAsuh->user->delete();
        }

        $kakakAsuh->delete();

        return redirect()->route('kakak_asuh.index')->with('success', 'Data kakak asuh dan akun berhasil dihapus.');
    }
}
