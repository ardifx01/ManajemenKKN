<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\LaporanKegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // halaman print
    public function index($id)
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
            $request->validate([
                'laporan_kegiatan_id' => 'required|exists:laporan_kegiatans,id',
                'absensi' => 'required|array',
                'absensi.*' => 'in:H,S,A,I',
            ]);

            $laporanId = $request->laporan_kegiatan_id;

            $data = [];
            foreach ($request->absensi as $userId => $status) {
                $data[] = [
                    'laporan_kegiatan_id' => $laporanId,
                    'user_id' => $userId,
                    'status' => $status,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // dd($data);
            Absensi::insert($data);

            return back()->with('success', 'Absensi berhasil disimpan.');
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan absensi: ' . $th->getMessage());
            return back()->with('error', 'Gagal menyimpan data: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kegiatan = LaporanKegiatan::findOrFail($id);
        $absensi = Absensi::where('laporan_kegiatan_id', $id)->with('user')->get()->keyBy('user_id');
        $users = User::whereNotIn('role', ['admin', 'pembimbing'])->get();

        return view('absensi.index', compact('absensi', 'users', 'id', 'kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'laporan_kegiatan_id' => 'required|exists:laporan_kegiatans,id',
                'absensi' => 'required|array',
                'absensi.*' => 'in:H,S,I,A',
            ]);

            foreach ($request->absensi as $userId => $status) {
                Absensi::where('laporan_kegiatan_id', $id)
                    ->where('user_id', $userId)
                    ->update(['status' => $status, 'updated_at' => now()]);
            }

            return redirect()->back()->with('success', 'Absensi berhasil diperbarui.');
        } catch (\Throwable $th) {
            Log::error('Gagal mengupdate absensi: ' . $th->getMessage());
            return back()->with('error', 'Gagal menyimpan data: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        //
    }

    public function print($id)
    {
        $kegiatan = LaporanKegiatan::findOrFail($id);
        $absensi = Absensi::where('laporan_kegiatan_id', $id)
            ->join('users', 'absensis.user_id', '=', 'users.id')
            ->select('absensis.*') // supaya hanya ambil kolom absensis + relasi
            ->with('user')
            ->orderByRaw("CASE WHEN users.name = '-' THEN 1 ELSE 0 END ASC") // '-' di paling bawah
            ->orderBy('users.name', 'asc') // sisanya tetap urut alfabet
            ->get();

        // ->with('user')
        // ->orderBy('id') 
        // ->get();

        // dd($absensi->count()); // Cek jumlah data yang benar-benar terambil
        return view('absensi.print', compact('absensi', 'kegiatan'));
    }
}
