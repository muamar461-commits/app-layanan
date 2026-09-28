<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\User;
use App\Models\Village;
use App\Models\WorkUnit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Work Units
        $sekretariat = WorkUnit::where('name', 'Sekretariat')->first();
        $linjamsos = WorkUnit::where('name', 'Bidang Perlindungan dan Jaminan Sosial')->first();
        $rehsos = WorkUnit::where('name', 'Bidang Rehabilitasi Sosial')->first();

        // Districts & Villages
        $kanigoro = District::where('code', '35.05.10')->orWhere('name', 'Kanigoro')->first();
        $garum = District::where('code', '35.05.11')->orWhere('name', 'Garum')->first();
        $sawentar = Village::where('name', 'like', '%Sawentar%')->first() ?? Village::where('code', '35.05.10.2006')->first() ?? Village::where('code', '35.05.01.2006')->first();
        $kelKanigoro = Village::where('name', 'like', '%Kanigoro%')->first() ?? Village::where('code', '35.05.10.1001')->first() ?? Village::where('code', '35.05.01.1001')->first();
        $slorok = Village::where('name', 'like', '%Slorok%')->first() ?? Village::where('code', '35.05.11.2004')->first() ?? Village::where('code', '35.05.02.2004')->first();

        $defaultPassword = Hash::make('password');

        $users = [
            // 1. Super Admin
            [
                'email' => 'admin@dinsos.blitarkab.go.id',
                'name' => 'Administrator Sistem',
                'password' => $defaultPassword,
                'phone' => '08113333001',
                'nik' => '3505010101800001',
                'work_unit_id' => $sekretariat?->id,
                'district_id' => null,
                'village_id' => null,
                'is_active' => true,
            ],
            // 2. Petugas Pelayanan / Linjamsos
            [
                'email' => 'petugas.pelayanan@dinsos.blitarkab.go.id',
                'name' => 'Bambang Prasetyo, S.Sos',
                'password' => $defaultPassword,
                'phone' => '08113333002',
                'nik' => '3505011406850002',
                'work_unit_id' => $linjamsos?->id,
                'district_id' => null,
                'village_id' => null,
                'is_active' => true,
            ],
            // 3. Petugas Rehsos
            [
                'email' => 'petugas.rehsos@dinsos.blitarkab.go.id',
                'name' => 'Dewi Lestari, S.Tr.Sos',
                'password' => $defaultPassword,
                'phone' => '08113333003',
                'nik' => '3505016208900003',
                'work_unit_id' => $rehsos?->id,
                'district_id' => null,
                'village_id' => null,
                'is_active' => true,
            ],
            // 4. Kabid Linjamsos
            [
                'email' => 'kabid.linjamsos@dinsos.blitarkab.go.id',
                'name' => 'Drs. H. Mulyono, M.Si',
                'password' => $defaultPassword,
                'phone' => '08113333004',
                'nik' => '3505011003720004',
                'work_unit_id' => $linjamsos?->id,
                'district_id' => null,
                'village_id' => null,
                'is_active' => true,
            ],
            // 5. Kabid Rehsos
            [
                'email' => 'kabid.rehsos@dinsos.blitarkab.go.id',
                'name' => 'Rina Agustina, S.ST, M.PS.Sp',
                'password' => $defaultPassword,
                'phone' => '08113333005',
                'nik' => '3505015204780005',
                'work_unit_id' => $rehsos?->id,
                'district_id' => null,
                'village_id' => null,
                'is_active' => true,
            ],
            // 6. Kepala Dinas
            [
                'email' => 'kadis@dinsos.blitarkab.go.id',
                'name' => 'Dr. Ir. H. Bambang Widjanarko, M.Si',
                'password' => $defaultPassword,
                'phone' => '08113333006',
                'nik' => '3505010505680006',
                'work_unit_id' => $sekretariat?->id,
                'district_id' => null,
                'village_id' => null,
                'is_active' => true,
            ],
            // 7. Pimpinan Eksekutif
            [
                'email' => 'pimpinan@dinsos.blitarkab.go.id',
                'name' => 'Pimpinan Daerah (Monitoring Eksekutif)',
                'password' => $defaultPassword,
                'phone' => '08113333007',
                'nik' => '3505011212700007',
                'work_unit_id' => $sekretariat?->id,
                'district_id' => null,
                'village_id' => null,
                'is_active' => true,
            ],
            // 8. Operator Kecamatan Kanigoro
            [
                'email' => 'operator.kanigoro@dinsos.blitarkab.go.id',
                'name' => 'Operator Kecamatan Kanigoro',
                'password' => $defaultPassword,
                'phone' => '08113333008',
                'nik' => '3505012507880008',
                'work_unit_id' => null,
                'district_id' => $kanigoro?->id,
                'village_id' => null,
                'is_active' => true,
            ],
            // 9. Operator Kecamatan Garum
            [
                'email' => 'operator.garum@dinsos.blitarkab.go.id',
                'name' => 'Operator Kecamatan Garum',
                'password' => $defaultPassword,
                'phone' => '08113333009',
                'nik' => '3505021809870009',
                'work_unit_id' => null,
                'district_id' => $garum?->id,
                'village_id' => null,
                'is_active' => true,
            ],
            // 10. Operator Desa Sawentar
            [
                'email' => 'operator.sawentar@dinsos.blitarkab.go.id',
                'name' => 'Operator Desa Sawentar',
                'password' => $defaultPassword,
                'phone' => '08113333010',
                'nik' => '3505012001920010',
                'work_unit_id' => null,
                'district_id' => $kanigoro?->id,
                'village_id' => $sawentar?->id,
                'is_active' => true,
            ],
            // 11. Citizens
            [
                'email' => 'budi.santoso@gmail.com',
                'name' => 'Budi Santoso',
                'password' => $defaultPassword,
                'phone' => '081234567891',
                'nik' => '3505011205850001',
                'work_unit_id' => null,
                'district_id' => $kanigoro?->id,
                'village_id' => $sawentar?->id,
                'is_active' => true,
            ],
            [
                'email' => 'siti.aminah@gmail.com',
                'name' => 'Siti Aminah',
                'password' => $defaultPassword,
                'phone' => '081234567892',
                'nik' => '3505015508890002',
                'work_unit_id' => null,
                'district_id' => $kanigoro?->id,
                'village_id' => $kelKanigoro?->id,
                'is_active' => true,
            ],
            [
                'email' => 'joko.widodo@gmail.com',
                'name' => 'Joko Widodo',
                'password' => $defaultPassword,
                'phone' => '081234567893',
                'nik' => '3505022103750003',
                'work_unit_id' => null,
                'district_id' => $garum?->id,
                'village_id' => $slorok?->id,
                'is_active' => true,
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
