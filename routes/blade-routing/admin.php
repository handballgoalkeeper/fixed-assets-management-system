<?php

use App\Http\Controllers\GroupsController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view(uri: '/admin/', view: 'pages.admin.index')->middleware(['auth', 'HasPermission:admin-view'])->name(name: 'admin.index');

Route::prefix('/admin/groups')
    ->name('admin.groups.')
    ->controller(GroupsController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get(uri: '/', action: 'index')
            ->middleware(['HasPermission:admin-groups-view'])
            ->name('index');
        Route::view(uri: '/create', view: 'pages.admin.groups.createForm')
            ->middleware(['HasPermission:admin-groups-create'])
            ->name('view.create');
        Route::post(uri: '/create', action: 'create')
            ->middleware(['HasPermission:admin-groups-create'])
            ->name('create');
        Route::get(uri: '/{group}/edit', action: 'permalink')
            ->middleware(['HasPermission:admin-groups-view'])
            ->where('group', '^[0-9][1-9]*$')
            ->name('permalink');
        Route::post(uri: '/{group}/edit', action: 'update')
            ->middleware(['HasPermission:admin-groups-edit'])
            ->where('group', '^[0-9][1-9]*$')
            ->name('update');
        Route::get(uri: '/{group}/permissions', action: 'permissions')
            ->middleware(['HasPermission:admin-groups-permissions-view'])
            ->where('group', '^[1-9][0-9]*$')
            ->name('permissions');
        Route::post(uri: '/{group}/permissions/grant', action: 'grantPermission')
            ->middleware(['HasPermission:admin-groups-permissions-grant'])
            ->where('group', '^[1-9][0-9]*$')
            ->name('grantPermission');
        Route::get(uri: '/{group}/permissions/{permission}/revoke', action: 'revokePermission')
            ->middleware(['HasPermission:admin-groups-permissions-revoke'])
            ->where('group', '^[1-9][0-9]*$')
            ->name('revokePermission');
    });

Route::prefix('/admin/permissions')
    ->name('admin.permissions.')
    ->controller(PermissionsController::class)
    ->middleware(['auth', 'HasPermission:admin-permissions-view'])
    ->group(function () {
        Route::get(uri: '/', action: 'index')->name('index');
    });

Route::prefix('/admin/users')
    ->name('admin.users.')
    ->controller(UserController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get(uri: '/', action: 'index')
            ->middleware(['HasPermission:admin-users-view'])
            ->name('index');
        Route::view(uri: '/create', view: 'pages.admin.users.createForm')
            ->middleware(['HasPermission:admin-users-create'])
            ->name('view.create');
        Route::post(uri: '/create', action: 'create')
            ->middleware(['HasPermission:admin-users-create'])
            ->name(name: 'create');
        Route::get(uri: '/{user}', action: 'permalink')
            ->middleware(['HasPermission:admin-users-view'])
            ->where('user', '^[0-9][1-9]*$')
            ->name(name: 'permalink');
        Route::post(uri: '/{user}/update', action: 'update')
            ->middleware(['HasPermission:admin-users-edit'])
            ->where('user', '^[0-9][1-9]*$')
            ->name(name: 'update');
        Route::get(uri: '/{user}/groups', action: 'groups')
            ->middleware(['HasPermission:admin-users-groups-view'])
            ->where('user', '^[1-9][0-9]*$')
            ->name('groups');
        Route::post(uri: '/{user}/groups/grant', action: 'grantGroup')
            ->middleware(['HasPermission:admin-users-groups-grant'])
            ->where('user', '^[1-9][0-9]*$')
            ->name('grantGroup');
        Route::get(uri: '/{user}/groups/{group}/revoke', action: 'revokeGroup')
            ->middleware(['HasPermission:admin-users-groups-revoke'])
            ->where('user', '^[1-9][0-9]*$')
            ->where('group', '^[1-9][0-9]*$')
            ->name('revokeGroup');
    });
