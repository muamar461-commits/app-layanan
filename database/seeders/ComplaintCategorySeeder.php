<?php

namespace Database\Seeders;

use App\Models\ComplaintCategory;
use Illuminate\Database\Seeder;

class ComplaintCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Penelantaran Anak, Lansia, atau ODGJ', 'is_active' => true],
            ['name' => 'Ketidaktepatan Sasaran Bansos (PKH/BPNT/BST)', 'is_active' => true],
            ['name' => 'PPKS Terlantar atau Kondisi Kedaruratan Sosial', 'is_active' => true],
            ['name' => 'Dugaan Pungli atau Penyalahgunaan Bantuan', 'is_active' => true],
            ['name' => 'Kebutuhan Mendesak Alat Bantu Disabilitas', 'is_active' => true],
            ['name' => 'Bencana Alam dan Tanggap Darurat Sosial', 'is_active' => true],
            ['name' => 'Masalah Kesejahteraan Sosial Lainnya', 'is_active' => true],
        ];

        foreach ($categories as $category) {
            ComplaintCategory::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
