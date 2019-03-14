<?php

namespace Podvysotsky\Laravel\Trust;

use Podvysotsky\Laravel\Trust\Facades\Trust;
use Podvysotsky\Laravel\Trust\Models\Permission;
use Podvysotsky\Laravel\Trust\Models\Role;

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
