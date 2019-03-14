<?php

namespace Podvysotsky\Laravel\Trust\Models;

use Podvysotsky\Laravel\Trust\Facades\Trust;
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
        return $this->belongsToMany(Trust::user(), 'user_roles');
    }
}
