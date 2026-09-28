<?php

namespace Database\Seeders;

use App\Enums\Role as RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Create Roles
        foreach (RoleEnum::cases() as $role) {
            Role::firstOrCreate(['name' => $role->value, 'guard_name' => 'web']);
        }

        // 2. Define Permissions
        $permissions = [
            // Master Data
            'view_master_data',
            'manage_master_data',

            // Service Requests (DTSEN & PBI)
            'view_service_requests',
            'create_service_requests',
            'verify_service_requests',
            'approve_service_requests',

            // Rehabilitation Cases
            'view_rehabilitation_cases',
            'manage_rehabilitation_cases',

            // Complaints
            'view_complaints',
            'manage_complaints',
            'handle_complaints',

            // Information Portal
            'manage_information_pages',

            // Reports & Dashboard
            'view_dashboard',
            'export_reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // 3. Assign Permissions to Roles
        $adminRole = Role::findByName(RoleEnum::Admin->value);
        $adminRole->givePermissionTo(Permission::all());

        $petugasRole = Role::findByName(RoleEnum::PetugasDinsos->value);
        $petugasRole->givePermissionTo([
            'view_service_requests',
            'verify_service_requests',
            'view_rehabilitation_cases',
            'manage_rehabilitation_cases',
            'view_complaints',
            'manage_complaints',
            'handle_complaints',
            'view_dashboard',
            'export_reports',
        ]);

        $pejabatRole = Role::findByName(RoleEnum::PejabatPenandatangan->value);
        $pejabatRole->givePermissionTo([
            'view_service_requests',
            'approve_service_requests',
            'view_dashboard',
            'export_reports',
        ]);

        $pimpinanRole = Role::findByName(RoleEnum::Pimpinan->value);
        $pimpinanRole->givePermissionTo([
            'view_service_requests',
            'view_rehabilitation_cases',
            'view_complaints',
            'view_dashboard',
            'export_reports',
        ]);

        $operatorKecRole = Role::findByName(RoleEnum::OperatorKecamatan->value);
        $operatorKecRole->givePermissionTo([
            'view_service_requests',
            'create_service_requests',
            'view_complaints',
            'view_dashboard',
        ]);

        $operatorDesaRole = Role::findByName(RoleEnum::OperatorDesa->value);
        $operatorDesaRole->givePermissionTo([
            'view_service_requests',
            'create_service_requests',
            'view_complaints',
            'view_dashboard',
        ]);

        $masyarakatRole = Role::findByName(RoleEnum::Masyarakat->value);
        $masyarakatRole->givePermissionTo([
            'create_service_requests',
        ]);

        // 4. Assign Roles to existing Users
        $roleAssignments = [
            'admin@dinsos.blitarkab.go.id' => [RoleEnum::Admin->value],
            'petugas.pelayanan@dinsos.blitarkab.go.id' => [RoleEnum::PetugasDinsos->value],
            'petugas.rehsos@dinsos.blitarkab.go.id' => [RoleEnum::PetugasDinsos->value],
            'kabid.linjamsos@dinsos.blitarkab.go.id' => [RoleEnum::PejabatPenandatangan->value],
            'kabid.rehsos@dinsos.blitarkab.go.id' => [RoleEnum::PejabatPenandatangan->value],
            'kadis@dinsos.blitarkab.go.id' => [RoleEnum::PejabatPenandatangan->value, RoleEnum::Pimpinan->value],
            'pimpinan@dinsos.blitarkab.go.id' => [RoleEnum::Pimpinan->value],
            'operator.kanigoro@dinsos.blitarkab.go.id' => [RoleEnum::OperatorKecamatan->value],
            'operator.garum@dinsos.blitarkab.go.id' => [RoleEnum::OperatorKecamatan->value],
            'operator.sawentar@dinsos.blitarkab.go.id' => [RoleEnum::OperatorDesa->value],
            'budi.santoso@gmail.com' => [RoleEnum::Masyarakat->value],
            'siti.aminah@gmail.com' => [RoleEnum::Masyarakat->value],
            'joko.widodo@gmail.com' => [RoleEnum::Masyarakat->value],
        ];

        foreach ($roleAssignments as $email => $roles) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->syncRoles($roles);
            }
        }
    }
}
