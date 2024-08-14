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
        Schema::table('klases', function (Blueprint $table) {
            $table->string('koordinator')->nullable()->after('nama_klasis');
            $table->string('no_telp')->nullable()->after('koordinator');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('klases', function (Blueprint $table) {
            $table->dropColumn(['koordinator', 'no_telp']);
        });
    }
};
