<?php

namespace App\Observers;

use App\Models\ManufacturerModel;
use App\Services\ManufacturerHistoryService;

class ManufacturerModelObserver
{
    /**
     * Handle the ManufacturerModel "created" event.
     */
    public function created(ManufacturerModel $manufacturerModel): void
    {
        app(ManufacturerHistoryService::class)->handleManufacturerCreated($manufacturerModel);
    }

    /**
     * Handle the ManufacturerModel "updated" event.
     */
    public function updated(ManufacturerModel $manufacturerModel): void
    {
        app(ManufacturerHistoryService::class)->handleManufacturerUpdated($manufacturerModel);
    }

    /**
     * Handle the ManufacturerModel "deleted" event.
     */
    public function deleted(ManufacturerModel $manufacturerModel): void
    {
        //
    }

    /**
     * Handle the ManufacturerModel "restored" event.
     */
    public function restored(ManufacturerModel $manufacturerModel): void
    {
        //
    }

    /**
     * Handle the ManufacturerModel "force deleted" event.
     */
    public function forceDeleted(ManufacturerModel $manufacturerModel): void
    {
        //
    }
}
