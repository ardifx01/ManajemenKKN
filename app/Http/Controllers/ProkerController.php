<?php

namespace App\Http\Controllers;

use App\Models\Proker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ProkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');

        $proker = Proker::when($search, function ($query) use ($search) {
            return $query->where('nama_proker', 'like', '%' . $search . '%');
        })
            ->paginate($perPage)
            ->appends(request()->query());

        return view('proker.index', compact('proker'))
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
                'nama_proker'   => 'required|string|max:255',
                'jenis_proker'  => 'required|in:internal,eksternal',
                'sasaran'       => 'required|string|max:255',
                'deskripsi'     => 'required|string',
                'tgl_mulai'     => 'nullable|date',
                'tgl_selesai'   => 'nullable|date|after_or_equal:tgl_mulai',
                'status'        => 'required|in:pending,berjalan,selesai',
            ], [
                'nama_proker.required' => 'Nama program kerja tidak boleh kosong',
                'jenis_proker.required' => 'Jenis program kerja harus dipilih',
                'jenis_proker.in' => 'Jenis program kerja tidak valid',
                'sasaran.required' => 'Sasaran tidak boleh kosong',
                'deskripsi.required' => 'Deskripsi tidak boleh kosong',
                'tgl_mulai.date' => 'Tanggal mulai tidak valid',
                'tgl_selesai.date' => 'Tanggal selesai tidak valid',
                'tgl_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai',
                'status.required' => 'Status harus dipilih',
                'status.in' => 'Status tidak valid'
            ]);

            Proker::create($validatedData);

            return back()->with('success', 'Data program kerja "' . $validatedData['nama_proker'] . '" berhasil ditambahkan.');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('add', true);
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan proker: ' . $th->getMessage());
            return back()->with('error', 'Gagal menyimpan data: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Proker $proker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proker $proker)
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
                'nama_proker'   => 'required|string|max:255',
                'jenis_proker'  => 'required|in:internal,eksternal',
                'sasaran'       => 'required|string|max:255',
                'deskripsi'     => 'required|string',
                'tgl_mulai'     => 'nullable|date',
                'tgl_selesai'   => 'nullable|date|after_or_equal:tgl_mulai',
                'status'        => 'required|in:pending,berjalan,selesai',
            ], [
                'nama_proker.required' => 'Nama program kerja tidak boleh kosong',
                'jenis_proker.required' => 'Jenis program kerja harus dipilih',
                'jenis_proker.in' => 'Jenis program kerja tidak valid',
                'sasaran.required' => 'Sasaran tidak boleh kosong',
                'deskripsi.required' => 'Deskripsi tidak boleh kosong',
                'tgl_mulai.date' => 'Tanggal mulai tidak valid',
                'tgl_selesai.date' => 'Tanggal selesai tidak valid',
                'tgl_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai',
                'status.required' => 'Status harus dipilih',
                'status.in' => 'Status tidak valid'
            ]);

            $proker = Proker::findOrFail($id);
            $proker->update($validatedData);

            return back()->with('success', 'Data program kerja "' . $validatedData['nama_proker'] . '" berhasil diperbarui.');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('edit_id', $id); // opsional: tanda bahwa ini dari modal edit
        } catch (\Throwable $th) {
            Log::error('Gagal mengupdate proker: ' . $th->getMessage());
            return back()->with('error', 'Gagal memperbarui data: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proker = Proker::findOrFail($id);
        $nama = $proker->nama_proker;
        $proker->delete();

        return back()->with('success', 'Data proker "' . $nama . '" berhasil dihapus.');
    }
}
