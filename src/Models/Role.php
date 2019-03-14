<?php

namespace Podvysotsky\Laravel\Trust\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 */
class Role extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_roles');
    }
}
