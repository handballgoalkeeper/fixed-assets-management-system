<?php

use App\Livewire\AssetsHome;
use App\Livewire\DepartmentsHome;
use App\Livewire\EmployeeHome;
use App\Livewire\HomePage;
use App\Livewire\LocationsHome;
use App\Livewire\Manufacturers\Index\Page AS ManufacturerIndex;
use App\Livewire\SuppliersHome;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/', action: HomePage::class)->name('home');

Route::get(uri: '/manufacturers', action: ManufacturerIndex::class)->name('manufacturers.index');
Route::get(uri: '/suppliers', action: SuppliersHome::class)->name('suppliers.index');
Route::get(uri: '/departments', action: DepartmentsHome::class)->name('departments.index');
Route::get(uri: '/locations', action: LocationsHome::class)->name('locations.index');
Route::get(uri: '/employees', action: EmployeeHome::class)->name('employees.index');
Route::get(uri: '/assets', action: AssetsHome::class)->name('assets.index');


require __DIR__ . '/auth.php';
