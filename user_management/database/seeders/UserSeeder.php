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
                'first_name' => 'Alice',
                'middle_name' => null,
                'last_name' => 'Cruz',
                'designation' => 'System Administrator',
                'username' => 'alice.cruz',
                'email' => 'sysad@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $it->id,
                'role_id' => $systemAdminRole->id,
            ],
            [
                'employee_id' => 'EMP-1002',
                'first_name' => 'Brian',
                'middle_name' => 'T',
                'last_name' => 'Lopez',
                'designation' => 'Administrative Officer',
                'username' => 'brian.lopez',
                'email' => 'admin@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $it->id,
                'role_id' => $adminRole->id,
            ],
            [
                'employee_id' => 'EMP-1003',
                'first_name' => 'Carla',
                'middle_name' => null,
                'last_name' => 'Reyes',
                'designation' => 'Records Officer',
                'username' => 'carla.reyes',
                'email' => 'manager@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $hr->id,
                'role_id' => $managerRole->id,
            ],
            [
                'employee_id' => 'EMP-1004',
                'first_name' => 'Daniel',
                'middle_name' => null,
                'last_name' => 'Santos',
                'designation' => 'Field Staff',
                'username' => 'daniel.santos',
                'email' => 'user@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $south->id,
                'role_id' => $userRole->id,
            ],
            [
                'employee_id' => 'EMP-1005',
                'first_name' => 'Ethan',
                'middle_name' => 'M',
                'last_name' => 'Garcia',
                'designation' => 'IT Support',
                'username' => 'ethan.garcia',
                'email' => 'ethan@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $hq->id,
                'role_id' => $userRole->id,
            ],
            [
                'employee_id' => 'EMP-1006',
                'first_name' => 'Fiona',
                'middle_name' => null,
                'last_name' => 'Mendoza',
                'designation' => 'Clerk',
                'username' => 'fiona.mendoza',
                'email' => 'fiona@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $north->id,
                'role_id' => $userRole->id,
            ],
            [
                'employee_id' => 'EMP-1007',
                'first_name' => 'Gavin',
                'middle_name' => null,
                'last_name' => 'Flores',
                'designation' => 'Records Analyst',
                'username' => 'gavin.flores',
                'email' => 'gavin@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $south->id,
                'role_id' => $userRole->id,
            ],
            [
                'employee_id' => 'EMP-1008',
                'first_name' => 'Hannah',
                'middle_name' => 'L',
                'last_name' => 'Castillo',
                'designation' => 'Administrative Assistant',
                'username' => 'hannah.castillo',
                'email' => 'hannah@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $hq->id,
                'role_id' => $userRole->id,
            ],
            [
                'employee_id' => 'EMP-1009',
                'first_name' => 'Ivan',
                'middle_name' => null,
                'last_name' => 'Navarro',
                'designation' => 'Field Staff',
                'username' => 'ivan.navarro',
                'email' => 'ivan@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $north->id,
                'role_id' => $userRole->id,
            ],
            [
                'employee_id' => 'EMP-1010',
                'first_name' => 'Jasmine',
                'middle_name' => null,
                'last_name' => 'Torres',
                'designation' => 'Data Encoder',
                'username' => 'jasmine.torres',
                'email' => 'jasmine@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $south->id,
                'role_id' => $userRole->id,
            ],
            [
                'employee_id' => 'EMP-1011',
                'first_name' => 'Kevin',
                'middle_name' => 'R',
                'last_name' => 'Dela Cruz',
                'designation' => 'Records Clerk',
                'username' => 'kevin.delacruz',
                'email' => 'kevin@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $north->id,
                'role_id' => $userRole->id,
            ],
            [
                'employee_id' => 'EMP-1012',
                'first_name' => 'Lara',
                'middle_name' => null,
                'last_name' => 'Domingo',
                'designation' => 'Records Officer',
                'username' => 'lara.domingo',
                'email' => 'lara@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $hq->id,
                'role_id' => $userRole->id,
            ],
            [
                'employee_id' => 'EMP-1013',
                'first_name' => 'Marco',
                'middle_name' => null,
                'last_name' => 'Ramos',
                'designation' => 'Client Support',
                'username' => 'marco.ramos',
                'email' => 'marco@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $south->id,
                'role_id' => $userRole->id,
            ],
            [
                'employee_id' => 'EMP-1014',
                'first_name' => 'Nina',
                'middle_name' => 'P',
                'last_name' => 'Velasco',
                'designation' => 'Administrative Clerk',
                'username' => 'nina.velasco',
                'email' => 'nina@lra.gov.ph',
                'password' => Hash::make('Pass123!'),
                'office_id' => $north->id,
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
