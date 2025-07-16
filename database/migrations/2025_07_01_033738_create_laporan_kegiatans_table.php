<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proker_id')->nullable()->constrained('prokers')->nullOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->string('nama_kegiatan');
            $table->foreignId('pemimpin_rapat_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('tgl_kegiatan');
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->string('lokasi_kegiatan');
            $table->text('deskripsi_kegiatan');
            $table->text('hasil_kegiatan')->nullable();
            $table->text('kendala_kegiatan')->nullable();
            $table->text('link_dokumentasi_foto')->nullable();
            $table->text('link_dokumentasi_video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kegiatans');
    }
};
