<?php

namespace Database\Seeders;

use App\Models\ReferralInstitution;
use Illuminate\Database\Seeder;

class ReferralInstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutions = [
            [
                'name' => 'UPT Pelayanan Sosial Tresna Werdha (PSTW) Blitar',
                'type' => 'panti',
                'address' => 'Jl. Merdeka No. 12, Kota Blitar',
                'contact' => '(0342) 801234',
                'is_active' => true,
            ],
            [
                'name' => 'RSUD Ngudi Waluyo Wlingi',
                'type' => 'RS',
                'address' => 'Jl. Dokter Sucipto No. 5, Wlingi, Kabupaten Blitar',
                'contact' => '(0342) 691006',
                'is_active' => true,
            ],
            [
                'name' => 'RSUD Srengat Blitar',
                'type' => 'RS',
                'address' => 'Jl. Raya Dandong No. 1, Srengat, Kabupaten Blitar',
                'contact' => '(0342) 561234',
                'is_active' => true,
            ],
            [
                'name' => 'RS Jiwa Menur Surabaya',
                'type' => 'RS',
                'address' => 'Jl. Menur No. 120, Surabaya, Jawa Timur',
                'contact' => '(031) 5021635',
                'is_active' => true,
            ],
            [
                'name' => 'LKS Anak & Disabilitas Kasih Ibu',
                'type' => 'LKS',
                'address' => 'Jl. Kusuma Bangsa No. 15, Kanigoro, Kabupaten Blitar',
                'contact' => '081234567890',
                'is_active' => true,
            ],
            [
                'name' => 'Sentra Terpadu Prof. Dr. Soeharso Surakarta',
                'type' => 'balai',
                'address' => 'Jl. Tentara Pelajar No. 1, Jebres, Surakarta, Jawa Tengah',
                'contact' => '(0271) 644138',
                'is_active' => true,
            ],
        ];

        foreach ($institutions as $item) {
            ReferralInstitution::firstOrCreate(
                ['name' => $item['name']],
                $item
            );
        }
    }
}
