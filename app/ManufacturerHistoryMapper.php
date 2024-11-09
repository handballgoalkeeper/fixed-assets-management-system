<?php

namespace App;

use App\Enums\ManufacturerHistoryAction;
use App\Models\ManufacturerHistoryModel;
use App\Models\ManufacturerModel;

class ManufacturerHistoryMapper
{
    public static function mapModelToHistoryModelByAction(
        ManufacturerModel $manufacturer,
        ManufacturerHistoryAction $action,

    ): ManufacturerHistoryModel {

        $history = new ManufacturerHistoryModel();
        $history->setAttribute('manufacturer_id', $manufacturer->getAttribute('id'));
        $history->setAttribute('action', $action->value);
        $history->setAttribute('name', $manufacturer->getAttribute('name'));
        $history->setAttribute('description', $manufacturer->getAttribute('description'));

        if ($action === ManufacturerHistoryAction::INSERT) {
            $history->setAttribute('is_active', true);
        }
        elseif ($action === ManufacturerHistoryAction::UPDATE) {
            $history->setAttribute('is_active', $manufacturer->getAttribute('is_active'));
        }

        return $history;
    }
}
