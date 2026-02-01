<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\BukuSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\TransaksiSeeder;
use Database\Seeders\BukuFavoritSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            KategoriSeeder::class,
            UserSeeder::class,
            BukuSeeder::class,
            BukuFavoritSeeder::class,
            TransaksiSeeder::class,
        ]);
    }
}
