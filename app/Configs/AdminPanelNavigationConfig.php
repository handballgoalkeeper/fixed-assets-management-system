<?php

namespace App\Configs;

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
        ];
    }

}
