<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $kategori = [
            'Fiksi',
            'Non-Fiksi',
            'Novel',
            'Cerpen',
            'Komik',
            'Ensiklopedia',
            'Biografi',
            'Sejarah',
            'Sains',
            'Teknologi',
            'Pendidikan',
            'Agama',
            'Filsafat',
            'Psikologi',
            'Sastra',
            'Bahasa',
            'Ekonomi',
            'Bisnis',
            'Hukum',
            'Kesehatan',
        ];

        foreach ($kategori as $item) {
            DB::table('Kategori')->insert([
                'nama_kategori' => $item,
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);
        }
    }
}
