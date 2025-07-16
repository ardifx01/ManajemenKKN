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
        Schema::create('profile_k_k_n_s', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('nama_kelompok');
            $table->string('nama_desa')->nullable();
            $table->foreignId('pembimbing_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_k_k_n_s');
    }
};
