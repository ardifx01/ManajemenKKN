<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\LaporanKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Str;

class BeritaAcaraController extends Controller
{
    public function form($id)
    {
        $kegiatan = LaporanKegiatan::findOrFail($id);
        $bap = BeritaAcara::where('laporan_kegiatan_id', $id)->first();
        return view('berita_acara.index', compact('kegiatan', 'bap'));
    }

    public function generate(Request $request, $id)
    {
        try {
            $kegiatan = LaporanKegiatan::with(['creator', 'pemimpin_rapat'])->findOrFail($id);

            $validated = $request->validate([
                'pokok_bahasan' => 'required|string|max:255',
                'nama_penanggungjawab' => 'nullable|string|max:255',
                'jml_anggota' => 'required|integer|min:1',
                // 'jml_tidak_hadir' => 'nullable|integer|min:0',
                // 'nama_anggota_tidak_hadir' => 'nullable|string',
                'uraian_kejadian' => 'required|string',
                // 'nama_ketua_kelompok' => 'required|string',
            ]);

            // Path ke template
            $templatePath = storage_path('app/templates/bap_template.docx');
            if (!file_exists($templatePath)) {
                return back()->with('error', 'Template Berita Acara tidak ditemukan.');
            }

            // Format nama dan path file
            $slugNama = Str::slug($kegiatan->nama_kegiatan);
            $tgl = optional($kegiatan->tgl_kegiatan)->format('Ymd') ?? now()->format('Ymd');
            $filename = "berita_acara_{$slugNama}_{$tgl}.docx";
            $filePath = "berita_acara/{$filename}";

            // Generate isi file Word
            $templateProcessor = new TemplateProcessor($templatePath);
            // $templateProcessor->setValue('nama_kegiatan', $kegiatan->nama_kegiatan);
            $templateProcessor->setValue('pokok_bahasan', $validated['pokok_bahasan']);
            $templateProcessor->setValue('penanggungjawab', $validated['nama_penanggungjawab'] ?? '-');
            $templateProcessor->setValue('tgl_kegiatan', $request->input('tgl_kegiatan'));
            $templateProcessor->setValue('lokasi', $request->input('lokasi_kegiatan'));
            $templateProcessor->setValue('waktu_mulai', $request->input('waktu_mulai'));
            $templateProcessor->setValue('waktu_selesai', $request->input('waktu_selesai'));
            $templateProcessor->setValue('jml', $validated['jml_anggota']);
            // $templateProcessor->setValue('jml_tidak_hadir', $validated['jml_tidak_hadir'] ?? '0');
            // $templateProcessor->setValue('nama_anggota_tidak_hadir', $validated['nama_anggota_tidak_hadir'] ?? '-');
            $templateProcessor->setValue('uraian_kejadian', $validated['uraian_kejadian']);
            $templateProcessor->setValue('nama_ketua_kelompok', $request->input('nama_ketua_kelompok'));

            // Pastikan folder storage tersedia
            Storage::makeDirectory('public/berita_acara');

            // Hapus file lama jika ada
            $existing = BeritaAcara::where('laporan_kegiatan_id', $id)->first();
            if ($existing && Storage::exists("public/{$existing->file_path}")) {
                Storage::delete("public/{$existing->file_path}");
            }

            // Simpan file baru
            $savePath = storage_path("app/public/{$filePath}");
            $templateProcessor->saveAs($savePath);

            // Simpan atau update record DB
            BeritaAcara::updateOrCreate(
                ['laporan_kegiatan_id' => $id],
                [
                    'pokok_bahasan' => $validated['pokok_bahasan'],
                    'nama_penanggungjawab' => $validated['nama_penanggungjawab'],
                    'jml_anggota' => $validated['jml_anggota'],
                    // 'jml_tidak_hadir' => $validated['jml_tidak_hadir'] ?? 0,
                    // 'nama_anggota_tidak_hadir' => $validated['nama_anggota_tidak_hadir'],
                    'uraian_kejadian' => $validated['uraian_kejadian'],
                    'nama_file' => $filename,
                    'file_path' => $filePath,
                ]
            );

            return back()->with('success', 'Berita Acara berhasil digenerate.');
        } catch (\PhpOffice\PhpWord\Exception\Exception $e) {
            Log::error("Gagal proses Word: " . $e->getMessage());
            return back()->with('error', 'Gagal membuat file Word.');
        } catch (\Throwable $th) {
            Log::error("Error generate berita acara: " . $th->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuat berita acara.');
        }
    }
}
