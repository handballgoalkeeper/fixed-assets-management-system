<?php

namespace App\Observers;

use App\Models\DepartmentModel;
use App\Services\DepartmentHistoryService;

class DepartmentModelObserver
{
    /**
     * Handle the DepartmentModel "created" event.
     */
    public function created(DepartmentModel $departmentModel): void
    {
        app(DepartmentHistoryService::class)->handleDepartmentCreated($departmentModel);
    }

    /**
     * Handle the DepartmentModel "updated" event.
     */
    public function updated(DepartmentModel $departmentModel): void
    {
        app(DepartmentHistoryService::class)->handleManufacturerUpdated($departmentModel);

    }

    /**
     * Handle the DepartmentModel "deleted" event.
     */
    public function deleted(DepartmentModel $departmentModel): void
    {
        //
    }

    /**
     * Handle the DepartmentModel "restored" event.
     */
    public function restored(DepartmentModel $departmentModel): void
    {
        //
    }

    /**
     * Handle the DepartmentModel "force deleted" event.
     */
    public function forceDeleted(DepartmentModel $departmentModel): void
    {
        //
    }
}
