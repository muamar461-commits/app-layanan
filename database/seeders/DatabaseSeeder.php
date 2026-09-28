<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // 1. Master Data & Geographic
            WorkUnitSeeder::class,
            DistrictSeeder::class,
            DistrictAndVillageSeeder::class,
            ServiceTypeSeeder::class,
            DtsenPurposeSeeder::class,
            ClientCategorySeeder::class,
            ComplaintCategorySeeder::class,
            ReferralInstitutionSeeder::class,

            // 2. Users & Roles
            UserSeeder::class,
            RolePermissionSeeder::class,

            // 3. Information Portal, Forms & FAQs
            InformationPortalSeeder::class,

            // 4. Sample Transactional Data & Scenarios
            SampleDataSeeder::class,
        ]);
    }
}
