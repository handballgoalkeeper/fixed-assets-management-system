<?php

namespace App\Mappers;

use App\Enums\HistoryAction;
use App\Models\ManufacturerHistoryModel;
use App\Models\ManufacturerModel;
use App\Models\SupplierHistoryModel;
use App\Models\SupplierModel;

class SupplierHistoryMapper
{
    public static function mapModelToHistoryModelByAction(
        SupplierModel $supplier,
        HistoryAction     $action,

    ): SupplierHistoryModel
    {

        $history = new SupplierHistoryModel();
        $history->setAttribute('supplier_id', $supplier->getAttribute('id'));
        $history->setAttribute('action', $action->value);
        $history->setAttribute('name', $supplier->getAttribute('name'));
        $history->setAttribute('description', $supplier->getAttribute('description'));
        $history->setAttribute('PIB', $supplier->getAttribute('PIB'));
        $history->setAttribute('contact_person', $supplier->getAttribute('contact_person'));

        if ($action === HistoryAction::INSERT) {
            $history->setAttribute('is_active', true);
        } elseif ($action === HistoryAction::UPDATE) {
            $history->setAttribute('is_active', $supplier->getAttribute('is_active'));
        }

        return $history;
    }
}
