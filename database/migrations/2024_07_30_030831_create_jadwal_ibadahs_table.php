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
        Schema::create('jadwal_ibadahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_anggota_pkb');
            $table->foreign('id_anggota_pkb')->references('id')->on('anggota_p_k_b_s')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('kelompok');
            $table->date('tanggal');
            $table->string('pelayan_firman');
            $table->string('mc');
            $table->string('persembahan');
            $table->string('kolektan');
            $table->string('lelang');
            $table->string('tempat_ibadah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_ibadahs');
    }
};