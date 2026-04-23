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
        $hr = Office::query()->where('office_code', 'HR')->first();
        $it = Office::query()->where('office_code', 'IT')->first();

        $userRole = Role::query()->where('name', 'User')->first();
        $managerRole = Role::query()->where('name', 'Manager')->first();
        $adminRole = Role::query()->where('name', 'Admin')->first();
        $systemAdminRole = Role::query()->where('name', 'System Admin')->first();

        if (! $hq || ! $north || ! $south || ! $hr || ! $it || ! $userRole || ! $managerRole || ! $adminRole || ! $systemAdminRole) {
            return;
        }

        $users = [
            [
                'employee_id' => 'EMP-1001',
                'first_name' => 'System',
                'middle_name' => null,
                'last_name' => 'Admin',
                'designation' => 'System Administrator',
                'username' => 'sysadmin',
                'email' => 'sysad@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $it->id,
                'role_id' => $systemAdminRole->id,
            ],
            [
                'employee_id' => 'EMP-1002',
                'first_name' => 'Admin',
                'middle_name' => '',
                'last_name' => 'User',
                'designation' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $it->id,
                'role_id' => $adminRole->id,
            ],
            [
                'employee_id' => 'EMP-1003',
                'first_name' => 'HR',
                'middle_name' => null,
                'last_name' => 'Manager',
                'designation' => 'HR Manager',
                'username' => 'manager',
                'email' => 'manager@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $hr->id,
                'role_id' => $managerRole->id,
            ],
            [
                'employee_id' => '2018035',
                'first_name' => 'Serenikka Jeane',
                'middle_name' => 'R',
                'last_name' => 'De Guzman',
                'designation' => 'Cartographer I',
                'username' => 'serenikka.deguzman',
                'email' => 'test-user@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $it->id,
                'role_id' => $userRole->id,
            ],
        ];

        foreach ($users as $userData) {
            User::query()->updateOrCreate(
                ['email' => $userData['email']],
                $userData + [
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
