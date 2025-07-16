<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');

        $keuangan = Keuangan::with('creator')
            ->when(request('filter') !== 'semua', function ($query) {
                $query->whereDate('created_at', today()); // default atau jika filter=hari_ini
            })
            ->when($search, function ($query) use ($search) {
                $query->where('keterangan', 'like', '%' . $search . '%');
            })
            ->paginate($perPage)
            ->appends(request()->query());

        return view('keuangan.index', compact('keuangan'))
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
                'jenis'              => 'required|in:pemasukan,pengeluaran',
                'tanggal'            => 'required|date',
                'keterangan'         => 'required|string|max:500',
                'nominal'            => 'required|numeric|min:1',
                'metode_pembayaran'  => 'required|in:cash,transfer',
                'bukti_pembayaran'   => 'nullable|image|mimes:jpg,jpeg,png,pdf|max:2048',
            ], [
                'jenis.required'              => 'Jenis transaksi harus dipilih',
                'tanggal.required'           => 'Tanggal tidak boleh kosong',
                'keterangan.required'        => 'Keterangan tidak boleh kosong',
                'nominal.required'           => 'Nominal harus diisi',
                'nominal.numeric'            => 'Nominal harus berupa angka',
                'metode_pembayaran.required' => 'Metode pembayaran harus dipilih',
                'bukti_pembayaran.image'     => 'File bukti harus berupa gambar',
                'bukti_pembayaran.mimes'     => 'Format file harus jpg, jpeg, png, atau pdf',
                'bukti_pembayaran.max'       => 'Ukuran file maksimal 2MB',
            ]);

            // Upload bukti pembayaran dengan nama unik jika ada
            if ($request->hasFile('bukti_pembayaran')) {
                $file      = $request->file('bukti_pembayaran');
                $filename  = now()->format('Ymd_His') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $validatedData['bukti_pembayaran'] = $file->storeAs('bukti_keuangan', $filename, 'public');
            }

            // Tambahkan user yang membuat
            $validatedData['created_by'] = Auth::id();

            Keuangan::create($validatedData);

            return back()->with('success', 'Data keuangan berhasil ditambahkan.');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('add', true);
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan keuangan: ' . $th->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Keuangan $keuangan) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keuangan $keuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'jenis' => 'required|in:pemasukan,pengeluaran',
                'tanggal' => 'required|date',
                'keterangan' => 'required|string|max:500',
                'nominal' => 'required|numeric|min:1',
                'metode_pembayaran' => 'required|in:cash,transfer',
                'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ], [
                'jenis.required' => 'Jenis transaksi harus dipilih',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'keterangan.required' => 'Keterangan tidak boleh kosong',
                'nominal.required' => 'Nominal harus diisi',
                'nominal.numeric' => 'Nominal harus berupa angka',
                'metode_pembayaran.required' => 'Metode pembayaran harus dipilih',
                'bukti_pembayaran.file' => 'File bukti harus berupa file',
                'bukti_pembayaran.mimes' => 'Format file harus jpg, jpeg, png, atau pdf',
                'bukti_pembayaran.max' => 'Ukuran file maksimal 2MB',
            ]);

            $keuangan = Keuangan::findOrFail($id);

            // Jika ada file baru, hapus file lama
            if ($request->hasFile('bukti_pembayaran')) {
                // Hapus file lama jika ada
                if ($keuangan->bukti_pembayaran && Storage::disk('public')->exists($keuangan->bukti_pembayaran)) {
                    Storage::disk('public')->delete($keuangan->bukti_pembayaran);
                }

                // Upload file baru
                $file = $request->file('bukti_pembayaran');
                $filename = now()->format('Ymd_His') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $validatedData['bukti_pembayaran'] = $file->storeAs('bukti_keuangan', $filename, 'public');
            }

            $keuangan->update($validatedData);

            return back()->with('success', 'Data keuangan berhasil diperbarui.');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('edit_id', $id);
        } catch (\Throwable $th) {
            Log::error('Gagal memperbarui keuangan: ' . $th->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $keuangan = Keuangan::findOrFail($id);

            // Hapus file bukti pembayaran jika ada
            if ($keuangan->bukti_pembayaran && Storage::disk('public')->exists($keuangan->bukti_pembayaran)) {
                Storage::disk('public')->delete($keuangan->bukti_pembayaran);
            }

            $keuangan->delete();

            return back()->with('success', 'Data keuangan berhasil dihapus.');
        } catch (\Throwable $th) {
            Log::error('Gagal menghapus data keuangan: ' . $th->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
