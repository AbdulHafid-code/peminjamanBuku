<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuFavoritSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buku_favorit')->insert([
            [
                'id_favorit' => 1,
                'user_id' => 2,
                'buku_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 2,
                'user_id' => 3,
                'buku_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 3,
                'user_id' => 5,
                'buku_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 4,
                'user_id' => 7,
                'buku_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 5,
                'user_id' => 10,
                'buku_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
