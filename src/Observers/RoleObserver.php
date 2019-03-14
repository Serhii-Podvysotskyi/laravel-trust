<?php

namespace Podvysotsky\Laravel\Trust\Observers;

use Podvysotsky\Laravel\Trust\Facades\Trust;
use Podvysotsky\Laravel\Trust\Models\Role;

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
