<?php

namespace App\Observers;

use App\Models\SupplierModel;
use App\Services\SupplierHistoryService;

class SupplierModelObserver
{
    public function created(SupplierModel $supplierModel): void
    {
        app(SupplierHistoryService::class)->handleSupplierCreated($supplierModel);
    }

    public function updated(SupplierModel $supplierModel): void
    {
        app(SupplierHistoryService::class)->handleSupplierUpdated($supplierModel);
    }
}
