<?php

namespace App\Providers;

use App\Repositories\ManufacturerHistoryRepository;
use App\Repositories\ManufacturerRepository;
use App\Services\ManufacturerHistoryService;
use App\Services\ManufacturerService;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
