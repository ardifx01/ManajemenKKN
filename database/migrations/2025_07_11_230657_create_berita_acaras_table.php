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
        Schema::create('berita_acaras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_kegiatan_id')->constrained('laporan_kegiatans')->onDelete('cascade');
            $table->string('pokok_bahasan');
            $table->string('nama_penanggungjawab')->nullable();
            $table->integer('jml_anggota');
            // $table->integer('jml_tidak_hadir')->nullable();
            // $table->text('nama_anggota_tidak_hadir')->nullable();
            $table->text('uraian_kejadian');
            $table->string('nama_file');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_acaras');
    }
};
