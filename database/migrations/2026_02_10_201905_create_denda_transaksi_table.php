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
        Schema::create('pembayaran_denda', function (Blueprint $table) {
            $table->id('id_pembayaran_denda');

            // relasi
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('user_id');

            // nilai denda
            $table->integer('total_denda');
            $table->integer('total_dibayar')->default(0);

            // metode & status
            $table->enum('metode_bayar', ['cash', 'transfer', 'qris'])
                ->nullable();

            $table->enum('status_denda', ['belum_bayar', 'sebagian', 'lunas'])
                ->default('belum_bayar');

            $table->string('keterangan')->nullable();
            $table->timestamps();

            // foreign keys
            $table->foreign('transaksi_id')
                ->references('id_transaksi')
                ->on('Transaksi')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id_user')
                ->on('User')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denda_transaksi');
    }
};
