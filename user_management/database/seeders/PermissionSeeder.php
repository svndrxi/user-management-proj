<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Seed the application's permissions.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'My Profile', 'slug' => 'my_profile', 'description' => 'Can access own profile'],
            ['name' => 'My Payslip', 'slug' => 'my_payslip', 'description' => 'Can access own payslips'],
            ['name' => 'View Users', 'slug' => 'view_users', 'description' => 'Can view user records'],
            ['name' => 'Manage Users', 'slug' => 'manage_users', 'description' => 'Can create/update/delete users'],
            ['name' => 'View Roles', 'slug' => 'view_roles', 'description' => 'Can view role records'],
            ['name' => 'Manage Roles', 'slug' => 'manage_roles', 'description' => 'Can create/update/delete roles'],
            ['name' => 'Manage Permissions', 'slug' => 'manage_permissions', 'description' => 'Can assign permissions'],
            ['name' => 'Manage Payslips', 'slug' => 'manage_payslips', 'description' => 'Can view/print/download/email/delete payslips'],
        ];

        foreach ($permissions as $permission) {
            Permission::query()->updateOrCreate(
                ['slug' => $permission['slug']],
                $permission
            );
        }
    }
}
