<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class UserManajemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');

        $users = User::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })
            ->paginate($perPage)
            ->appends(request()->query());
        $jabatan = Jabatan::all();
        return view('userManajemen.index', compact('users', 'jabatan'))
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
                'name'        => 'required|string|max:100',
                'prodi'       => 'required|in:Manajemen Informatika,Manajemen Pemasaran,Manajemen Keuangan & Perbankan,Administrasi Bisnis',
                'email'       => 'required|email|unique:users,email',
                'password'    => 'required|confirmed|min:8',
                'telepon'     => 'nullable|numeric|digits_between:11,13|unique:users,telepon',
                'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'jabatan_id'  => 'nullable|exists:jabatans,id',
                'role'        => 'required|in:admin,pembimbing,ketua,wakil,bendahara,sekretaris,user',
            ], [
                'name.required'       => 'Nama tidak boleh kosong',
                'prodi.required'      => 'Program Studi tidak boleh kosong',
                'prodi.in'            => 'Program Studi tidak valid',
                'email.required'      => 'Email tidak boleh kosong',
                'email.unique'        => 'Email telah terdaftar',
                'email.email'         => 'Format email tidak valid',
                'password.required'   => 'Password tidak boleh kosong',
                'password.min'        => 'Password minimal 8 karakter',
                'password.confirmed'  => 'Konfirmasi password tidak sama',
                'telepon.numeric'     => 'Nomor telepon harus angka',
                'telepon.digits_between' => 'Nomor telepon harus 11-13 digit',
                'telepon.unique'      => 'Nomor telepon sudah terdaftar',
                'foto.image'          => 'Foto harus berupa gambar',
                'foto.mimes'          => 'Format foto harus jpeg, png, atau jpg',
                'foto.max'            => 'Ukuran foto maksimal 2MB',
                'jabatan_id.exists'   => 'Jabatan tidak valid',
                'role.required'       => 'Role harus dipilih',
                'role.in'             => 'Role tidak valid'
            ]);

            // Upload foto jika ada
            if ($request->hasFile('foto')) {
                $validatedData['foto'] = $request->file('foto')->store('foto_users', 'public');
            }

            // Enkripsi password
            $validatedData['password'] = bcrypt($validatedData['password']);

            User::create($validatedData);

            return back()->with('success', 'Data user "' . $validatedData['name'] . '" berhasil ditambahkan.');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('add', true);
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan user: ' . $th->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
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
                'name'        => 'required|string|max:100',
                'prodi'       => 'nullable|in:Manajemen Informatika,Manajemen Pemasaran,Manajemen Keuangan & Perbankan,Administrasi Bisnis',
                'email'       => 'required|email|unique:users,email,' . $id,
                // 'password'    => 'required|confirmed|min:8',
                'telepon'     => 'nullable|numeric|digits_between:11,13|unique:users,telepon,' . $id,
                'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'jabatan_id'  => 'nullable|exists:jabatans,id',
                'role'        => 'required|in:admin,pembimbing,ketua,wakil,bendahara,sekretaris,user',
            ], [
                'name.required'       => 'Nama tidak boleh kosong',
                'prodi.in'            => 'Program Studi tidak valid',
                'email.required'      => 'Email tidak boleh kosong',
                'email.unique'        => 'Email telah terdaftar',
                'email.email'         => 'Format email tidak valid',
                // 'password.required'   => 'Password tidak boleh kosong',
                // 'password.min'        => 'Password minimal 8 karakter',
                // 'password.confirmed'  => 'Konfirmasi password tidak sama',
                'telepon.numeric'     => 'Nomor telepon harus angka',
                'telepon.digits_between' => 'Nomor telepon harus 11-13 digit',
                'telepon.unique'      => 'Nomor telepon sudah terdaftar',
                'foto.image'          => 'Foto harus berupa gambar',
                'foto.mimes'          => 'Format foto harus jpeg, png, atau jpg',
                'foto.max'            => 'Ukuran foto maksimal 2MB',
                'jabatan_id.exists'   => 'Jabatan tidak valid',
                'role.required'       => 'Role harus dipilih',
                'role.in'             => 'Role tidak valid'
            ]);

            // Upload foto jika ada
            if ($request->hasFile('foto')) {
                $validatedData['foto'] = $request->file('foto')->store('foto_user', 'public');
            }

            // Enkripsi password
            // $validatedData['password'] = bcrypt($validatedData['password']);

            User::findOrFail($id)->update($validatedData);

            return back()->with('success', 'Data user "' . $validatedData['name'] . '" berhasil diubah.');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('edit_id', $id);
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan user: ' . $th->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage());
        }
    }
    public function resetPassword(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'password'    => 'required|confirmed|min:8',
            ], [
                'password.required'   => 'Password tidak boleh kosong',
                'password.min'        => 'Password minimal 8 karakter',
                'password.confirmed'  => 'Konfirmasi password tidak sama',
            ]);

            // Enkripsi password
            $validatedData['password'] = bcrypt($validatedData['password']);

            User::findOrFail($id)->update($validatedData);

            return back()->with('success', 'Password berhasil diubah.');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('reset_password', $id);
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan user: ' . $th->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $nama = $user->name;
        $user->delete();

        return back()->with('success', 'Data user "' . $nama . '" berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
