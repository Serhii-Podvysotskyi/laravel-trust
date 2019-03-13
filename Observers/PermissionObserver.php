<?php

namespace App\Services\Trust1\Observers;

use App\Services\Trust1\Facades\Trust;
use App\Services\Trust1\Models\Permission;

class PermissionObserver
{
    public function created(Permission $permission)
    {
        Trust::reload($permission);
    }

    public function updated(Permission $permission)
    {
        Trust::reload($permission);
    }

    public function deleted(Permission $permission)
    {
        Trust::reload($permission);
    }
}
