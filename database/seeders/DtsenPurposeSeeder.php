<?php

namespace Database\Seeders;

use App\Models\DtsenPurpose;
use Illuminate\Database\Seeder;

class DtsenPurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $purposes = [
            [
                'code' => 'spmb',
                'name' => 'SPMB Jalur Afirmasi (SD / SMP / SMA)',
                'max_decile' => 5,
                'validity_days' => 30,
                'is_active' => true,
            ],
            [
                'code' => 'pip',
                'name' => 'Pengajuan Program Indonesia Pintar (PIP)',
                'max_decile' => 4,
                'validity_days' => 90,
                'is_active' => true,
            ],
            [
                'code' => 'kip_kuliah',
                'name' => 'Persyaratan KIP Kuliah',
                'max_decile' => 4,
                'validity_days' => 90,
                'is_active' => true,
            ],
            [
                'code' => 'bansos',
                'name' => 'Verifikasi Calon Penerima Bantuan Sosial',
                'max_decile' => 3,
                'validity_days' => 60,
                'is_active' => true,
            ],
            [
                'code' => 'kesehatan',
                'name' => 'Keringanan Biaya Pelayanan Kesehatan',
                'max_decile' => 3,
                'validity_days' => 30,
                'is_active' => true,
            ],
            [
                'code' => 'lainnya',
                'name' => 'Keperluan Administrasi Sosial Lainnya',
                'max_decile' => 5,
                'validity_days' => 30,
                'is_active' => true,
            ],
        ];

        foreach ($purposes as $purpose) {
            DtsenPurpose::firstOrCreate(['code' => $purpose['code']], $purpose);
        }
    }
}
