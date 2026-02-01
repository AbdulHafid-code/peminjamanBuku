<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Buku;
use Carbon\Carbon;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $guarded = [
        'id_transaksi'
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function buku() {
        return $this->belongsTo(Buku::class, 'buku_id', 'id_buku');
    }


    // =======================================
    public function getStatusLabelAttribute(){
        if($this->status == 1 && Carbon::parse($this->tanggal_kembali)->lt(Carbon::today())){
            return 'Terlambat';
        }

        return match($this->status){
                        0 => 'Tunggu',
                        1 => 'Dipinjam',
                        2 => 'Dikembalikan',
                        3 => 'Ditolak',
                        default => 'Tidak Diketahui',
                    };
    }
}