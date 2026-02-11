<?php

namespace App\Providers;

use App\Models\PembayaranDenda;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->role_id == 1;
        });

        Gate::define('user', function (User $user) {
            return $user->role_id == 2;
        });

        Gate::define('admin-user', function (User $user) {
            return in_array($user->role_id, [1, 2]);
        });

        if (app()->runningInConsole()) return;

        $today = Carbon::today();

        $transaksiTerlambat = Transaksi::where('status', 1)
            ->whereDate('tanggal_kembali', '<', $today)
            ->get();

        foreach ($transaksiTerlambat as $trx) {
            $hariTelat = Carbon::parse($trx->tanggal_kembali)
                ->diffInDays($today);

            $totalDenda = $hariTelat * $trx->total_pinjam * 2000;

            PembayaranDenda::updateOrCreate(
                // kondisi pencarian
                ['transaksi_id' => $trx->id_transaksi],

                // data yang diinsert / update
                [
                    'user_id' => $trx->user_id,
                    'total_denda' => $totalDenda,
                    'status_denda' => 'belum_bayar',
                ]
            );
        }
    }
}
