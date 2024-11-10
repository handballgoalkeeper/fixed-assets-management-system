<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::prefix('suppliers')
    ->name('suppliers.')
    ->controller(SupplierController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get(uri: '/{supplier}', action: 'permalink')->name('permalink');
        Route::post(uri: '/{supplier}/update', action: 'update')->name('update');
    });
