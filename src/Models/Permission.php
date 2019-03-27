<?php

namespace Podvysotsky\Laravel\Trust\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 */
class Permission extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_permissions');
    }
}
