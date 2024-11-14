<?php

use App\Http\Controllers\LocationsController;
use Illuminate\Support\Facades\Route;

Route::prefix('/locations')
    ->name('locations.')
    ->controller(LocationsController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::view('/create', 'pages.locations.createForm')->name('view.create');
        Route::post('/create', 'create')->name('create');
        Route::get(uri: '/{location}', action: 'permalink')
            ->where('location', '^[1-9][0-9]*$')
            ->name('permalink');
        Route::post(uri: '/{location}', action: 'update')
            ->where('location', '^[1-9][0-9]*$')
            ->name('update');
    });
