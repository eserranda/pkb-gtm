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
        Schema::table('jadwal_ibadahs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jemaat')->nullable()->after('id');
            $table->foreign('id_jemaat')->references('id')->on('jemaats')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_ibadahs', function (Blueprint $table) {
            $table->dropColumn('id_jemaat');
            $table->dropForeign(['id_jemaat']);
        });
    }
};