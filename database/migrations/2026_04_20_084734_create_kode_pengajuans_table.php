<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('kode_pengajuans', function (Blueprint $table) {
    $table->id();
    $table->string('pj_code');
    $table->string('pj_sub_code')->nullable();
    $table->string('pj_name');
    $table->text('pj_ket')->nullable(); // ✅ tambah di sini
    $table->string('cab_code')->nullable();
    $table->string('usaha_code')->nullable();
    $table->string('gud_code')->nullable();
    $table->decimal('saldo', 15, 2)->default(0);
    $table->string('update_ip')->nullable();
    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_pengajuans');
    }
};
