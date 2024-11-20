<?php

use App\Http\Controllers\GroupsController;
use App\Http\Controllers\PermissionsController;
use Illuminate\Support\Facades\Route;

Route::view(uri: '/admin/', view: 'pages.admin.index')->middleware(['auth'])->name(name: 'admin.index');

Route::prefix('/admin/groups')
    ->name('admin.groups.')
    ->controller(GroupsController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get(uri: '/', action: 'index')->name('index');
        Route::view(uri: '/create', view: 'pages.admin.groups.createForm')->name('view.create');
        Route::post(uri: '/create', action: 'create')->name('create');
        Route::get(uri: '/{group}/edit', action: 'permalink')
            ->where('group', '^[0-9][1-9]*$')
            ->name('permalink');
        Route::post(uri: '/{group}/edit', action: 'update')
            ->where('group', '^[0-9][1-9]*$')
            ->name('update');
    });

Route::prefix('/admin/permissions')
    ->name('admin.permissions.')
    ->controller(PermissionsController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get(uri: '/', action: 'index')->name('index');
    });
