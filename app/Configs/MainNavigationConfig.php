<?php

namespace App\Configs;

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\SupplierController;

class MainNavigationConfig
{
    public static function getMainNavigation(): array
    {
        return [
            'Home' => [
                'route' => route('home'),
                'icon' => 'bi-house',
                'controller' => null,
                'permissionNeeded' => null
            ],
            'Manufacturers' => [
                'route' => route('manufacturers.index'),
                'icon' => 'bi-wrench',
                'controller' => ManufacturerController::class,
                'permissionNeeded' => [
                    'superuser',
                    'manufacturers-view'
                ]
            ],
            'Suppliers' => [
                'route' => route('suppliers.index'),
                'icon' => 'bi-people',
                'controller' => SupplierController::class,
                'permissionNeeded' => [
                    'superuser',
                    'suppliers-view'
                ]
            ],
            'Departments' => [
                'route' => route('departments.index'),
                'icon' => 'bi-person-workspace',
                'controller' => DepartmentController::class,
                'permissionNeeded' => [
                    'superuser',
                    'departments-view'
                ]
            ],
            'Locations' => [
                'route' => route('locations.index'),
                'icon' => 'bi-geo',
                'controller' => LocationsController::class,
                'permissionNeeded' => [
                    'superuser',
                    'locations-view'
                ]
            ]
        ];
    }
}
