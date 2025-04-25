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
        Schema::create('pengajuan_penarikans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekening_nasabah_id')->constrained('rekening_nasabah')->cascadeOnDelete();
            $table->decimal('jumlah_diajukan', 15, 2);
            $table->enum('metode', ['e-wallet', 'tunai']);
            $table->string('jenis_e_wallet')->nullable();
            $table->string('nomor_e_wallet')->nullable();
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_penarikans');
    }
};
