<?php

namespace App\Exports;

use App\Models\LaporanKegiatan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class KegiatanExport implements FromView
{
    protected $kegiatan;

    public function __construct($kegiatan)
    {
        $this->kegiatan = $kegiatan;
    }
    public function view(): View
    {
        return view('export.kegiatan-excel', [
            'data' => $this->kegiatan,
        ]);
    }
}
