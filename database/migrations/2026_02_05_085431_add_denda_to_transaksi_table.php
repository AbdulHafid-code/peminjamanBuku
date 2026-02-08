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
        Schema::table('transaksi', function (Blueprint $table) {
            $table->integer('hari_telat')->default(0)->after('tanggal_kembali');
            $table->integer('denda')->default(0)->after('hari_telat');
            $table->enum('status_denda', ['belum_bayar', 'lunas'])->default('belum_bayar')->after('denda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn([
                'hari_telat',
                'denda',
                'status_denda',
            ]);
        });
    }
};
