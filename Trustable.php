<?php

namespace App\Services\Trust;

use App\Services\Trust\Facades\Trust;
use App\Services\Trust\Models\Permission;
use App\Services\Trust\Models\Role;

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
