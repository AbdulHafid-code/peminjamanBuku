<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksi')->insert([
            [
                'id_transaksi' => 1,
                'user_id' => 2,
                'buku_id' => 1,
                'total_pinjam' => 1,
                'tanggal_pinjam' => now()->subDays(3),
                'tanggal_kembali' => now()->addDays(4),
                'status' => 0, // Dipinjam
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_transaksi' => 2,
                'user_id' => 3,
                'buku_id' => 2,
                'total_pinjam' => 2,
                'tanggal_pinjam' => now()->subDays(7),
                'tanggal_kembali' => now()->subDays(1),
                'status' => 1, // Selesai
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_transaksi' => 3,
                'user_id' => 5,
                'buku_id' => 4,
                'total_pinjam' => 1,
                'tanggal_pinjam' => now()->subDays(1),
                'tanggal_kembali' => now()->addDays(6),
                'status' => 0, // Dipinjam
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_transaksi' => 4,
                'user_id' => 7,
                'buku_id' => 7,
                'total_pinjam' => 1,
                'tanggal_pinjam' => now()->subDays(10),
                'tanggal_kembali' => now()->subDays(3),
                'status' => 1, // Selesai
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_transaksi' => 5,
                'user_id' => 10,
                'buku_id' => 9,
                'total_pinjam' => 1,
                'tanggal_pinjam' => now()->subDays(2),
                'tanggal_kembali' => now()->addDays(5),
                'status' => 0, // Dipinjam
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
