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
            $table->unsignedBigInteger('id_klasis')->nullable()->after('id');
            $table->foreign('id_klasis')->references('id')->on('klases')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggota_jemaats', function (Blueprint $table) {
            $table->dropForeign(['id_klasis']);
            $table->dropColumn('id_klasis');
        });
    }
};
