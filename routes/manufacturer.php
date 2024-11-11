<?php

use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ManufacturerHistoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('/manufacturers')
    ->name('manufacturers.')
    ->controller(ManufacturerController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get(uri: '/', action: 'index')->name('index');
        Route::get(uri: '/{manufacturer}', action: 'permalink')
            ->where('manufacturer', '^[1-9][0-9]*$')
            ->name('permalink');
        Route::post(uri: '/{manufacturer}/update', action: 'update')
            ->where('manufacturer', '^[1-9][0-9]*$')
            ->name('update');
    });

Route::prefix('manufacturers')
    ->name('manufacturers.')
    ->controller(ManufacturerHistoryController::class)
    ->group(function () {
        Route::get(uri: '/{manufacturer}/history', action: 'history')
            ->where('manufacturer', '^[1-9][0-9]*$')
            ->name('history');
    });

