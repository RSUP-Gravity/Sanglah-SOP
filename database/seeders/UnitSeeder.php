<?php

namespace Database\Seeders;

use App\Models\Direktorat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get direktorat IDs
        $medik = Direktorat::where('code', 'MEDIK')->first()->id;
        $umum = Direktorat::where('code', 'UMUM')->first()->id;
        $keuangan = Direktorat::where('code', 'KEUANGAN')->first()->id;
        $sdm = Direktorat::where('code', 'SDM')->first()->id;

        $units = [
            [
                'direktorat_id' => $medik,
                'code' => 'IGD',
                'name' => 'Instalasi Gawat Darurat',
                'description' => 'Unit pelayanan gawat darurat',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'direktorat_id' => $medik,
                'code' => 'RAWAT-INAP',
                'name' => 'Rawat Inap',
                'description' => 'Unit pelayanan rawat inap',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'direktorat_id' => $medik,
                'code' => 'RAWAT-JALAN',
                'name' => 'Rawat Jalan',
                'description' => 'Unit pelayanan rawat jalan',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'direktorat_id' => $medik,
                'code' => 'LAB',
                'name' => 'Laboratorium',
                'description' => 'Unit laboratorium klinik',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'direktorat_id' => $medik,
                'code' => 'RADIOLOGI',
                'name' => 'Radiologi',
                'description' => 'Unit radiologi dan imaging',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'direktorat_id' => $medik,
                'code' => 'FARMASI',
                'name' => 'Farmasi',
                'description' => 'Unit pelayanan farmasi',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'direktorat_id' => $umum,
                'code' => 'IT',
                'name' => 'Teknologi Informasi',
                'description' => 'Unit teknologi informasi',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'direktorat_id' => $keuangan,
                'code' => 'ADMIN',
                'name' => 'Administrasi',
                'description' => 'Unit administrasi dan keuangan',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('units')->insert($units);
    }
}
