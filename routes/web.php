<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kategori', [HomeController::class, 'kategori'])->name('kategori.home');
Route::get('/buku', [HomeController::class, 'buku'])->name('buku.home');
Route::get('/buku_detail/{id_buku}', [HomeController::class, 'buku_detail'])->name('buku_detail');

Route::middleware('guest')->group(function () {
    Route::get('/authentication', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::prefix('dashboard')->middleware(['auth', 'statusAkun'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');

    // landing
    Route::get('/',  [DashboardController::class, 'index'])->name('dashboard');

    // edit profil
    Route::get('/editprofil',  [DashboardController::class, 'edit_profil'])->name('edit_profil');
    Route::put('edit_profil.post', [DashboardController::class, 'edit_profil_post'])->name('edit_profil.post');
    Route::put('edit_password', [DashboardController::class, 'edit_password'])->name('edit_password');

    // prosestransaksinya user
    Route::post('/transaksi_pinjam', [DashboardController::class, 'transaksi_pinjam'])->name('transaksi_pinjam');

    // mengajukan mengembalikan
    Route::post('/pengajuan_kembali/{id}', [DashboardController::class, 'pengajuan_kembali'])->name('mengajukan');
    Route::post('/membatalkan_pengajuan/{id}', [DashboardController::class, 'membatalkan_pengajuan'])->name('membatalkan');
    Route::post('terima_pengajuan/{id}', [DashboardController::class, 'terima_pengajuan'])->name('menerima');

    //denda 
    Route::get('/denda', [DashboardController::class, 'denda'])->name('denda');
    Route::put('/denda/{id}', [DashboardController::class, 'bayar'])->name('denda.bayar');


    Route::middleware('role:2')->group(function () {
        // riwayat
        Route::get('/riwayat', [DashboardController::class, 'riwayat'])->name('riwayat');

        // buku favorit
        Route::get('/favorit', [DashboardController::class, 'favorit'])->name('favorit');
        Route::post('/favorit/{id_buku}', [DashboardController::class, 'favorit_toggle'])->name('favorit_toggle');
        Route::delete('/favorit/{id_buku}', [DashboardController::class, 'favorit_delete'])->name('favorit_delete');

    });

    Route::middleware('role:1')->group(function () {

        // pengajuannya user
        Route::get('/pengajuan', [DashboardController::class, 'pengajuan'])->name('pengajuan');

        // transaksi
        Route::resource('/transaksi', TransaksiController::class);
        Route::put('/transaksi/Editstatus/{id}/{status}', [TransaksiController::class, 'edit_status'])->name('edit_status_transaksi');
        
        // data user
        Route::resource('/user', UserController::class);
        Route::get('/aktifasi-user', [UserController::class, 'aktifasi'])->name('aktifasi');
        Route::get('/nonaktif-user', [UserController::class, 'nonaktif'])->name('nonaktif');

        Route::resource('/buku', BukuController::class);
        Route::resource('/kategori', KategoriController::class);
        Route::resource('/role', RoleController::class);
        
        Route::post('/ubahStatus/{id_user}', [UserController::class, 'ubahStatus'])->name('status');

    });

    Route::resource('/profil', DashboardController::class);
});