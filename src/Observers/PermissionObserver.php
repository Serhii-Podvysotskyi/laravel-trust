<?php

namespace Podvysotsky\Laravel\Trust\Observers;

use Podvysotsky\Laravel\Trust\Facades\Trust;
use Podvysotsky\Laravel\Trust\Models\Permission;

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
