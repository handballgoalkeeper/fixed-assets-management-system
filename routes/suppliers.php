<?php

use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierHistoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('/suppliers')
    ->name('suppliers.')
    ->controller(SupplierController::class)
    ->middleware(['auth'])
    ->group(function () {

        Route::view(uri: '/create', view: 'pages.suppliers.createForm')
            ->middleware(['HasPermission:suppliers-create'])
            ->name('view.create');

        Route::post(uri: '/create', action: 'create')
            ->middleware(['HasPermission:suppliers-create'])
            ->name('create');

        Route::get(uri: '/', action: 'index')
            ->middleware(['HasPermission:suppliers-view'])
            ->name('index');

        Route::get(uri: '/{supplier}', action: 'permalink')
            ->middleware(['HasPermission:suppliers-view'])
            ->where('supplier', '^[1-9][0-9]*$')->name('permalink');

        Route::post(uri: '/{supplier}/update', action: 'update')
            ->middleware(['HasPermission:suppliers-edit'])
            ->where('supplier', '^[1-9][0-9]*$')->name('update');

    });

Route::prefix('/suppliers')
    ->name('suppliers.')
    ->controller(SupplierHistoryController::class)
    ->group(function () {
        Route::get(uri: '/{supplier}/history', action: 'history')
            ->middleware(['HasPermission:suppliers-history'])
            ->where('supplier', '^[1-9][0-9]*$')
            ->name('history');
    });
