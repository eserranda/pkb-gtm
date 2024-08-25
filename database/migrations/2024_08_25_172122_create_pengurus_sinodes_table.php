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
        Schema::create('pengurus_sinodes', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('no_tlp');
            $table->string('tahun_mulai');
            $table->string('tahun_selesai');
            // $table->string('ketua_umum');
            // $table->string('ketua_satu');
            // $table->string('ketua_dua');
            // $table->string('ketua_tiga');
            // $table->string('sekretaris_umum');
            // $table->string('wakil_sekretaris');
            // $table->string('bendahara');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengurus_sinodes');
    }
};
