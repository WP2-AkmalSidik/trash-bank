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
        Schema::create('transaksi_tabungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekening_nasabah_id')->constrained('rekening_nasabah')->cascadeOnDelete();
            $table->foreignId('jenis_sampah_id')->nullable()->constrained('jenis_sampah')->nullOnDelete();
            $table->enum('tipe', ['tabung', 'tarik']);
            $table->decimal('berat_kg', 10, 2)->nullable();
            $table->decimal('jumlah_rupiah', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_tabungans');
    }
};
