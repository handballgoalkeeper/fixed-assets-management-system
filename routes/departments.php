<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentHistoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('/departments')
    ->name('departments.')
    ->controller(DepartmentController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get(uri: '/', action: 'index')
            ->middleware(['HasPermission:departments-view'])
            ->name(name: 'index');
        Route::view(uri: '/create', view: 'pages.departments.createForm')
            ->middleware(['HasPermission:departments-create'])
            ->name('view.create');
        Route::post(uri: '/create', action: 'create')
            ->middleware(['HasPermission:departments-create'])
            ->name(name: 'create');
        Route::get(uri: '/{department}', action: 'permalink')
            ->middleware(['HasPermission:departments-view'])
            ->where('department', '^[0-9][1-9]*$')
            ->name(name: 'permalink');
        Route::post(uri: '/{department}/update', action: 'update')
            ->middleware(['HasPermission:departments-edit'])
            ->where('department', '^[0-9][1-9]*$')
            ->name(name: 'update');
    });

Route::prefix('/departments')
    ->name('departments.')
    ->controller(DepartmentHistoryController::class)
    ->middleware(['auth', 'HasPermission:departments-history'])
    ->group(function () {
        Route::get(uri: '/{department}/history', action: 'index')
            ->where('department', '^[0-9][1-9]*$')->name(name: 'history');
    });
