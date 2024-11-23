<?php

namespace App\Facades;

use App\Services\UserService;
use Exception;
use Illuminate\Support\Facades\Cache;

class AuthUserFacade
{
    const AUTH_USER_SESSION_KEY = 'auth_user_permissions';
    public static function getGrantedPermissionsAsArray(): array
    {
        return Cache::remember(key: self::AUTH_USER_SESSION_KEY, ttl: 3600, callback: function () {
            try {
                $userPermissions = app(UserService::class)->getUserPermissionsByUserId(userId: auth()->id());
            }
            catch (Exception) {
                return [];
            }

            return array_map(function ($permission) {
                return $permission->name;
            }, $userPermissions->toArray());
        });
    }
}
