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
        $currentUserId = auth()->id();
        return Cache::tags(self::AUTH_USER_SESSION_KEY)
            ->remember(key: self::AUTH_USER_SESSION_KEY . "_{$currentUserId}", ttl: 3600, callback: function () use ($currentUserId) {
            try {
                $userPermissions = app(UserService::class)->getUserPermissionsByUserId(userId: $currentUserId);
            }
            catch (Exception) {
                return [];
            }

            return array_map(function ($permission) {
                return $permission->name;
            }, $userPermissions->toArray());
        });
    }

        public static function forgetPermissionsCacheForCurrentUser(): void
    {
        $currentUserId = auth()->id();
        Cache::forget(key: AuthUserFacade::AUTH_USER_SESSION_KEY . "_{$currentUserId}");
    }

    public static function hasPermission(array|string $permissions): bool
    {
        $userPermissions = self::getGrantedPermissionsAsArray();
        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                if (in_array($permission, $userPermissions)) {
                    return true;
                }
            }

            return false;
        }
        else if (is_string($permissions)) {
            return in_array($permissions, $userPermissions);
        }

        return false;
    }
}
