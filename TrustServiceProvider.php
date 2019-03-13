<?php

namespace App\Services\Trust;

use App\Services\Trust\Facades\Trust;
use App\Services\Trust\Models\Permission;
use App\Services\Trust\Models\Role;
use App\Services\Trust\Observers\PermissionObserver;
use App\Services\Trust\Observers\RoleObserver;
use App\Services\Trust\Observers\UserObserver;
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
