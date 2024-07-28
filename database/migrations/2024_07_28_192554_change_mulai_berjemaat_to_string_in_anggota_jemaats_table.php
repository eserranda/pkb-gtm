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
        Schema::table('anggota_jemaats', function (Blueprint $table) {
            $table->string('mulai_berjemaat')->change();
            $table->string('keterangan')->nullable()->change();
            $table->string('no_telp')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggota_jemaats', function (Blueprint $table) {
            $table->date('mulai_berjemaat')->change();
            $table->string('keterangan')->change();
            $table->string('no_telp')->change();
        });
    }
};
