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
        Schema::create('Buku', function (Blueprint $table) {
            $table->id('id_buku');
            $table->string('kode_buku')->unique();
            $table->string('judul_buku', 255);
            $table->string('penulis', 255);
            $table->string('penerbit', 255);
            $table->date('tanggal_terbit');
            $table->foreignId('kategori_id');
            $table->integer('stok')->default(0);
            $table->string('sampul');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Buku');
    }
};
