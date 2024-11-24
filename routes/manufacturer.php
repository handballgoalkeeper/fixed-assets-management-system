<?php

use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ManufacturerHistoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('/manufacturers')
    ->name('manufacturers.')
    ->controller(ManufacturerController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get(uri: '/', action: 'index')
            ->middleware(['HasPermission:manufacturers-view'])
            ->name('index');
        Route::get(uri: '/{manufacturer}', action: 'permalink')
            ->middleware(['HasPermission:manufacturers-view'])
            ->where('manufacturer', '^[1-9][0-9]*$')
            ->name('permalink');
        Route::post(uri: '/{manufacturer}/update', action: 'update')
            ->middleware(['HasPermission:manufacturers-edit'])
            ->where('manufacturer', '^[1-9][0-9]*$')
            ->name('update');
        Route::view(uri: '/create', view: 'pages.manufacturers.createForm')
            ->middleware(['HasPermission:manufacturers-create'])
            ->name('view.create');
        Route::post(uri: '/create', action: 'create')
            ->middleware(['HasPermission:manufacturers-create'])
            ->name('create');
    });

Route::prefix('manufacturers')
    ->name('manufacturers.')
    ->controller(ManufacturerHistoryController::class)
    ->group(function () {
        Route::get(uri: '/{manufacturer}/history', action: 'history')
            ->middleware(['HasPermission:manufacturers-history'])
            ->where('manufacturer', '^[1-9][0-9]*$')
            ->name('history');
    });

