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
    });
