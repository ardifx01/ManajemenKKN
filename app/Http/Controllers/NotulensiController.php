<?php

namespace App\Http\Controllers;

use App\Models\LaporanKegiatan;
use App\Models\Notulensi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Exception\Exception as WordException;
use Illuminate\Support\Str;

class NotulensiController extends Controller
{
    public function form($id)
    {
        $kegiatan = LaporanKegiatan::with('notulensi')->findOrFail($id);
        return view('notulensi.index', compact('kegiatan'));
    }

    public function generate(Request $request, $id)
    {
        try {
            $kegiatan = LaporanKegiatan::findOrFail($id);

            $validated = $request->validate([
                'nama_kegiatan' => 'required|string|max:255',
                'hasil_kegiatan' => 'required|string',
                'kesimpulan' => 'required|string',
            ]);

            // Update data kegiatan
            $kegiatan->update([
                'nama_kegiatan' => $validated['nama_kegiatan'],
                'hasil_kegiatan' => $validated['hasil_kegiatan'],
            ]);

            // Path ke file template
            $templatePath = storage_path('app/templates/notulensi_template.docx');
            if (!file_exists($templatePath)) {
                return back()->with('error', 'Template file tidak ditemukan.');
            }

            // Format nama dan path file
            $slugNama = Str::slug($kegiatan->nama_kegiatan);
            $tgl = optional($kegiatan->tgl_kegiatan)->format('Ymd') ?? now()->format('Ymd');
            $filename = "notulensi_{$slugNama}_{$tgl}.docx";
            $filePath = "notulensi/{$filename}";

            // Generate file Word
            $templateProcessor = new TemplateProcessor($templatePath);
            $templateProcessor->setValue('nama_kegiatan', $kegiatan->nama_kegiatan);
            $templateProcessor->setValue(
                'tgl_kegiatan',
                $kegiatan->tgl_kegiatan
                    ? Carbon::parse($kegiatan->tgl_kegiatan)->translatedFormat('l, d F Y')
                    : '-'
            );
            $templateProcessor->setValue(
                'waktu_mulai',
                $kegiatan->waktu_mulai ? \Carbon\Carbon::createFromFormat('H:i:s', $kegiatan->waktu_mulai)->format('H.i') : ''
            );
            $templateProcessor->setValue('lokasi_kegiatan', $kegiatan->lokasi_kegiatan);
            $templateProcessor->setValue(
                'pemimpin_rapat',
                $kegiatan->pemimpin_rapat->name ?? '-'
            );
            $templateProcessor->setValue('notulis', $kegiatan->creator->name);
            $templateProcessor->setValue('hasil_kegiatan', $kegiatan->hasil_kegiatan);
            $templateProcessor->setValue('kesimpulan', $request->input('kesimpulan'));
            // Tambahkan setValue lain jika dibutuhkan, misal lokasi_kegiatan dll

            // Pastikan folder storage ada
            Storage::makeDirectory('public/notulensi');

            // Hapus file lama jika sebelumnya sudah ada
            $existing = Notulensi::where('laporan_kegiatan_id', $id)->first();
            if ($existing && Storage::exists("public/{$existing->file_path}")) {
                Storage::delete("public/{$existing->file_path}");
            }

            // Simpan file baru
            $savePath = storage_path("app/public/{$filePath}");
            $templateProcessor->saveAs($savePath);

            // Simpan / update DB
            Notulensi::updateOrCreate(
                ['laporan_kegiatan_id' => $id],
                [
                    'kesimpulan' => $request->input('kesimpulan'),
                    'nama_file' => $filename,
                    'file_path' => $filePath,
                ]
            );

            return back()->with('success', 'Notulensi berhasil dibuat.');
        } catch (\PhpOffice\PhpWord\Exception\Exception $e) {
            Log::error("Gagal proses Word: " . $e->getMessage());
            return back()->with('error', 'Gagal membuat file Word.');
        } catch (\Throwable $th) {
            Log::error("Error generate notulensi: " . $th->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuat notulensi.');
        }
    }
}
