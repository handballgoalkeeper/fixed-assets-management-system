<?php

namespace App\Configs;

use App\Http\Controllers\GroupsController;
use App\Http\Controllers\PermissionsController;

class AdminPanelNavigationConfig
{
    public static function getAdminPanelNavigation(): array
    {
        return [
            'Home' => [
                'route' => route('admin.index'),
                'icon' => 'bi-house',
                'controller' => null,
            ],
            'Groups' => [
                'route' => route('admin.groups.index'),
                'icon' => 'bi-collection',
                'controller' => GroupsController::class,
            ],
            'Permissions' => [
                'route' => route('admin.permissions.index'),
                'icon' => 'bi-person-vcard',
                'controller' => PermissionsController::class,
            ],
        ];
    }

}
