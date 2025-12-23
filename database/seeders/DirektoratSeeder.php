<?php

namespace Database\Seeders;

use App\Models\Direktorat;
use Illuminate\Database\Seeder;

class DirektoratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $direktorats = [
            [
                'name' => 'Direktorat Medik',
                'code' => 'MEDIK',
                'description' => 'Direktorat yang menangani pelayanan medis dan keperawatan',
                'is_active' => true,
            ],
            [
                'name' => 'Direktorat Umum dan Operasional',
                'code' => 'UMUM',
                'description' => 'Direktorat yang menangani administrasi umum dan operasional rumah sakit',
                'is_active' => true,
            ],
            [
                'name' => 'Direktorat Keuangan',
                'code' => 'KEUANGAN',
                'description' => 'Direktorat yang menangani keuangan dan akuntansi',
                'is_active' => true,
            ],
            [
                'name' => 'Direktorat SDM',
                'code' => 'SDM',
                'description' => 'Direktorat yang menangani sumber daya manusia',
                'is_active' => true,
            ],
        ];

        foreach ($direktorats as $direktorat) {
            Direktorat::create($direktorat);
        }
    }
}
