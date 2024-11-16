<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home')->middleware('auth');

require __DIR__ . '/auth.php';
require __DIR__ . '/manufacturer.php';
require __DIR__ . '/suppliers.php';
require __DIR__ . '/departments.php';
require __DIR__ . '/locations.php';
