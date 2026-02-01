<?php

namespace Database\Seeders;

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
        DB::table('kategori')->insert(
            [
                ['id_kategori' => 1, 'nama_kategori' => 'Action', 'created_at' => now(), 'updated_at' => now()], //
                ['id_kategori' => 2, 'nama_kategori' => 'Adventure', 'created_at' => now(), 'updated_at' => now()], //
                ['id_kategori' => 3, 'nama_kategori' => 'Romance', 'created_at' => now(), 'updated_at' => now()], //
                ['id_kategori' => 4, 'nama_kategori' => 'Drama', 'created_at' => now(), 'updated_at' => now()], //
                ['id_kategori' => 5, 'nama_kategori' => 'Fantasy', 'created_at' => now(), 'updated_at' => now()], //
                ['id_kategori' => 6, 'nama_kategori' => 'Science Fiction', 'created_at' => now(), 'updated_at' => now()], //
                ['id_kategori' => 7, 'nama_kategori' => 'Horror', 'created_at' => now(), 'updated_at' => now()],
                ['id_kategori' => 8, 'nama_kategori' => 'Mystery', 'created_at' => now(), 'updated_at' => now()], //
                ['id_kategori' => 9, 'nama_kategori' => 'Thriller', 'created_at' => now(), 'updated_at' => now()],
                ['id_kategori' => 10, 'nama_kategori' => 'Historical', 'created_at' => now(), 'updated_at' => now()], //

                ['id_kategori' => 11, 'nama_kategori' => 'Slice of Life', 'created_at' => now(), 'updated_at' => now()],
                ['id_kategori' => 12, 'nama_kategori' => 'Comedy', 'created_at' => now(), 'updated_at' => now()], //
                ['id_kategori' => 13, 'nama_kategori' => 'Psychological', 'created_at' => now(), 'updated_at' => now()],
                ['id_kategori' => 14, 'nama_kategori' => 'Crime', 'created_at' => now(), 'updated_at' => now()], //
                ['id_kategori' => 15, 'nama_kategori' => 'Supernatural', 'created_at' => now(), 'updated_at' => now()],//
                ['id_kategori' => 16, 'nama_kategori' => 'Military', 'created_at' => now(), 'updated_at' => now()], //
                ['id_kategori' => 17, 'nama_kategori' => 'School Life', 'created_at' => now(), 'updated_at' => now()],
                ['id_kategori' => 18, 'nama_kategori' => 'Urban Fantasy', 'created_at' => now(), 'updated_at' => now()],
                ['id_kategori' => 19, 'nama_kategori' => 'Dark Fantasy', 'created_at' => now(), 'updated_at' => now()], //
                ['id_kategori' => 20, 'nama_kategori' => 'Time Travel', 'created_at' => now(), 'updated_at' => now()],

                ['id_kategori' => 21, 'nama_kategori' => 'Post-Apocalyptic', 'created_at' => now(), 'updated_at' => now()], //
                ['id_kategori' => 22, 'nama_kategori' => 'Detective', 'created_at' => now(), 'updated_at' => now()],
                ['id_kategori' => 23, 'nama_kategori' => 'Political', 'created_at' => now(), 'updated_at' => now()],
                ['id_kategori' => 24, 'nama_kategori' => 'Philosophical', 'created_at' => now(), 'updated_at' => now()],
                ['id_kategori' => 25, 'nama_kategori' => 'Mythology', 'created_at' => now(), 'updated_at' => now()],

                ['id_kategori' => 26, 'nama_kategori' => 'Young Adult', 'created_at' => now(), 'updated_at' => now()],
                ['id_kategori' => 27, 'nama_kategori' => 'Coming of Age', 'created_at' => now(), 'updated_at' => now()],
                ['id_kategori' => 28, 'nama_kategori' => 'Dystopian', 'created_at' => now(), 'updated_at' => now()],
                ['id_kategori' => 29, 'nama_kategori' => 'Tragedy', 'created_at' => now(), 'updated_at' => now()],
                ['id_kategori' => 30, 'nama_kategori' => 'Inspirational', 'created_at' => now(), 'updated_at' => now()],
            ]
        );
    }
}
