<?php

namespace App\Providers;

use App\Repositories\ManufacturerRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
