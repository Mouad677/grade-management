<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'admin' => \App\Policies\RolePolicy::class,
        'student' => \App\Policies\RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define gates for roles
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('student', function ($user) {
            return $user->role === 'student';
        });
    }
}
