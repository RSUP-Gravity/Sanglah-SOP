<?php

namespace Database\Seeders;

use App\Models\Sop;
use App\Models\Unit;
use App\Models\User;
use App\Models\Validation;
use App\Models\ActivityLog;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SopSeeder extends Seeder
{
    public function run(): void
    {
        $igd = Unit::where('code', 'IGD')->first();
        $rawatInap = Unit::where('code', 'RAWAT-INAP')->first();
        $lab = Unit::where('code', 'LAB')->first();
        $radiologi = Unit::where('code', 'RADIOLOGI')->first();
        $farmasi = Unit::where('code', 'FARMASI')->first();
        $rawatJalan = Unit::where('code', 'RAWAT-JALAN')->first();
        
        $users = User::all();
        $validator = User::where('role_id', 2)->first();

        // Approved SOPs
        $approvedSOPs = [
            ['unit' => $igd, 'title' => 'Prosedur Triase Pasien Gawat Darurat', 'sk' => 'SOP-IGD-001'],
            ['unit' => $igd, 'title' => 'Penanganan Cardiac Arrest', 'sk' => 'SOP-IGD-002'],
            ['unit' => $rawatInap, 'title' => 'Perawatan Luka Post Operasi', 'sk' => 'SOP-RI-001'],
            ['unit' => $rawatInap, 'title' => 'Pemberian Obat Oral', 'sk' => 'SOP-RI-002'],
            ['unit' => $lab, 'title' => 'Pengambilan Sampel Darah Vena', 'sk' => 'SOP-LAB-001'],
            ['unit' => $lab, 'title' => 'Pemeriksaan Hematologi Lengkap', 'sk' => 'SOP-LAB-002'],
            ['unit' => $radiologi, 'title' => 'Pemeriksaan Rontgen Thorax', 'sk' => 'SOP-RAD-001'],
            ['unit' => $radiologi, 'title' => 'Pemeriksaan CT Scan Kepala', 'sk' => 'SOP-RAD-002'],
            ['unit' => $farmasi, 'title' => 'Dispensing Obat Resep Rawat Jalan', 'sk' => 'SOP-FAR-001'],
            ['unit' => $farmasi, 'title' => 'Penyimpanan Obat High Alert', 'sk' => 'SOP-FAR-002'],
            ['unit' => $rawatJalan, 'title' => 'Pendaftaran Pasien Baru', 'sk' => 'SOP-RJ-001'],
            ['unit' => $rawatJalan, 'title' => 'Konsultasi Dokter Spesialis', 'sk' => 'SOP-RJ-002'],
        ];

        foreach ($approvedSOPs as $data) {
            $sop = Sop::create([
                'unit_id' => $data['unit']->id,
                'title' => $data['title'],
                'sk_number' => $data['sk'],
                'sk_date' => Carbon::now()->subMonths(rand(2, 6)),
                'description' => 'Deskripsi untuk ' . $data['title'],
                'file_path' => 'sops/' . strtolower(str_replace([' ', '-'], '_', $data['sk'])) . '.pdf',
                'file_name' => $data['title'] . '.pdf',
                'status' => 'approved',
                'version' => '1.' . rand(0, 5),
                'created_by' => $users->random()->id,
                'approved_by' => $validator->id,
                'approved_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);

            // Create validation
            if ($validator) {
                Validation::create([
                    'sop_id' => $sop->id,
                    'validator_id' => $validator->id,
                    'status' => 'approved',
                    'notes' => 'SOP telah memenuhi standar dan disetujui.',
                    'validated_at' => Carbon::now()->subDays(rand(1, 30)),
                ]);
            }

            // Create activity logs
            ActivityLog::create([
                'user_id' => $sop->created_by,
                'model_type' => Sop::class,
                'model_id' => $sop->id,
                'action' => 'created',
                'description' => 'Membuat SOP: ' . $sop->title,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => Carbon::now()->subDays(rand(10, 60)),
            ]);

            ActivityLog::create([
                'user_id' => $validator->id,
                'model_type' => Sop::class,
                'model_id' => $sop->id,
                'action' => 'approved',
                'description' => 'Menyetujui SOP: ' . $sop->title,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }

        // Pending SOPs
        $pendingSOPs = [
            ['unit' => $igd, 'title' => 'Triage Pediatric Emergency', 'sk' => 'SOP-IGD-003'],
            ['unit' => $rawatInap, 'title' => 'Manajemen Nyeri Pasca Operasi', 'sk' => 'SOP-RI-003'],
            ['unit' => Unit::where('code', 'IT')->first(), 'title' => 'Backup Data SIMRS', 'sk' => 'SOP-IT-001'],
        ];

        foreach ($pendingSOPs as $data) {
            $sop = Sop::create([
                'unit_id' => $data['unit']->id,
                'title' => $data['title'],
                'sk_number' => $data['sk'],
                'sk_date' => Carbon::now(),
                'description' => 'Deskripsi untuk ' . $data['title'],
                'file_path' => 'sops/' . strtolower(str_replace([' ', '-'], '_', $data['sk'])) . '.pdf',
                'file_name' => $data['title'] . '.pdf',
                'status' => 'pending',
                'version' => '1.0',
                'created_by' => $users->random()->id,
            ]);

            ActivityLog::create([
                'user_id' => $sop->created_by,
                'model_type' => Sop::class,
                'model_id' => $sop->id,
                'action' => 'created',
                'description' => 'Membuat SOP: ' . $sop->title,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => Carbon::now()->subDays(rand(1, 10)),
            ]);
        }
    }
}
