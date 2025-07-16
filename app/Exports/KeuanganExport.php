<?php

namespace App\Exports;

use App\Models\Keuangan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class KeuanganExport implements FromView
{
    protected $keuangan;
    protected $pemasukan;
    protected $pengeluaran;
    protected $saldo;

    public function __construct($keuangan, $pemasukan, $pengeluaran, $saldo)
    {
        $this->keuangan = $keuangan;
        $this->pemasukan = $pemasukan;
        $this->pengeluaran = $pengeluaran;
        $this->saldo = $saldo;
    }
    public function view(): View
    {
        return view('export.keuangan-excel', [
            'data' => $this->keuangan,
            'pemasukan' => $this->pemasukan,
            'pengeluaran' => $this->pengeluaran,
            'saldo' => $this->saldo
        ]);
    }
}
