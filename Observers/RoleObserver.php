<?php

namespace App\Services\Trust1\Observers;

use App\Services\Trust1\Facades\Trust;
use App\Services\Trust1\Models\Role;

class RoleObserver
{
    public function created(Role $role)
    {
        Trust::reload($role);
    }

    public function updated(Role $role)
    {
        Trust::reload($role);
    }

    public function deleted(Role $role)
    {
        Trust::reload($role);
    }
}
