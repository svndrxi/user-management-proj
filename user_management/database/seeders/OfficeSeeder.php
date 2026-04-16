<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Seed the application's offices.
     */
    public function run(): void
    {
        $offices = [
            ['office_code' => 'HQ', 'name' => 'Head Office', 'description' => 'Main administrative office'],
            ['office_code' => 'NORTH', 'name' => 'North Branch', 'description' => 'Northern operations'],
            ['office_code' => 'SOUTH', 'name' => 'South Branch', 'description' => 'Southern operations'],
            ['office_code' => 'HR', 'name' => 'Human Resources', 'description' => 'Human resources department'],
            ['office_code' => 'IT', 'name' => 'Information Technology', 'description' => 'IT department'],
        ];

        foreach ($offices as $office) {
            Office::query()->updateOrCreate(
                ['office_code' => $office['office_code']],
                $office
            );
        }
    }
}
