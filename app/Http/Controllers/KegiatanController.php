<?php

namespace App\Http\Controllers;

use App\Models\LaporanKegiatan;
use App\Models\Proker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');

        $kegiatan = LaporanKegiatan::with('creator', 'absensi', 'notulensi')
            ->when(request('filter') === 'hari_ini' || !request()->has('filter'), function ($query) {
                // Default: hanya data hari ini
                $query->whereDate('created_at', today());
            })
            ->when(request('filter') === 'belum', function ($query) {
                // Jika filter 'belum', ambil yang proker_id null
                $query->whereNull('proker_id');
            })
            ->when(request('filter') === 'semua', function ($query) {
                // Jika filter 'belum', ambil yang proker_id null
                return $query;
            })
            // Pencarian
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_kegiatan', 'like', '%' . $search . '%')
                        ->orWhere('lokasi_kegiatan', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate($perPage)
            ->appends(request()->query());


        $proker = Proker::all();
        $pemimpin_rapat = User::all();

        return view('kegiatan.index', compact('kegiatan', 'proker', 'pemimpin_rapat'))
            ->with('i', (request()->input('page', 1) - 1) * $perPage);
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
            $validatedData = $request->validate([
                'proker_id'               => 'nullable|exists:prokers,id',
                'nama_kegiatan'           => 'required|string|max:255',
                'pemimpin_rapat_id'       => 'nullable|exists:users,id',
                'tgl_kegiatan'            => 'required|date',
                'waktu_mulai'             => 'nullable|date_format:H:i',
                'waktu_selesai'           => 'nullable|date_format:H:i|after_or_equal:waktu_mulai',
                'lokasi_kegiatan'         => 'required|string|max:255',
                'deskripsi_kegiatan'      => 'required|string|max:1000',
                'hasil_kegiatan'          => 'nullable|string|max:1000',
                'kendala_kegiatan'        => 'nullable|string|max:1000',
                // 'jenis_laporan_kegiatan'  => 'required|in:harian,mingguan',
                'link_dokumentasi_foto' => 'nullable|url',
                'link_dokumentasi_video' => 'nullable|url',
            ], [
                'proker_id.exists' => 'Program kerja yang dipilih tidak valid.',
                'nama_kegiatan.required' => 'Nama kegiatan tidak boleh kosong.',
                'pemimpin_rapat_id.exists' => 'Pemimpin rapat yang dipilih tidak valid.',
                'tgl_kegiatan.required' => 'Tanggal kegiatan wajib diisi.',
                'waktu_mulai.date_format' => 'Format waktu mulai tidak valid.',
                'waktu_selesai.date_format' => 'Format waktu selesai tidak valid.',
                'waktu_selesai.after_or_equal' => 'Waktu selesai tidak boleh lebih awal dari waktu mulai.',
                'lokasi_kegiatan.required' => 'Lokasi kegiatan wajib diisi.',
                'deskripsi_kegiatan.required' => 'Deskripsi kegiatan wajib diisi.',
                // 'jenis_laporan_kegiatan.required' => 'Jenis laporan harus dipilih.',
                // 'jenis_laporan_kegiatan.in' => 'Jenis laporan tidak valid.',
                'link_dokumentasi_foto.url' => 'Link dokumentasi harus berupa URL yang valid.',
                'link_dokumentasi_video.url' => 'Link dokumentasi harus berupa URL yang valid.'
            ]);

            $validatedData['created_by'] = Auth::id();

            LaporanKegiatan::create($validatedData);

            return back()->with('success', 'Laporan kegiatan "' . $validatedData['nama_kegiatan'] . '" berhasil disimpan.');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('add', true);
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan laporan kegiatan: ' . $th->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage());
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
        try {
            $validatedData = $request->validate([
                'proker_id'               => 'nullable|exists:prokers,id',
                'nama_kegiatan'           => 'required|string|max:255',
                'pemimpin_rapat_id'       => 'nullable|exists:users,id',
                'tgl_kegiatan'            => 'required|date',
                'waktu_mulai'             => 'nullable|date_format:H:i',
                'waktu_selesai'           => 'nullable|date_format:H:i|after_or_equal:waktu_mulai',
                'lokasi_kegiatan'         => 'required|string|max:255',
                'deskripsi_kegiatan'      => 'required|string|max:1000',
                'hasil_kegiatan'          => 'nullable|string|max:1000',
                'kendala_kegiatan'        => 'nullable|string|max:1000',
                // 'jenis_laporan_kegiatan'  => 'required|in:harian,mingguan',
                'link_dokumentasi_foto' => 'nullable|url',
                'link_dokumentasi_video' => 'nullable|url',
            ], [
                'proker_id.exists' => 'Program kerja yang dipilih tidak valid.',
                'nama_kegiatan.required' => 'Nama kegiatan tidak boleh kosong.',
                'pemimpin_rapat_id.exists' => 'Pemimpin rapat yang dipilih tidak valid.',
                'tgl_kegiatan.required' => 'Tanggal kegiatan wajib diisi.',
                'waktu_mulai.date_format' => 'Format waktu mulai tidak valid.',
                'waktu_selesai.date_format' => 'Format waktu selesai tidak valid.',
                'waktu_selesai.after_or_equal' => 'Waktu selesai tidak boleh lebih awal dari waktu mulai.',
                'lokasi_kegiatan.required' => 'Lokasi kegiatan wajib diisi.',
                'deskripsi_kegiatan.required' => 'Deskripsi kegiatan wajib diisi.',
                // 'jenis_laporan_kegiatan.required' => 'Jenis laporan harus dipilih.',
                // 'jenis_laporan_kegiatan.in' => 'Jenis laporan tidak valid.',
                'link_dokumentasi_foto.url' => 'Link dokumentasi harus berupa URL yang valid.',
                'link_dokumentasi_video.url' => 'Link dokumentasi harus berupa URL yang valid.'
            ]);

            LaporanKegiatan::findOrFail($id)->update($validatedData);

            return back()->with('success', 'Laporan kegiatan "' . $validatedData['nama_kegiatan'] . '" berhasil diubah.');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('edit_id', $id);
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan laporan kegiatan: ' . $th->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kegiatan = LaporanKegiatan::with(['notulensi', 'berita_acara'])->findOrFail($id);
        $nama = $kegiatan->nama_kegiatan;

        // Hapus file Notulensi jika ada
        if ($kegiatan->notulensi && Storage::exists('public/' . $kegiatan->notulensi->file_path)) {
            Storage::delete('public/' . $kegiatan->notulensi->file_path);
            $kegiatan->notulensi->delete(); // Hapus record DB
        }

        // Hapus file BAP jika ada
        if ($kegiatan->berita_acara && Storage::exists('public/' . $kegiatan->berita_acara->file_path)) {
            Storage::delete('public/' . $kegiatan->berita_acara->file_path);
            $kegiatan->berita_acara->delete(); // Hapus record DB
        }

        // Hapus kegiatan
        $kegiatan->delete();

        return back()->with('success', 'Data kegiatan "' . $nama . '" beserta Notulensi dan BAP berhasil dihapus.');
    }
}
