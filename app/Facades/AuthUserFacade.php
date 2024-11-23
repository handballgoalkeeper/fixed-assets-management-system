<?php

namespace App\Facades;

use App\Models\GroupXPermissionModel;
use App\Models\PermissionModel;
use App\Models\UserXGroupModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AuthUserFacade
{
    const AUTH_USER_SESSION_KEY = 'auth_user_permissions';
    public static function getGrantedPermissionsAsArray(): array
    {
        return Cache::remember(key: self::AUTH_USER_SESSION_KEY, ttl: 3600, callback: function () {
            $userPermissions = DB::table(table: UserXGroupModel::TABLE . ' AS uxg')
                ->select(columns: [
                    'p.name AS name'
                ])
                ->join(table: GroupXPermissionModel::TABLE . ' AS gxp', first: 'uxg.group_id', operator: '=', second: 'gxp.group_id')
                ->join(table: PermissionModel::TABLE . ' AS p', first: 'gxp.permission_id', operator: '=', second: 'p.id')
                ->where(column: 'uxg.user_id', operator: '=', value: auth()->id())
                ->groupBy(column: 'p.name')->get();

            return array_map(function ($permission) {
                return $permission->name;
            }, $userPermissions->toArray());
        });
    }
}
