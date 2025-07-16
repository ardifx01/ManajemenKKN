<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\ProfileKKN;
use App\Models\Proker;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        $anggotas = StrukturOrganisasi::with('user')->orderBy('urutan', 'asc')->get();
        $proker = Proker::all();
        $desa = ProfileKKN::latest()->first();
        return view('welcome', compact('anggotas', 'desa', 'proker'));
    }
}
