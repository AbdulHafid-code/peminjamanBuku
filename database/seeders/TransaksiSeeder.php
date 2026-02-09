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
        $data = [];

        for ($i = 1; $i <= 40; $i++) {

            /* ======================
                TOTAL & STATUS AWAL
            ====================== */
            $totalPinjam = rand(1, 2);
            $status = rand(0, 3); // 0=pending,1=sukses,2=dikembalikan,3=ditolak

            $jumlahDikembalikan = null;
            $pengajuanKembali = null;

            /* ======================
                LOGIC PENGEMBALIAN
            ====================== */
            if ($status !== 0) {

                $jumlahDikembalikan = rand(0, $totalPinjam);
                $sisa = $totalPinjam - $jumlahDikembalikan;

                // jika semua sudah dikembalikan
                if ($jumlahDikembalikan === $totalPinjam) {
                    $status = 2; // dikembalikan
                    $pengajuanKembali = null;
                } else if ($sisa > 0) {
                    $pengajuanKembali = rand(0, $sisa);
                    if ($pengajuanKembali === 0) {
                        $pengajuanKembali = null;
                    }
                }

                if ($jumlahDikembalikan === 0) {
                    $jumlahDikembalikan = null;
                }
            }

            /* ======================
                TANGGAL
            ====================== */
            $tanggalPinjam = Carbon::now()
                ->subDays(rand(10, 30))
                ->startOfDay();

            $tanggalKembali = (clone $tanggalPinjam)
                ->addDays(rand(5, 14))
                ->startOfDay();

            $hariIni = Carbon::now()->startOfDay();

            /* ======================
                LOGIC DENDA
            ====================== */
            if ($tanggalKembali->lt($hariIni)) {

                $hariTelat = $tanggalKembali->diffInDays($hariIni);
                $statusDenda = rand(0, 1) ? 'belum_bayar' : 'lunas';

                $denda = ($statusDenda === 'belum_bayar')
                    ? $hariTelat * 2000
                    : 0;
            } else {
                $hariTelat = 0;
                $denda = 0;
                $statusDenda = 'lunas';
            }

            /* ======================
                INSERT DATA
            ====================== */
            $data[] = [
                'buku_id' => rand(1, 15),
                'user_id' => rand(2, 40),
                'total_pinjam' => $totalPinjam,
                'jumlah_dikembalikan' => $jumlahDikembalikan,
                'pengajuan_kembali' => $pengajuanKembali,
                'tanggal_pinjam' => $tanggalPinjam->toDateString(),
                'tanggal_kembali' => $tanggalKembali->toDateString(),
                'hari_telat' => $hariTelat,
                'denda' => $denda,
                'status_denda' => $statusDenda,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('Transaksi')->insert($data);
    }
}
