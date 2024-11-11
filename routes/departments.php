<?php

use App\Configs\MainNavigationConfig;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('/departments')
    ->name('departments.')
    ->controller(DepartmentController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get(uri: '/', action: 'index')->name(name: 'index');
        Route::view(uri: '/create', view: 'pages.departments.createForm')->name('view.create');
        Route::post(uri: '/create', action: 'create')->name(name: 'create');
        Route::get(uri: '/{department}', action: 'permalink')
            ->where('department', '^[0-9][1-9]*$')
            ->name(name: 'permalink');
        Route::post(uri: '/{department}/update', action: 'update')
            ->where('department', '^[0-9][1-9]*$')
            ->name(name: 'update');
    });
