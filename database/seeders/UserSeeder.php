<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'role_id' => 1, // Super Admin
                'unit_id' => 7, // IT
                'name' => 'Administrator',
                'nip' => '199001012020011001',
                'email' => 'admin@sanglah.go.id',
                'password' => Hash::make('password'),
                'phone' => '081234567890',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 2, // Validator
                'unit_id' => 1, // IGD
                'name' => 'Dr. Validator IGD',
                'nip' => '199002022020022002',
                'email' => 'validator.igd@sanglah.go.id',
                'password' => Hash::make('password'),
                'phone' => '081234567891',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 2, // Validator
                'unit_id' => 2, // Rawat Inap
                'name' => 'Dr. Validator Rawat Inap',
                'nip' => '199003032020033003',
                'email' => 'validator.ranap@sanglah.go.id',
                'password' => Hash::make('password'),
                'phone' => '081234567892',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 3, // User
                'unit_id' => 1, // IGD
                'name' => 'Pegawai IGD',
                'nip' => '199004042020044004',
                'email' => 'pegawai.igd@sanglah.go.id',
                'password' => Hash::make('password'),
                'phone' => '081234567893',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 3, // User
                'unit_id' => 2, // Rawat Inap
                'name' => 'Pegawai Rawat Inap',
                'nip' => '199005052020055005',
                'email' => 'pegawai.ranap@sanglah.go.id',
                'password' => Hash::make('password'),
                'phone' => '081234567894',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
