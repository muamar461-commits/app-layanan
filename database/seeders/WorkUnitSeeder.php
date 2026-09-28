<?php

namespace Database\Seeders;

use App\Models\WorkUnit;
use Illuminate\Database\Seeder;

class WorkUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Sekretariat', 'is_active' => true],
            ['name' => 'Bidang Perlindungan dan Jaminan Sosial', 'is_active' => true],
            ['name' => 'Bidang Rehabilitasi Sosial', 'is_active' => true],
            ['name' => 'Bidang Pemberdayaan Sosial dan Penanganan Fakir Miskin', 'is_active' => true],
        ];

        foreach ($units as $unit) {
            WorkUnit::firstOrCreate(['name' => $unit['name']], $unit);
        }
    }
}
