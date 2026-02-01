<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FacadesDB::table('role')->insert([
            ['id_role' => 1, 'role' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['id_role' => 2, 'role' => 'User', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
