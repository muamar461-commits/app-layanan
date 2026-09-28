<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Village;
use Illuminate\Database\Seeder;

class DistrictAndVillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(DistrictSeeder::class);

        $districts = [
            [
                'code' => '35.05.10',
                'name' => 'Kanigoro',
                'villages' => [
                    ['code' => '35.05.10.1001', 'name' => 'Kelurahan Kanigoro'],
                    ['code' => '35.05.10.1002', 'name' => 'Kelurahan Satreyan'],
                    ['code' => '35.05.10.2003', 'name' => 'Desa Tlogo'],
                    ['code' => '35.05.10.2004', 'name' => 'Desa Gaprang'],
                    ['code' => '35.05.10.2005', 'name' => 'Desa Gogodeso'],
                    ['code' => '35.05.10.2006', 'name' => 'Desa Sawentar'],
                    ['code' => '35.05.10.2007', 'name' => 'Desa Minggirsari'],
                    ['code' => '35.05.10.2008', 'name' => 'Desa Kuningan'],
                    ['code' => '35.05.10.2009', 'name' => 'Desa Papungan'],
                    ['code' => '35.05.10.2010', 'name' => 'Desa Bangle'],
                ],
            ],
            [
                'code' => '35.05.11',
                'name' => 'Garum',
                'villages' => [
                    ['code' => '35.05.11.1001', 'name' => 'Kelurahan Garum'],
                    ['code' => '35.05.11.1002', 'name' => 'Kelurahan Tawangsari'],
                    ['code' => '35.05.11.1003', 'name' => 'Kelurahan Bence'],
                    ['code' => '35.05.11.2004', 'name' => 'Desa Slorok'],
                    ['code' => '35.05.11.2005', 'name' => 'Desa Pojok'],
                    ['code' => '35.05.11.2006', 'name' => 'Desa Tingal'],
                    ['code' => '35.05.11.2007', 'name' => 'Desa Karangrejo'],
                    ['code' => '35.05.11.2008', 'name' => 'Desa Sidodadi'],
                ],
            ],
            [
                'code' => '35.05.17',
                'name' => 'Wlingi',
                'villages' => [
                    ['code' => '35.05.17.1001', 'name' => 'Kelurahan Wlingi'],
                    ['code' => '35.05.17.1002', 'name' => 'Kelurahan Beru'],
                    ['code' => '35.05.17.1003', 'name' => 'Kelurahan Babadan'],
                    ['code' => '35.05.17.1004', 'name' => 'Kelurahan Klemunan'],
                    ['code' => '35.05.17.2005', 'name' => 'Desa Tangkil'],
                    ['code' => '35.05.17.2006', 'name' => 'Desa Tembalang'],
                    ['code' => '35.05.17.2007', 'name' => 'Desa Tegalasri'],
                ],
            ],
            [
                'code' => '35.05.14',
                'name' => 'Talun',
                'villages' => [
                    ['code' => '35.05.14.1001', 'name' => 'Kelurahan Talun'],
                    ['code' => '35.05.14.1002', 'name' => 'Kelurahan Kamulan'],
                    ['code' => '35.05.14.2003', 'name' => 'Desa Pasirharjo'],
                    ['code' => '35.05.14.2004', 'name' => 'Desa Kendalrejo'],
                    ['code' => '35.05.14.2005', 'name' => 'Desa Bendosewu'],
                    ['code' => '35.05.14.2006', 'name' => 'Desa Tumpang'],
                    ['code' => '35.05.14.2007', 'name' => 'Desa Jabung'],
                ],
            ],
            [
                'code' => '35.05.03',
                'name' => 'Srengat',
                'villages' => [
                    ['code' => '35.05.03.1001', 'name' => 'Kelurahan Srengat'],
                    ['code' => '35.05.03.1002', 'name' => 'Kelurahan Dandong'],
                    ['code' => '35.05.03.1003', 'name' => 'Kelurahan Togogan'],
                    ['code' => '35.05.03.1004', 'name' => 'Kelurahan Kauman'],
                    ['code' => '35.05.03.2005', 'name' => 'Desa Selokajang'],
                    ['code' => '35.05.03.2006', 'name' => 'Desa Purwokerto'],
                    ['code' => '35.05.03.2007', 'name' => 'Desa Wonorejo'],
                ],
            ],
            [
                'code' => '35.05.07',
                'name' => 'Sanankulon',
                'villages' => [
                    ['code' => '35.05.07.2001', 'name' => 'Desa Sanankulon'],
                    ['code' => '35.05.07.2002', 'name' => 'Desa Bendowulung'],
                    ['code' => '35.05.07.2003', 'name' => 'Desa Kalipucang'],
                    ['code' => '35.05.07.2004', 'name' => 'Desa Plosoarang'],
                    ['code' => '35.05.07.2005', 'name' => 'Desa Purworejo'],
                    ['code' => '35.05.07.2006', 'name' => 'Desa Sumber'],
                ],
            ],
            [
                'code' => '35.05.09',
                'name' => 'Nglegok',
                'villages' => [
                    ['code' => '35.05.09.1001', 'name' => 'Kelurahan Nglegok'],
                    ['code' => '35.05.09.2002', 'name' => 'Desa Jiwut'],
                    ['code' => '35.05.09.2003', 'name' => 'Desa Kedawung'],
                    ['code' => '35.05.09.2004', 'name' => 'Desa Bangsri'],
                    ['code' => '35.05.09.2005', 'name' => 'Desa Modangan'],
                    ['code' => '35.05.09.2006', 'name' => 'Desa Penataran'],
                ],
            ],
            [
                'code' => '35.05.12',
                'name' => 'Sutojayan',
                'villages' => [
                    ['code' => '35.05.12.1001', 'name' => 'Kelurahan Sutojayan'],
                    ['code' => '35.05.12.1002', 'name' => 'Kelurahan Kalipang'],
                    ['code' => '35.05.12.1003', 'name' => 'Kelurahan Sukorejo'],
                    ['code' => '35.05.12.1004', 'name' => 'Kelurahan Kembangarum'],
                    ['code' => '35.05.12.2005', 'name' => 'Desa Pandanarum'],
                    ['code' => '35.05.12.2006', 'name' => 'Desa Jatisari'],
                    ['code' => '35.05.12.2007', 'name' => 'Desa Bacem'],
                ],
            ],
        ];

        foreach ($districts as $districtData) {
            $district = District::where('code', $districtData['code'])->first()
                ?? District::where('name', $districtData['name'])->first();

            if (! $district) {
                $district = District::create([
                    'code' => $districtData['code'],
                    'name' => $districtData['name'],
                ]);
            }

            foreach ($districtData['villages'] as $villageData) {
                Village::updateOrCreate(
                    ['code' => $villageData['code']],
                    [
                        'district_id' => $district->id,
                        'name' => $villageData['name'],
                    ]
                );
            }
        }
    }
}
