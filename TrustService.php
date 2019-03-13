<?php

namespace App\Services\Trust;

use App\Services\Trust\Models\Permission;
use App\Services\Trust\Models\Role;
use Illuminate\Foundation\Auth\User;

class TrustService
{
    protected $app;
    protected $user;
    protected $users;
    protected $roles;

    public function __construct($app)
    {
        $this->app = $app;
        $this->user = config('services.trust.user.model', User::class);
        $this->users = [];
        $this->roles = [];
    }

    protected function auth() {
        return $this->app['auth'];
    }

    public function authUser() {
        return $this->user;
    }

    public function getRoles($user = null) {
        if (is_null($user)) {
            if (!$this->auth()->check()) {
                return null;
            }
            $user = $this->auth()->id();
        }
        if (is_numeric($user)) {
            if (array_key_exists($user, $this->users) && array_key_exists('roles', $this->users[$user])) {
                return $this->users[$user]['roles'];
            }
            $user = $this->user::find($user);
            if (is_null($user)) {
                return [];
            }
        }
        if ($user instanceof $this->user) {
            if (!array_key_exists($user->id, $this->users)) {
                $this->users[$user->id] = [];
            }
            if (!array_key_exists('roles', $this->users[$user->id])) {
                $this->users[$user->id]['roles'] = $user->roles()->get()->pluck('name')->toArray();
            }
            return $this->users[$user->id]['roles'];
        }
        return [];
    }

    public function hasRole($role, $user = null)
    {
        $roles = $this->getRoles($user);
        if (count($roles) === 0) {
            return false;
        }
        if (is_array($role)) {
            foreach ($role as $r) {
                if (!$this->hasRole($r, $user)) {
                    return false;
                }
            }
            return true;
        }
        if (is_string($role)) {
            return in_array($role, $roles);
        }
        if (is_numeric($role)) {
            $role = Role::find($role);
            if (is_null($role)) {
                return false;
            }
        }
        if ($role instanceof Role) {
            return in_array($role->name, $roles);
        }
        return false;
    }

    public function getPermissions($model = null)
    {
        if (is_array($model)) {
            $permissions = [];
            foreach ($model as $m) {
                $permissions = array_merge($permissions, $this->getPermissions($m));
            }
            return $permissions;
        } else if (is_string($model)) {
            if (array_key_exists($model, $this->roles)) {
                return $this->roles[$model];
            }
            $model = Role::where('name', $model)->first();
            if (is_null($model)) {
                return [];
            }
        }
        if ($model instanceof Role) {
            if (!array_key_exists($model->name, $this->roles)) {
                $this->roles[$model->name] = $model->permissions()->get()->pluck('name')->toArray();
            }
            return $this->roles[$model->name];
        }
        $permissions = $this->getUserPermissions($model);
        if (is_null($permissions)) {
            return [];
        }
        $roles = $this->getRoles($model);
        foreach ($roles as $r) {
            $permissions = array_merge($this->getPermissions($r));
        }
        return $permissions;
    }

    public function hasPermissions($permission, $model = null)
    {
        if (is_array($permission)) {
            foreach ($permission as $p) {
                if (!$this->hasPermissions($p)) {
                    return false;
                }
            }
            return true;
        } else if (is_string($model) || $model instanceof Role) {
            return in_array($permission, $this->getPermissions($model));
        }
        $permissions = $this->getUserPermissions($model);
        if (is_null($permissions)) {
            return false;
        }
        if (in_array($permission, $permissions)) {
            return true;
        }
        $roles = $this->getRoles($model);
        foreach ($roles as $r) {
            if (in_array($permission, $r)) {
                return true;
            }
        }
        return false;
    }

    public function reload($model = null)
    {
        if (is_null($model)) {
            $this->users = [];
            $this->roles = [];
        }
        if ($model instanceof $this->user) {
            if (array_key_exists($model->id, $this->users)) {
                unset($this->users[$model]);
            }
            return;
        }
        if ($model instanceof Role) {
            if (array_key_exists($model->id, $this->roles)) {
                unset($this->roles[$model->id]);
            }
            foreach ($this->users as $key => $value) {
                if (array_key_exists('roles', $value)) {
                    unset($this->users[$key]['roles']);
                }
            }
        }
        if ($model instanceof Permission) {
            $this->roles = [];
            foreach ($this->users as $key => $value) {
                if (array_key_exists('permissions', $value)) {
                    unset($this->users[$key]['permissions']);
                }
            }
        }
    }

    protected function getUserPermissions($user) {
        if (is_null($user)) {
            if (!$this->auth()->check()) {
                return null;
            }
            $user = $this->auth()->id();
        }
        if (is_numeric($user)) {
            if (array_key_exists($user, $this->users) && array_key_exists('permissions', $this->users[$user])) {
                return $this->users[$user]['permissions'];
            }
            $user = $this->user::find($user);
            if (is_null($user)) {
                return null;
            }
        }
        if ($user instanceof $this->user) {
            if (!array_key_exists($user->id, $this->users)) {
                $this->users[$user->id] = [];
            }
            if (!array_key_exists('permissions', $this->users[$user->id])) {
                $this->users[$user->id]['permissions'] = $user->permissions()->get()->pluck('name')->toArray();
            }
            return $this->users[$user->id]['permissions'];
        }
        return null;
    }
}
