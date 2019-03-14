<?php

namespace Podvysotsky\Laravel\Trust;

use Podvysotsky\Laravel\Trust\Models\Permission;
use Podvysotsky\Laravel\Trust\Models\Role;
use Podvysotsky\Laravel\Trust\Observers\PermissionObserver;
use Podvysotsky\Laravel\Trust\Observers\RoleObserver;
use Podvysotsky\Laravel\Trust\Observers\UserObserver;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\ServiceProvider;

class TrustServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('trust', function ($app) {
            return new TrustService($app);
        });
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        Role::observe(RoleObserver::class);
        Permission::observe(PermissionObserver::class);
        User::observe(UserObserver::class);
    }

    public function boot()
    {

    }
}
