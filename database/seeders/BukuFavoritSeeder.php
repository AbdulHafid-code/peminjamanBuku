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
                'buku_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 3,
                'user_id' => 4,
                'buku_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 4,
                'user_id' => 5,
                'buku_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 5,
                'user_id' => 6,
                'buku_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 6,
                'user_id' => 7,
                'buku_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 7,
                'user_id' => 8,
                'buku_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 8,
                'user_id' => 9,
                'buku_id' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 9,
                'user_id' => 10,
                'buku_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 10,
                'user_id' => 11,
                'buku_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 11,
                'user_id' => 12,
                'buku_id' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 12,
                'user_id' => 13,
                'buku_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 13,
                'user_id' => 14,
                'buku_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 14,
                'user_id' => 15,
                'buku_id' => 13,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_favorit' => 15,
                'user_id' => 16,
                'buku_id' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
