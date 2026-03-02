<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = \App\Models\Donatur::query();

        if ($request->filled('search')) {
            $query->where('NamaLengkap', 'like', '%' . $request->search . '%');
        }

        $donaturs = $query->latest()->paginate(10);
        return view('admin.donatur.index', compact('donaturs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.donatur.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'NamaLengkap' => 'required|string|max:255',
            'NomorTelepon' => 'nullable|string|max:20',
            'Email' => 'nullable|email|max:255',
            'Alamat' => 'nullable|string',
            'TipeDonatur' => 'required|in:Individu,Lembaga/Perusahaan',
            'Keterangan' => 'nullable|string',
        ]);

        \App\Models\Donatur::create($request->all());

        return redirect()->route('donatur.index')
                         ->with('success', 'Data Donatur berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donatur = \App\Models\Donatur::findOrFail($id);
        return view('admin.donatur.edit', compact('donatur'));
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
        $request->validate([
            'NamaLengkap' => 'required|string|max:255',
            'NomorTelepon' => 'nullable|string|max:20',
            'Email' => 'nullable|email|max:255',
            'Alamat' => 'nullable|string',
            'TipeDonatur' => 'required|in:Individu,Lembaga/Perusahaan',
            'Keterangan' => 'nullable|string',
        ]);

        $donatur = \App\Models\Donatur::findOrFail($id);
        $donatur->update($request->all());

        return redirect()->route('donatur.index')
                         ->with('success', 'Data Donatur berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donatur = \App\Models\Donatur::findOrFail($id);
        $donatur->delete();

        return redirect()->route('donatur.index')
                         ->with('success', 'Data Donatur berhasil dihapus.');
    }
}
