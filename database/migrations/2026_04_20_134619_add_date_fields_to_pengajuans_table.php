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
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dateTime('date_setujui')->nullable()->after('status_setujui');
            $table->dateTime('date_proses')->nullable()->after('status_proses');
        });
    }

    public function down(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropColumn(['date_setujui', 'date_proses']);
        });
    }
};
