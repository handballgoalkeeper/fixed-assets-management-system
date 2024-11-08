<?php

namespace App\Configs;

use App\Http\Controllers\ManufacturerController;

class MainNavigationConfig
{
    public static function getMainNavigation(): array {
        return [
            'Home' => [
                'route' => route('home'),
                'icon' => 'bi-house',
                'controller' => null,
            ],
            'Manufacturers' => [
                'route' => route('manufacturers.index'),
                'icon' => 'bi-wrench',
                'controller' => ManufacturerController::class,
            ],
        ];
    }
}
