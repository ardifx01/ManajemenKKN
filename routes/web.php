<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\BeritaAcaraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guest\IndexController;
use App\Http\Controllers\Guest\KotakPesanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LaporanKegiatanController;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\NotulensiController;
use App\Http\Controllers\PengumpulPesanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileKKNController;
use App\Http\Controllers\ProkerController;
use App\Http\Controllers\StrukturOrganisasiCOntroller;
use App\Http\Controllers\UserManajemenController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [IndexController::class, 'index']);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::post('/contact', [KotakPesanController::class, 'store'])->name('contact.store');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/proker', ProkerController::class);
    Route::resource('/kegiatan', KegiatanController::class);
    Route::resource('/absensi', AbsensiController::class);
    Route::get('/absensi/print/{id}', [AbsensiController::class, 'print'])->name('absensi.print');
    Route::get('/notulensi/generate/{id}', [NotulensiController::class, 'form'])->name('notulensi.generate.form');
    Route::put('/notulensi/generate/{id}', [NotulensiController::class, 'generate'])->name('notulensi.generate');
    Route::get('/berita_acara/generate/{id}', [BeritaAcaraController::class, 'form'])->name('berita_acara.generate.form');
    Route::post('/berita_acara/generate/{id}', [BeritaAcaraController::class, 'generate'])->name('berita_acara.generate');

    Route::resource('/keuangan', KeuanganController::class);
    Route::resource('/laporan-kegiatan', LaporanKegiatanController::class);
    Route::get('/laporankegiatan-saya/xls', [KegiatanController::class, 'xls'])->name('laporan-kegiatan-saya.xls');
    Route::get('/laporankegiatan/xls', [LaporanKegiatanController::class, 'xls'])->name('laporan-kegiatan.xls');
    Route::get('/laporankegiatan/pdf', [LaporanKegiatanController::class, 'pdf'])->name('laporan-kegiatan.pdf');
    Route::resource('/laporan-keuangan', LaporanKeuanganController::class);
    Route::get('/laporankeuangan/xls', [LaporanKeuanganController::class, 'xls'])->name('laporan-keuangan.xls');
    Route::get('/laporankeuangan/pdf', [LaporanKeuanganController::class, 'pdf'])->name('laporan-keuangan.pdf');
    Route::resource('/kotak-pesan', PengumpulPesanController::class);



    Route::get('user/export-xls', [UserManajemenController::class, 'exportExcel'])->name('user.export-xls');
    Route::resource('/user-manajemen', UserManajemenController::class);
    Route::put('/reset-password/{id}', [UserManajemenController::class, 'resetPassword'])->name('user-manajemen.resetPassword');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/jabatan', JabatanController::class);
    Route::resource('/profil-kkn', ProfileKKNController::class);
    Route::resource('/struktur-organisasi', StrukturOrganisasiCOntroller::class);
});
require __DIR__ . '/auth.php';
