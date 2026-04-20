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
        Schema::create('pengajuan_details', function (Blueprint $table) {
    $table->id();

    $table->string('kas_bukti_no');
    $table->string('bar_code')->nullable();
    $table->string('bar_name')->nullable();

    $table->decimal('kas_jumlah', 15,2)->default(0);
    $table->decimal('kas_nilai', 15,2)->default(0);
    $table->decimal('kas_total', 15,2)->default(0);

    $table->string('pj_bukti_no')->nullable();

    $table->timestamps();

    $table->foreign('kas_bukti_no')
          ->references('kas_bukti_no')
          ->on('pengajuans')
          ->cascadeOnDelete();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_details');
    }
};
