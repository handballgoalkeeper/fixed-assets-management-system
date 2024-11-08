<?php

use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ManufacturerHistoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('manufacturers')
    ->name('manufacturers.')
    ->controller(ManufacturerController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get(uri: '/', action: 'index')->name('index');
        Route::get(uri: '/{manufacturer}', action: 'permalink')->name('permalink');
        Route::post(uri: '/{manufacturer}/update', action: 'update')->name('update');
    });

Route::prefix('manufacturers')
    ->name('manufacturers.')
    ->controller(ManufacturerHistoryController::class)
    ->group(function () {
        Route::get(uri: '/{manufacturer}/history', action: 'history')->name('history');
    });

