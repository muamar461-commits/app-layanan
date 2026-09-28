<?php

namespace Database\Seeders;

use App\Models\ClientCategory;
use Illuminate\Database\Seeder;

class ClientCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Lanjut Usia Terlantar',
            'Penyandang Disabilitas (Fisik, Intelektual, Mental, Sensorik)',
            'Orang Dengan Gangguan Jiwa (ODGJ) Terlantar',
            'Anak Terlantar / Memerlukan Perlindungan Khusus (AMPK)',
            'Korban Tindak Kekerasan / Pekerja Migran Terlantar',
            'Gelandangan dan Pengemis (Gepeng)',
            'Pemerlu Pelayanan Kesejahteraan Sosial (PPKS) Lainnya',
        ];

        foreach ($categories as $name) {
            ClientCategory::firstOrCreate(['name' => $name]);
        }
    }
}
