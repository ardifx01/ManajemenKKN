<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Models\LaporanKegiatan;
use App\Models\Proker;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kegiatans = LaporanKegiatan::where('tgl_kegiatan', today())->get();
        $proker = Proker::orderBy('tgl_mulai', 'asc')->get();

        $keuangan = Keuangan::all();
        $pengeluaran = $keuangan->where('jenis', 'pengeluaran')->sum('nominal');
        $pemasukan = $keuangan->where('jenis', 'pemasukan')->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;

        return view('dashboard', compact('kegiatans', 'proker', 'saldo'));
    }
}
