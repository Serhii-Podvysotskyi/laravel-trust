<?php

namespace App\Services\Trust1\Models;

use App\Services\Trust1\Facades\Trust;
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
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    public function users() {
        return $this->belongsToMany(Trust::user(), 'user_permissions');
    }
}
