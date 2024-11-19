<?php

use App\Http\Controllers\AdminPanelController;
use Illuminate\Support\Facades\Route;

Route::view(uri: '/admin/', view: 'pages.admin.index')->middleware(['auth'])->name(name: 'admin.index');

Route::prefix('/admin')
    ->name('admin.')
    ->controller(AdminPanelController::class)
    ->middleware(['auth'])
    ->group(function () {
    });
