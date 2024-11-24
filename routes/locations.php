<?php

use App\Http\Controllers\LocationHistoryController;
use App\Http\Controllers\LocationsController;
use Illuminate\Support\Facades\Route;

Route::prefix('/locations')
    ->name('locations.')
    ->controller(LocationsController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', 'index')
            ->middleware(['HasPermission:locations-view'])
            ->name('index');
        Route::view('/create', 'pages.locations.createForm')
            ->middleware(['HasPermission:locations-create'])
            ->name('view.create');
        Route::post('/create', 'create')
            ->middleware(['HasPermission:locations-create'])
            ->name('create');
        Route::get(uri: '/{location}', action: 'permalink')
            ->middleware(['HasPermission:locations-view'])
            ->where('location', '^[1-9][0-9]*$')
            ->name('permalink');
        Route::post(uri: '/{location}', action: 'update')
            ->middleware(['HasPermission:locations-edit'])
            ->where('location', '^[1-9][0-9]*$')
            ->name('update');
    });

Route::prefix('/locations')
    ->name('locations.')
    ->controller(LocationHistoryController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/{location}/history', 'history')
            ->middleware(['HasPermission:locations-history'])
            ->where('location', '^[1-9][0-9]*$')
            ->name('history');
    });
