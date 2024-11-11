<?php

namespace App\Providers;

use App\Repositories\DepartmentRepository;
use App\Repositories\ManufacturerHistoryRepository;
use App\Repositories\ManufacturerRepository;
use App\Repositories\SupplierRepository;
use App\Services\DepartmentService;
use App\Services\ManufacturerHistoryService;
use App\Services\ManufacturerService;
use App\Services\SupplierService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ManufacturerRepository::class, function ($app) {
            return new ManufacturerRepository();
        });

        $this->app->singleton(ManufacturerService::class, function ($app) {
            return new ManufacturerService(
                manufacturerRepository: $app->make(ManufacturerRepository::class)
            );
        });

        $this->app->singleton(ManufacturerHistoryRepository::class, function ($app) {
            return new ManufacturerHistoryRepository();
        });

        $this->app->singleton(ManufacturerHistoryService::class, function ($app) {
            return new ManufacturerHistoryService(
                manufacturerHistoryRepository: $app->make(ManufacturerHistoryRepository::class)
            );
        });

        $this->app->singleton(SupplierRepository::class, function ($app) {
            return new SupplierRepository();
        });

        $this->app->singleton(SupplierService::class, function ($app) {
            return new SupplierService(
                supplierRepository: $app->make(SupplierRepository::class)
            );
        });

        $this->app->singleton(DepartmentRepository::class, function ($app) {
            return new DepartmentRepository();
        });

        $this->app->singleton(DepartmentService::class, function ($app) {
            return new DepartmentService(
                departmentRepository: $app->make(DepartmentRepository::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
