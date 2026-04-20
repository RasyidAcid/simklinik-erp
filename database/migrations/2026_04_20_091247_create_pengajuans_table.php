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
        Schema::create('pengajuans', function (Blueprint $table) {
    $table->id();

    $table->string('kas_bukti_no')->unique();
    $table->date('kas_bukti_date')->nullable();
    $table->string('pj_bukti_no')->nullable();

    $table->string('clien_code')->nullable();
    $table->decimal('kas_value', 15,2)->default(0);

    $table->string('usaha_code')->nullable();
    $table->string('cab_code')->nullable();

    $table->text('kas_keperluan')->nullable();
    $table->text('kas_notes')->nullable();

    $table->string('status_setujui')->default('draft');

    $table->string('pj_code')->nullable();
    $table->string('user_login')->nullable();

    $table->string('update_ip')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
