<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/employees')
    ->name('employees.')
    ->controller(EmployeeController::class)
    ->middleware(['auth', 'HasPermission:employees-view'])
    ->group(function () {
        Route::get(uri: '/', action: 'index')->name(name: 'index');
        Route::view('/create', 'pages.employees.createForm')
            ->middleware(['HasPermission:employees-create'])
            ->name('view.create');
        Route::post('/create', 'create')
            ->middleware(['HasPermission:employees-create'])
            ->name('create');
    });
