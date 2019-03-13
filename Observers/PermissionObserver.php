<?php

namespace App\Services\Trust\Observers;

use App\Services\Trust\Facades\Trust;
use App\Services\Trust\Models\Permission;

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
