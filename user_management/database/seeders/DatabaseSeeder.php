<?php

namespace Database\Seeders;

use App\Models\AccountRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = AccountRole::query()->firstOrCreate(
            ['role_code' => 'admin'],
            ['name' => 'Admin', 'description' => 'System administrator']
        );

        $userRole = AccountRole::query()->firstOrCreate(
            ['role_code' => 'user'],
            ['name' => 'User', 'description' => 'Standard user']
        );

        User::query()->updateOrCreate(
            ['email' => 'j.delacruz@lra.gov.ph'],
            [
                'employee_id' => '1234-5678',
                'first_name' => 'Juan',
                'middle_name' => 'C.',
                'last_name' => 'Dela Cruz',
                'username' => 'j.delacruz27',
                'password' => Hash::make('jdelacruz1234'),
                'designation' => 'IT Officer III',
                'role_id' => $adminRole->id,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'j.doe@lra.gov.ph'],
            [
                'employee_id' => '1234-8675',
                'first_name' => 'Jane',
                'middle_name' => 'F.',
                'last_name' => 'Doe',
                'username' => 'j_doe01',
                'password' => Hash::make('jdoe1234'),
                'designation' => 'Administrative Officer',
                'role_id' => $userRole->id,
            ]
        );
    }
}
