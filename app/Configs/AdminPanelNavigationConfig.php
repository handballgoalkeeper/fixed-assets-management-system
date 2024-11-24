<?php

namespace App\Configs;

use App\Http\Controllers\GroupsController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UserController;

class AdminPanelNavigationConfig
{
    public static function getAdminPanelNavigation(): array
    {
        return [
            'Home' => [
                'route' => route('admin.index'),
                'icon' => 'bi-house',
                'controller' => null,
                'permissionNeeded' => [
                    'admin-home'
                ]
            ],
            'Groups' => [
                'route' => route('admin.groups.index'),
                'icon' => 'bi-collection',
                'controller' => GroupsController::class,
                'permissionNeeded' => [
                    'admin-groups-view'
                ]
            ],
            'Permissions' => [
                'route' => route('admin.permissions.index'),
                'icon' => 'bi-person-vcard',
                'controller' => PermissionsController::class,
                'permissionNeeded' => [
                    'admin-permissions-view'
                ]
            ],
            'Users' => [
                'route' => route('admin.users.index'),
                'icon' => 'bi-person',
                'controller' => UserController::class,
                'permissionNeeded' => [
                    'admin-users-view'
                ]
            ],
        ];
    }

}
