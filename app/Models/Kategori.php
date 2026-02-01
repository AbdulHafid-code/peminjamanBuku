<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    public $guarded = [
        'id_kategori',
    ];

    // public $timestamps = false;

    public function buku(){
        return $this->hasMany(Buku::class, 'kategori_id', 'id_kategori');
    }
}
