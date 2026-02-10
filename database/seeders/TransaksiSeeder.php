<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('transaksi')->insert([
            [
                'buku_id' => 2,
                'user_id' => 2,
                'total_pinjam' => 2,
                'jumlah_dikembalikan' => null,
                'pengajuan_kembali' => null,
                'tanggal_pinjam' => now()->subDays(20),
                'tanggal_kembali' => now()->subDays(10),
                'hari_telat' => 10,
                'denda' => 20000,
                'status_denda' => 'belum_bayar',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'buku_id' => 2,
                'user_id' => 3,
                'total_pinjam' => 1,
                'jumlah_dikembalikan' => 1,
                'pengajuan_kembali' => null,
                'tanggal_pinjam' => now()->subDays(15),
                'tanggal_kembali' => now()->subDays(5),
                'hari_telat' => 0,
                'denda' => 0,
                'status_denda' => null,
                'status' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'buku_id' => 3,
                'user_id' => 4,
                'total_pinjam' => 2,
                'jumlah_dikembalikan' => 1,
                'pengajuan_kembali' => 1,
                'tanggal_pinjam' => now()->subDays(12),
                'tanggal_kembali' => now()->subDays(2),
                'hari_telat' => 2,
                'denda' => 4000,
                'status_denda' => 'belum_bayar',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'buku_id' => 4,
                'user_id' => 5,
                'total_pinjam' => 1,
                'jumlah_dikembalikan' => null,
                'pengajuan_kembali' => null,
                'tanggal_pinjam' => now()->subDays(5),
                'tanggal_kembali' => now()->addDays(5),
                'hari_telat' => 0,
                'denda' => 0,
                'status_denda' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'buku_id' => 5,
                'user_id' => 6,
                'total_pinjam' => 1,
                'jumlah_dikembalikan' => null,
                'pengajuan_kembali' => null,
                'tanggal_pinjam' => now(),
                'tanggal_kembali' => now()->addDays(7),
                'hari_telat' => 0,
                'denda' => 0,
                'status_denda' => null,
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'buku_id' => 6,
                'user_id' => 7,
                'total_pinjam' => 2,
                'jumlah_dikembalikan' => 2,
                'pengajuan_kembali' => null,
                'tanggal_pinjam' => now()->subDays(25),
                'tanggal_kembali' => now()->subDays(15),
                'hari_telat' => 5,
                'denda' => 0,
                'status_denda' => null,
                'status' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'buku_id' => 7,
                'user_id' => 8,
                'total_pinjam' => 1,
                'jumlah_dikembalikan' => null,
                'pengajuan_kembali' => null,
                'tanggal_pinjam' => now()->subDays(10),
                'tanggal_kembali' => now()->subDays(1),
                'hari_telat' => 1,
                'denda' => 2000,
                'status_denda' => 'belum_bayar',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'buku_id' => 8,
                'user_id' => 9,
                'total_pinjam' => 1,
                'jumlah_dikembalikan' => null,
                'pengajuan_kembali' => null,
                'tanggal_pinjam' => now()->subDays(3),
                'tanggal_kembali' => now()->addDays(7),
                'hari_telat' => 0,
                'denda' => 0,
                'status_denda' => null,
                'status' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'buku_id' => 9,
                'user_id' => 10,
                'total_pinjam' => 2,
                'jumlah_dikembalikan' => 1,
                'pengajuan_kembali' => null,
                'tanggal_pinjam' => now()->subDays(18),
                'tanggal_kembali' => now()->subDays(8),
                'hari_telat' => 8,
                'denda' => 16000,
                'status_denda' => 'belum_bayar',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // tambah 6 data lagi kalau mau aku lanjutin
        ]);
    }
}
