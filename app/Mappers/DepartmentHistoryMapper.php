<?php

namespace App\Mappers;

use App\Enums\HistoryAction;
use App\Models\DepartmentHistoryModel;
use App\Models\DepartmentModel;
use App\Models\ManufacturerHistoryModel;
use App\Models\ManufacturerModel;

class DepartmentHistoryMapper
{
    public static function mapModelToHistoryModelByAction(
        DepartmentModel $department,
        HistoryAction     $action,

    ): DepartmentHistoryModel
    {

        $history = new DepartmentHistoryModel();
        $history->setAttribute('department_id', $department->getAttribute('id'));
        $history->setAttribute('action', $action->value);
        $history->setAttribute('name', $department->getAttribute('name'));
        $history->setAttribute('description', $department->getAttribute('description'));

        if ($action === HistoryAction::INSERT) {
            $history->setAttribute('is_active', true);
        } elseif ($action === HistoryAction::UPDATE) {
            $history->setAttribute('is_active', $department->getAttribute('is_active'));
        }

        return $history;
    }
}
