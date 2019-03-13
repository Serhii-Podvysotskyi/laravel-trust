<?php

namespace App\Services\Trust\Observers;

use App\Services\Trust\Facades\Trust;
use App\Services\Trust\Models\Role;

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
