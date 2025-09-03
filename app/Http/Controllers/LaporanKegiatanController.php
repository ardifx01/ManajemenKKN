<?php

namespace App\Http\Controllers;

use App\Exports\KegiatanExport;
use App\Models\LaporanKegiatan;
use App\Models\Proker;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kegiatan = LaporanKegiatan::with('creator')->get();

        if (request()->startDate && request()->endDate && request()->proker_id) {
            $kegiatan = LaporanKegiatan::with('creator')->whereBetween('tgl_kegiatan', [request()->startDate, request()->endDate])
                ->get();
        } elseif (request()->startDate && request()->endDate) {
            $kegiatan = LaporanKegiatan::with('creator')->whereBetween('tgl_kegiatan', [request()->startDate, request()->endDate])
                ->get();
        } elseif (request()->proker_id) {
            $kegiatan = LaporanKegiatan::with('creator')->where('proker_id', request()->proker_id)
                ->get();
        }

        $proker = Proker::all();

        return view('laporanKegiatan.index', compact('kegiatan', 'proker'));
    }

    public function xls()
    {
        $kegiatan = LaporanKegiatan::with('creator')->get();

        if (request()->startDate && request()->endDate && request()->proker_id) {
            $kegiatan = LaporanKegiatan::with('creator')->whereBetween('tgl_kegiatan', [request()->startDate, request()->endDate])
                ->get();
        } elseif (request()->startDate && request()->endDate) {
            $kegiatan = LaporanKegiatan::with('creator')->whereBetween('tgl_kegiatan', [request()->startDate, request()->endDate])
                ->get();
        } elseif (request()->proker_id) {
            $kegiatan = LaporanKegiatan::with('creator')->where('proker_id', request()->proker_id)
                ->get();
        }

        return Excel::download(new KegiatanExport($kegiatan), 'laporan-kegiatan.xlsx');
    }

    public function pdf()
    {
        $kegiatan = LaporanKegiatan::with('creator')->get();

        if (request()->startDate && request()->endDate && request()->proker_id) {
            $kegiatan = LaporanKegiatan::with('creator')->whereBetween('tgl_kegiatan', [request()->startDate, request()->endDate])
                ->get();
        } elseif (request()->startDate && request()->endDate) {
            $kegiatan = LaporanKegiatan::with('creator')->whereBetween('tgl_kegiatan', [request()->startDate, request()->endDate])
                ->get();
        } elseif (request()->proker_id) {
            $kegiatan = LaporanKegiatan::with('creator')->where('proker_id', request()->proker_id)
                ->get();
        }

        Log::info('PDF PUBLIC PATH: ' . config('dompdf.public_path'));
        $pdf = Pdf::loadView('export.kegiatan-pdf', ['data' => $kegiatan]);
        return $pdf->download('laporan-kegiatan.pdf');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanKegiatan $laporanKegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanKegiatan $laporanKegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanKegiatan $laporanKegiatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanKegiatan $laporanKegiatan)
    {
        //
    }
}
