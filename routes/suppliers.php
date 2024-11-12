<?php

use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierHistoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('/suppliers')
    ->name('suppliers.')
    ->controller(SupplierController::class)
    ->middleware(['auth'])
    ->group(function () {

        Route::view(uri: '/create', view: 'pages.suppliers.createForm')->name('view.create');

        Route::post(uri: '/create', action: 'create')->name('create');

        Route::get(uri: '/', action: 'index')->name('index');

        Route::get(uri: '/{supplier}', action: 'permalink')
            ->where('supplier', '^[1-9][0-9]*$')->name('permalink');

        Route::post(uri: '/{supplier}/update', action: 'update')
            ->where('supplier', '^[1-9][0-9]*$')->name('update');

    });

Route::prefix('/suppliers')
    ->name('suppliers.')
    ->controller(SupplierHistoryController::class)
    ->group(function () {
        Route::get(uri: '/{supplier}/history', action: 'history')
            ->where('supplier', '^[1-9][0-9]*$')
            ->name('history');
    });
