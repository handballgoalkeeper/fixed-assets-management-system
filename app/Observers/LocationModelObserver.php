<?php

namespace App\Observers;

use App\Models\LocationModel;
use App\Services\LocationHistoryService;

class LocationModelObserver
{
    public function created(LocationModel $locationHistoryModel): void
    {
        app(LocationHistoryService::class)->handleLocationCreated($locationHistoryModel);
    }

    public function updated(LocationModel $locationHistoryModel): void
    {
        app(LocationHistoryService::class)->handleLocationUpdated($locationHistoryModel);
    }
}
