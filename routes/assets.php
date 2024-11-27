<?php

use App\Http\Controllers\AssetsController;
use Illuminate\Support\Facades\Route;

Route::prefix('/assets')
    ->name('assets.')
    ->middleware(['auth', 'HasPermission:assets-view'])
    ->controller(AssetsController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get(uri: '/create', action: 'renderCreate')
            ->middleware(['HasPermission:assets-create'])
            ->name('view.create');
        Route::post(uri: '/create', action: 'create')
            ->middleware(['HasPermission:assets-create'])
            ->name(name: 'create');
        Route::get(uri: '/{asset}', action: 'permalink')
            ->middleware(['HasPermission:assets-view'])
            ->where('asset', '^[0-9][1-9]*$')
            ->name(name: 'permalink');
        Route::post(uri: '/{asset}/update', action: 'update')
            ->middleware(['HasPermission:assets-edit'])
            ->where('asset', '^[0-9][1-9]*$')
            ->name(name: 'update');
        Route::get(uri: '/{asset}/manage', action: 'manage')
            ->middleware(['HasPermission:assets-manage'])
            ->name(name: 'manage');
    });
