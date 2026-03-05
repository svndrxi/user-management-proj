<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Office;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed users and direct user-permission relationships.
     */
    public function run(): void
    {
        $hq = Office::query()->where('office_code', 'HQ')->first();
        $north = Office::query()->where('office_code', 'NORTH')->first();
        $south = Office::query()->where('office_code', 'SOUTH')->first();

        $userRole = Role::query()->where('name', 'User')->first();
        $adminRole = Role::query()->where('name', 'Admin')->first();
        $systemAdminRole = Role::query()->where('name', 'System Admin')->first();

        if (! $hq || ! $north || ! $south || ! $userRole || ! $adminRole || ! $systemAdminRole) {
            return;
        }

        $users = [
            [
                'employee_id' => 'EMP-1001',
                'first_name' => 'Alice',
                'middle_name' => null,
                'last_name' => 'Cruz',
                'username' => 'alice.cruz',
                'email' => 'alice@example.com',
                'office_id' => $hq->id,
                'role_id' => $systemAdminRole->id,
            ],
            [
                'employee_id' => 'EMP-1002',
                'first_name' => 'Brian',
                'middle_name' => 'T',
                'last_name' => 'Lopez',
                'username' => 'brian.lopez',
                'email' => 'brian@example.com',
                'office_id' => $hq->id,
                'role_id' => $adminRole->id,
            ],
            [
                'employee_id' => 'EMP-1003',
                'first_name' => 'Carla',
                'middle_name' => null,
                'last_name' => 'Reyes',
                'username' => 'carla.reyes',
                'email' => 'carla@example.com',
                'office_id' => $north->id,
                'role_id' => $userRole->id,
            ],
            [
                'employee_id' => 'EMP-1004',
                'first_name' => 'Daniel',
                'middle_name' => null,
                'last_name' => 'Santos',
                'username' => 'daniel.santos',
                'email' => 'daniel@example.com',
                'office_id' => $south->id,
                'role_id' => $userRole->id,
            ],
        ];

        foreach ($users as $userData) {
            User::query()->updateOrCreate(
                ['email' => $userData['email']],
                $userData + [
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                ]
            );
        }

        $carla = User::query()->where('email', 'carla@example.com')->first();
        $viewLogsPermission = Permission::query()->where('slug', 'view_activity_logs')->first();

        if ($carla && $viewLogsPermission) {
            $carla->permissions()->syncWithoutDetaching([$viewLogsPermission->id]);
        }
    }
}
