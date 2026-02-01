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
        Schema::create('Transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('buku_id');
            $table->foreignId('user_id');
            $table->integer('total_pinjam')->default(1);
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->tinyInteger('status')->default(0)->comment('0=pending,1=sukses,2=Dikembalikan,3=Ditolak'); // 0: Dipinjam, 1: Dikembalikan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Transaksi');
    }
};
