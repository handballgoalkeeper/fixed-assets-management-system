<?php

use App\Configs\MainNavigationConfig;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('/departments')
    ->name('departments.')
    ->controller(controller:DepartmentController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::view(uri: '/', view: 'pages.departments.index')->name(name: 'index');
    });
