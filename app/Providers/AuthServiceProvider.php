<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // ==== Gates berbasis role ====

        // Admin only
        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });

        // User only
        Gate::define('user', function (User $user) {
            return $user->role === 'user';
        });

        // Akses modul dokumen: admin & user
        Gate::define('access-documents', function (User $user) {
            return in_array($user->role, ['admin', 'user'], true);
        });

        // Kelola user: admin saja
        Gate::define('manage-users', function (User $user) {
            return $user->role === 'admin';
        });

        // Gate dinamis: pakai can:role,admin / can:role,user
        Gate::define('role', function (User $user, string $role) {
            return $user->role === strtolower($role);
        });

        // (Opsional) Admin bypass semua gate
        /*
        Gate::before(function (User $user, string $ability) {
            return $user->role === 'admin' ? true : null;
        });
        */
    }
}
