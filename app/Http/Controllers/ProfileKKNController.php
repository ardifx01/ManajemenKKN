<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\ProfileKKN;
use App\Models\StrukturOrganisasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileKKNController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = ProfileKKN::latest()->first();
        $pembimbing = User::where('role', 'pembimbing')->get();

        $users = User::all();
        $jabatans = Jabatan::all();
        $strukturOrganisasi = StrukturOrganisasi::orderBy('urutan', 'asc')->get();
        return view('profil_kkn.index', compact('profile', 'pembimbing', 'jabatans', 'users', 'strukturOrganisasi'));
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
                'logo' => 'nullable|image|max:2048',
                'nama_kelompok' => 'required|string|max:255',
                'nama_desa' => 'nullable|string|max:255',
                'pembimbing_id' => 'nullable|exists:users,id',
                'email' => 'nullable|email|max:255',
                'telepon' => 'nullable|string|max:20',
                'alamat' => 'nullable|string',
                'instagram' => 'nullable|url|string',
                'tiktok' => 'nullable|url|string',
                'web' => 'nullable|url|string',
            ]);

            // Handle upload logo jika ada
            if ($request->hasFile('logo')) {
                $validated['logo'] = $request->file('logo')->store('profile_kkn', 'public');
            }

            ProfileKKN::create($validated);

            return back()->with('success', 'Profil KKN berhasil disimpan.');
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan profil KKN: ' . $th->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function generate_struktur(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'jabatan_id' => 'required|exists:jabatans,id',
                'urutan' => 'required|integer',
                'profil_kkn_id' => 'required|exists:profile_k_k_n_s,id',
            ]);

            // foreach ($validated['struktur'] as $data) {
            StrukturOrganisasi::create($validated);
            // }

            return back()->with('success', 'Struktur organisasi berhasil disimpan.');
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan struktur organisasi: ' . $th->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan struktur organisasi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfileKKN $profileKKN)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfileKKN $profileKKN)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try {
            $validated = $request->validate([
                'logo' => 'nullable|image|max:2048',
                'nama_kelompok' => 'required|string|max:255',
                'nama_desa' => 'nullable|string|max:255',
                'pembimbing_id' => 'nullable|exists:users,id',
                'email' => 'nullable|email|max:255',
                'telepon' => 'nullable|string|max:20',
                'alamat' => 'nullable|string',
                'instagram' => 'nullable|url|string',
                'tiktok' => 'nullable|url|string',
                'web' => 'nullable|url|string',
            ]);

            $profile = ProfileKkn::findOrFail($id);

            // Jika ada file logo baru, hapus yang lama lalu simpan yang baru
            if ($request->hasFile('logo')) {
                // Hapus logo lama jika ada
                if ($profile->logo && Storage::disk('public')->exists($profile->logo)) {
                    Storage::disk('public')->delete($profile->logo);
                }

                // Simpan logo baru
                $validated['logo'] = $request->file('logo')->store('profile_kkn', 'public');
            }

            $profile->update($validated);

            return back()->with('success', 'Profil KKN berhasil diperbarui.');
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan profil KKN: ' . $th->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
