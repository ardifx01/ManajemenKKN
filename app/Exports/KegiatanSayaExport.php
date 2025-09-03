<?php

namespace App\Exports;

use App\Models\LaporanKegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class KegiatanSayaExport implements FromView
{
    protected $kegiatansaya;

    public function __construct($kegiatansaya)
    {
        $this->kegiatansaya = $kegiatansaya;
    }
    public function view(): View
    {
        return view('export.kegiatan-saya-excel', [
            'data' => $this->kegiatansaya,
            'auth' => Auth::user(),
        ]);
    }
}
