<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');

        $jabatan = Jabatan::when($search, function ($query) use ($search) {
            return $query->where('nama_jabatan', 'like', '%' . $search . '%');
        })
            ->paginate($perPage)
            ->appends(request()->query());

        return view('jabatan.index', compact('jabatan'))
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
            $validateData = $request->validate([
                'nama_jabatan' => 'required|string|max:100',
            ], [
                'nama_jabatan.required' => 'Nama jabatan tidak boleh kosong',
            ]);

            Jabatan::create($validateData);
            return back()->with('success', 'Data jabatan "' . $validateData['nama_jabatan'] . '" berhasil ditambahkan.');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('add', true);
        } catch (\Throwable $th) {
            Log::error('Error saat menyimpan data: ' . $th->getMessage());
            return back()->with('error', 'Gagal menyimpan data' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'nama_jabatan' => 'required|string|max:100',
            ], [
                'nama_jabatan.required' => 'Nama jabatan tidak boleh kosong',
            ]);

            Jabatan::findOrFail($id)->update($validateData);
            return back()->with('success', 'Data jabatan "' . $validateData['nama_jabatan'] . '" berhasil diubah.');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('edit_id', $id);
        } catch (\Throwable $th) {
            Log::error('Error saat menyimpan data: ' . $th->getMessage());
            return back()->with('error', 'Gagal menyimpan data' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $nama = $jabatan->nama_jabatan;
        $jabatan->delete();

        return back()->with('success', 'Data jabatan "' . $nama . '" berhasil dihapus.');
    }
}
