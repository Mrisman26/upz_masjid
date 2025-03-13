<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Hapus cache permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat daftar permission
        $permissions = [
            'view zakat',
            'create zakat',
            'edit zakat',
            'delete zakat',
            'view users',
            'assign roles'
        ];

        // Buat dan simpan permission ke database
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat role Admin dan User
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Berikan semua permission kepada Admin
        $adminRole->syncPermissions($permissions);

        // Berikan hanya permission tertentu ke User
        $userRole->syncPermissions(['view zakat']);
    }
}
