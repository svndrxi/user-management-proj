<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    /**
     * Seed sample activity logs.
     */
    public function run(): void
    {
        $users = User::query()->get();

        foreach ($users as $user) {
            ActivityLog::query()->create([
                'user_id' => $user->id,
                'action' => 'login',
                'module' => 'Authentication',
                'description' => 'User logged in successfully.',
                'ip_address' => '127.0.0.1',
            ]);

            ActivityLog::query()->create([
                'user_id' => $user->id,
                'action' => 'view_profile',
                'module' => 'User Management',
                'description' => 'User viewed profile details.',
                'ip_address' => '127.0.0.1',
            ]);
        }
    }
}
