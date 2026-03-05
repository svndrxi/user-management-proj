<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Seed role-permission relationships.
     */
    public function run(): void
    {
        $userRole = Role::query()->where('name', 'User')->first();
        $adminRole = Role::query()->where('name', 'Admin')->first();
        $systemAdminRole = Role::query()->where('name', 'System Admin')->first();

        if (! $userRole || ! $adminRole || ! $systemAdminRole) {
            return;
        }

        $getIds = static fn (array $slugs): array => Permission::query()
            ->whereIn('slug', $slugs)
            ->pluck('id')
            ->all();

        $userRole->permissions()->sync($getIds([
            'view_users',
            'view_roles',
        ]));

        $adminRole->permissions()->sync($getIds([
            'view_users',
            'manage_users',
            'view_roles',
            'manage_roles',
            'view_activity_logs',
        ]));

        $systemAdminRole->permissions()->sync(
            Permission::query()->pluck('id')->all()
        );
    }
}
