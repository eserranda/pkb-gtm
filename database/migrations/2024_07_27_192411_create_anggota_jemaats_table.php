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
        Schema::create('anggota_jemaats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jemaat');
            $table->foreign('id_jemaat')->references('id')->on('jemaats')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama_anggota');
            $table->string('gender');
            $table->string('alamat');
            $table->string('status_tempat_tinggal');
            $table->string('no_telp');
            $table->integer('mulai_berjemaat');
            $table->string('status_pernikahan');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->boolean('baptis');
            $table->boolean('sidi');
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->date('tgl_pernikahan')->nullable();
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_jemaats');
    }
};
