<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function (User $user): ?bool {
            return $user->hasRole('System Admin') ? true : null;
        });

        Gate::define('access-admin-backend', function (User $user): bool {
            return $user->hasPermission('view_users')
                || $user->hasPermission('view_roles')
                || $user->hasPermission('manage_offices');
        });

        Gate::define('view-users', function (User $user): bool {
            return $user->hasPermission('view_users') || $user->hasPermission('manage_users');
        });

        Gate::define('manage-users', function (User $user): bool {
            return $user->hasPermission('manage_users');
        });

        Gate::define('view-roles', function (User $user): bool {
            return $user->hasPermission('view_roles') || $user->hasPermission('manage_roles');
        });

        Gate::define('manage-roles', function (User $user): bool {
            return $user->hasPermission('manage_roles');
        });

        Gate::define('manage-offices', function (User $user): bool {
            return $user->hasPermission('manage_offices')
                || $user->hasPermission('manage_users');
        });

        Gate::define('access-payslip-view', function (User $user): bool {
            return $user->hasPermission('my_payslip') || $user->hasPermission('manage_payslips');
        });

        Gate::define('manage-payslips', function (User $user): bool {
            return $user->hasPermission('manage_payslips');
        });

        Gate::define('view-activity-logs', function (User $user): bool {
            return $user->hasRole('Admin');
        });

        Gate::define('delete-activity-logs', function (User $user): bool {
            return $user->hasRole('System Admin');
        });
    }
}
