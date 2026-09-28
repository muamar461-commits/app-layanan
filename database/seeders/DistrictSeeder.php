<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Village;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            ['code' => '35.05.01', 'name' => 'Wonodadi'],
            ['code' => '35.05.02', 'name' => 'Udanawu'],
            ['code' => '35.05.03', 'name' => 'Srengat'],
            ['code' => '35.05.04', 'name' => 'Kademangan'],
            ['code' => '35.05.05', 'name' => 'Bakung'],
            ['code' => '35.05.06', 'name' => 'Ponggok'],
            ['code' => '35.05.07', 'name' => 'Sanankulon'],
            ['code' => '35.05.08', 'name' => 'Wonotirto'],
            ['code' => '35.05.09', 'name' => 'Nglegok'],
            ['code' => '35.05.10', 'name' => 'Kanigoro'],
            ['code' => '35.05.11', 'name' => 'Garum'],
            ['code' => '35.05.12', 'name' => 'Sutojayan'],
            ['code' => '35.05.13', 'name' => 'Panggungrejo'],
            ['code' => '35.05.14', 'name' => 'Talun'],
            ['code' => '35.05.15', 'name' => 'Gandusari'],
            ['code' => '35.05.16', 'name' => 'Binangun'],
            ['code' => '35.05.17', 'name' => 'Wlingi'],
            ['code' => '35.05.18', 'name' => 'Doko'],
            ['code' => '35.05.19', 'name' => 'Kesamben'],
            ['code' => '35.05.20', 'name' => 'Wates'],
            ['code' => '35.05.21', 'name' => 'Selorejo'],
            ['code' => '35.05.22', 'name' => 'Selopuro'],
        ];

        DB::transaction(function () use ($districts) {
            $officialMap = collect($districts)->keyBy('name');

            // 1. Berikan prefix sementara untuk kecamatan lama yang kodenya bentrok agar tidak melanggar unique constraint
            $existingDistricts = District::all();
            foreach ($existingDistricts as $existing) {
                $cleanName = str_replace('Kecamatan ', '', trim($existing->name));
                $expected = $officialMap->get($cleanName);

                if ($expected && $existing->code !== $expected['code']) {
                    $existing->code = 'TEMP-D-'.$existing->id.'-'.$existing->code;
                    $existing->name = $cleanName;
                    $existing->save();
                }
            }

            // 2. Update kecamatan yang sudah ada berdasarkan nama (agar ID tetap terjaga untuk relasi foreign key desa & user),
            //    atau updateOrCreate berdasarkan kode Kemendagri resmi.
            foreach ($districts as $districtData) {
                $matched = District::where('name', $districtData['name'])
                    ->orWhere('name', 'Kecamatan '.$districtData['name'])
                    ->first();

                if ($matched) {
                    $matched->update([
                        'code' => $districtData['code'],
                        'name' => $districtData['name'],
                    ]);
                } else {
                    District::updateOrCreate(
                        ['code' => $districtData['code']],
                        ['name' => $districtData['name']]
                    );
                }
            }

            // 3. Bersihkan record sementara jika masih ada yang tersisa tanpa desa
            $tempDistricts = District::where('code', 'like', 'TEMP-D-%')->get();
            foreach ($tempDistricts as $temp) {
                $villageCount = Village::where('district_id', $temp->id)->count();
                if ($villageCount === 0) {
                    $temp->delete();
                }
            }

            // 4. Update kode desa agar prefix kodenya selaras dengan kode kecamatan resmi
            // Tahap 4a: Berikan kode sementara untuk menghindari collision unique constraint antar desa
            $allDistricts = District::all();
            foreach ($allDistricts as $d) {
                $villages = Village::where('district_id', $d->id)->get();
                foreach ($villages as $v) {
                    if (! str_starts_with($v->code, $d->code)) {
                        $v->update(['code' => 'TEMP-V-'.$v->id.'-'.$v->code]);
                    }
                }
            }

            // Tahap 4b: Perbarui ke kode resmi Kemendagri (contoh: 35.05.10.1001)
            foreach ($allDistricts as $d) {
                $villages = Village::where('district_id', $d->id)->get();
                foreach ($villages as $v) {
                    if (str_starts_with($v->code, 'TEMP-V-')) {
                        $parts = explode('.', $v->code);
                        $suffix = end($parts);
                        $newCode = $d->code.'.'.$suffix;
                        $v->update(['code' => $newCode]);
                    }
                }
            }

            // 5. Verifikasi integritas: pastikan tidak ada data desa yang menjadi anak yatim (orphan foreign key)
            $orphanVillages = Village::whereNotIn('district_id', District::pluck('id'))->count();
            if ($orphanVillages > 0) {
                throw new \RuntimeException("Integritas data gagal: terdapat {$orphanVillages} desa tanpa kecamatan!");
            }
        });
    }
}
