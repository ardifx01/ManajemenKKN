<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StrukturOrganisasiCOntroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'jabatan_id' => 'required|exists:jabatans,id',
                'urutan' => 'required|integer|unique:struktur_organisasis,urutan',
                'profil_kkn_id' => 'required|exists:profile_k_k_n_s,id',
            ]);

            StrukturOrganisasi::create($validated);

            return back()->with('success', 'Struktur organisasi berhasil disimpan.');
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan struktur organisasi: ' . $th->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan struktur organisasi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        StrukturOrganisasi::findOrFail($id)->delete();
        return back()->with('success', 'Struktur organisasi berhasil dihapus.');
    }
}
