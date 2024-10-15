<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

class RolesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $jobsRoles = [
            'admin',
            'editor',
        ];

        foreach ($jobsRoles as $role) {
            $total = Role::where('name', $role)->count();
            if ($total == 0) {
                Role::create(['name' => $role]);
            }
        }
    }
}
