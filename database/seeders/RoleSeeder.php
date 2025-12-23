<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super_admin',
                'display_name' => 'Super Administrator',
                'description' => 'Memiliki akses penuh ke seluruh sistem',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'validator',
                'display_name' => 'Validator SOP',
                'description' => 'Dapat membuat dan memvalidasi SOP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user',
                'display_name' => 'User/Pegawai',
                'description' => 'Dapat melihat dan mengunduh SOP yang telah divalidasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
