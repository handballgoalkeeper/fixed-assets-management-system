<?php

namespace App\Providers;

use App\Repositories\DepartmentHistoryRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\GroupRepository;
use App\Repositories\GroupXPermissionRepository;
use App\Repositories\LocationHistoryRepository;
use App\Repositories\LocationsRepository;
use App\Repositories\ManufacturerHistoryRepository;
use App\Repositories\ManufacturerRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\SupplierHistoryRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserXGroupsRepository;
use App\Services\DepartmentHistoryService;
use App\Services\DepartmentService;
use App\Services\GroupService;
use App\Services\LocationHistoryService;
use App\Services\LocationsService;
use App\Services\ManufacturerHistoryService;
use App\Services\ManufacturerService;
use App\Services\PermissionService;
use App\Services\SupplierHistoryService;
use App\Services\SupplierService;
use App\Services\UserService;
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

        $this->app->singleton(DepartmentHistoryRepository::class, function ($app) {
            return new DepartmentHistoryRepository();
        });

        $this->app->singleton(DepartmentHistoryService::class, function ($app) {
            return new DepartmentHistoryService(
                departmentHistoryRepository: $app->make(DepartmentHistoryRepository::class)
            );
        });

        $this->app->singleton(SupplierHistoryRepository::class, function ($app) {
            return new SupplierHistoryRepository();
        });

        $this->app->singleton(SupplierHistoryService::class, function ($app) {
            return new SupplierHistoryService(
                supplierHistoryRepository: $app->make(SupplierHistoryRepository::class)
            );
        });

        $this->app->singleton(LocationsRepository::class, function ($app) {
            return new LocationsRepository();
        });

        $this->app->singleton(LocationsService::class, function ($app) {
            return new LocationsService(
                locationsRepository: $app->make(LocationsRepository::class)
            );
        });

        $this->app->singleton(LocationHistoryRepository::class, function ($app) {
            return new LocationHistoryRepository();
        });

        $this->app->singleton(LocationHistoryService::class, function ($app) {
            return new LocationHistoryService(
                locationHistoryRepository: $app->make(LocationHistoryRepository::class)
            );
        });

        $this->app->singleton(PermissionRepository::class, function ($app) {
            return new PermissionRepository();
        });

        $this->app->singleton(PermissionService::class, function ($app) {
            return new PermissionService(
                permissionRepository: $app->make(PermissionRepository::class)
            );
        });

        $this->app->singleton(GroupRepository::class, function ($app) {
            return new GroupRepository();
        });

        $this->app->singleton(GroupService::class, function ($app) {
            return new GroupService(
                groupRepository: $app->make(GroupRepository::class),
                groupXPermissionRepository: $app->make(GroupXPermissionRepository::class)
            );
        });

        $this->app->singleton(GroupXPermissionRepository::class, function ($app) {
            return new GroupXPermissionRepository();
        });

        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository();
        });

        $this->app->singleton(UserXGroupsRepository::class, function ($app) {
            return new UserXGroupsRepository();
        });

        $this->app->singleton(UserService::class, function ($app) {
            return new UserService(
                userRepository: $app->make(UserRepository::class),
                userXGroupsRepository: $app->make(UserXGroupsRepository::class)
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
