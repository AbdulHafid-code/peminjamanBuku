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
        Schema::table('Transaksi', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id_user')
                ->on('User')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('buku_id')
                ->references('id_buku')
                ->on('Buku')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Transaksi', function (Blueprint $table) {});
    }
};
