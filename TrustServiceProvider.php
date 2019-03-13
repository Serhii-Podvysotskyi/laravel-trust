<?php

namespace App\Services\Trust1;

use App\Services\Trust1\Facades\Trust;
use App\Services\Trust1\Models\Permission;
use App\Services\Trust1\Models\Role;
use App\Services\Trust1\Observers\PermissionObserver;
use App\Services\Trust1\Observers\RoleObserver;
use App\Services\Trust1\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class TrustServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('trust', function ($app) {
            return new TrustService($app);
        });
    }

    public function boot()
    {
        Role::observe(RoleObserver::class);
        Permission::observe(PermissionObserver::class);
        Trust::authUser()::observe(UserObserver::class);
    }
}
