<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's account roles.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'User', 'description' => 'Basic account access'],
            ['name' => 'Manager', 'description' => 'Manage payslips'],
            ['name' => 'Admin', 'description' => 'Can manage users and managers'],
            ['name' => 'System Admin', 'description' => 'Full administrative access'],
        ];

        foreach ($roles as $role) {
            Role::query()->updateOrCreate(
                ['name' => $role['name']],
                $role
            );
        }
    }
}
