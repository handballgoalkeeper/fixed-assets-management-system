<?php

namespace App\Configs;

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
                'permissionNeeded' => [
                    'manufacturers-view'
                ]
            ],
            'Suppliers' => [
                'route' => route('suppliers.index'),
                'icon' => 'bi-people',
                'permissionNeeded' => [
                    'suppliers-view'
                ]
            ],
            'Departments' => [
                'route' => route('departments.index'),
                'icon' => 'bi-person-workspace',
                'permissionNeeded' => [
                    'departments-view'
                ]
            ],
            'Locations' => [
                'route' => route('locations.index'),
                'icon' => 'bi-geo',
                'permissionNeeded' => [
                    'locations-view'
                ]
            ],
            'Employees' => [
                'route' => route('employees.index'),
                'icon' => 'bi-person-fill-check',
                'permissionNeeded' => [
                    'employees-view'
                ]
            ],
            'Assets' => [
                'route' => route('assets.index'),
                'icon' => 'bi-pc-display',
                'permissionNeeded' => [
                    'assets-view'
                ]
            ]
        ];
    }
}
