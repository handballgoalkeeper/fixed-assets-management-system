<?php

use App\Http\Controllers\ManufacturerController;
use Illuminate\Support\Facades\Route;

Route::prefix('manufacturers')
    ->name('manufacturers.')
    ->controller(ManufacturerController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get(uri: '/', action: 'index')->name('index');
    });
