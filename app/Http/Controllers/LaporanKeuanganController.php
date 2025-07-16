<?php

namespace App\Http\Controllers;

use App\Exports\KeuanganExport;
use App\Models\Keuangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keuangan = Keuangan::all();

        if (request()->startDate && request()->endDate && request()->jenis) {
            $keuangan = Keuangan::with('creator')->whereBetween('tanggal', [request()->startDate, request()->endDate])
                ->get();
        } elseif (request()->startDate && request()->endDate) {
            $keuangan = Keuangan::with('creator')->whereBetween('tanggal', [request()->startDate, request()->endDate])
                ->get();
        } elseif (request()->jenis) {
            $keuangan = Keuangan::with('creator')->where('jenis', request()->jenis)
                ->get();
        }

        $pengeluaran = $keuangan->where('jenis', 'pengeluaran')->sum('nominal');
        $pemasukan = $keuangan->where('jenis', 'pemasukan')->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;

        return view('laporanKeuangan.index', compact('keuangan', 'pengeluaran', 'pemasukan', 'saldo'));
    }

    public function xls()
    {
        $keuangan = Keuangan::all();

        if (request()->startDate && request()->endDate && request()->jenis) {
            $keuangan = Keuangan::with('creator')->whereBetween('tanggal', [request()->startDate, request()->endDate])
                ->get();
        } elseif (request()->startDate && request()->endDate) {
            $keuangan = Keuangan::with('creator')->whereBetween('tanggal', [request()->startDate, request()->endDate])
                ->get();
        } elseif (request()->jenis) {
            $keuangan = Keuangan::with('creator')->where('jenis', request()->jenis)
                ->get();
        }

        $pengeluaran = $keuangan->where('jenis', 'pengeluaran')->sum('nominal');
        $pemasukan = $keuangan->where('jenis', 'pemasukan')->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;

        return Excel::download(new KeuanganExport($keuangan, $pengeluaran, $pemasukan, $saldo), 'laporan-keuangan.xlsx');
    }

    public function pdf()
    {
        $keuangan = Keuangan::all();

        if (request()->startDate && request()->endDate && request()->jenis) {
            $keuangan = Keuangan::with('creator')->whereBetween('tanggal', [request()->startDate, request()->endDate])
                ->get();
        } elseif (request()->startDate && request()->endDate) {
            $keuangan = Keuangan::with('creator')->whereBetween('tanggal', [request()->startDate, request()->endDate])
                ->get();
        } elseif (request()->jenis) {
            $keuangan = Keuangan::with('creator')->where('jenis', request()->jenis)
                ->get();
        }

        $pengeluaran = $keuangan->where('jenis', 'pengeluaran')->sum('nominal');
        $pemasukan = $keuangan->where('jenis', 'pemasukan')->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;

        $pdf = Pdf::loadView('export.keuangan-pdf', ['data' => $keuangan, 'pengeluaran' => $pengeluaran, 'pemasukan' => $pemasukan, 'saldo' => $saldo]);
        return $pdf->download('laporan-keuangan.pdf');
    }

    // public function xls()
    // {
    //     // $keuangan = Keuangan::with('creator')->limit(5)->get();

    //     return Excel::download(new KeuanganExport, 'laporan-keuangan.xlsx');
    // }

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
        //
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
        //
    }
}
