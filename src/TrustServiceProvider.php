<?php

namespace Podvysotsky\Laravel\Trust;

use Podvysotsky\Laravel\Trust\Facades\Trust;
use Podvysotsky\Laravel\Trust\Models\Permission;
use Podvysotsky\Laravel\Trust\Models\Role;
use Podvysotsky\Laravel\Trust\Observers\PermissionObserver;
use Podvysotsky\Laravel\Trust\Observers\RoleObserver;
use Podvysotsky\Laravel\Trust\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class TrustServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('trust', function ($app) {
            return new TrustService($app);
        });
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        Role::observe(RoleObserver::class);
        Permission::observe(PermissionObserver::class);
        Trust::authUser()::observe(UserObserver::class);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/migrations' => database_path('migrations')
        ], 'migrations');
        $this->publishes([
            __DIR__ . '/config.php' => config_path('trust.php')
        ], 'config');
    }
}
