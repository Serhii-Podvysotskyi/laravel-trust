<?php

namespace App\Services\Trust1;

use App\Services\Trust1\Facades\Trust;
use App\Services\Trust1\Models\Permission;
use App\Services\Trust1\Models\Role;

trait Trustable
{
    public function getRoles()
    {
        return Trust::getRoles($this);
    }

    public function hasRoles($role)
    {
        return Trust::hasRole($role, $this);
    }

    public function getPermissions()
    {
        return Trust::getPermissions($this);
    }

    public function hasPermissions($permissions)
    {
        return Trust::hasPermissions($permissions, $this);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permissions');
    }
}
