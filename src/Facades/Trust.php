<?php

namespace Podvysotsky\Laravel\Trust\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static boolean hasRole($role, $user = null)
 * @method static array getRoles($user = null)
 * @method static boolean hasPermissions($permission, $model = null)
 * @method static array getPermissions($model = null)
 * @method static reload($model = null)
 * @method static string authUser()
 *
 * @see \App\Services\Trust\TrustService
 */
class Trust extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'trust';
    }
}
