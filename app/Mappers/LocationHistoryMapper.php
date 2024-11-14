<?php

namespace App\Mappers;

use App\Enums\HistoryAction;
use App\Models\LocationHistoryModel;
use App\Models\LocationModel;

class LocationHistoryMapper
{
    public static function mapModelToHistoryModelByAction(
        LocationModel $location,
        HistoryAction     $action,

    ): LocationHistoryModel
    {

        $history = new LocationHistoryModel();
        $history->setAttribute('location_id', $location->getAttribute('id'));
        $history->setAttribute('action', $action->value);
        $history->setAttribute('alias', $location->getAttribute('alias'));
        $history->setAttribute('street_name', $location->getAttribute('street_name'));
        $history->setAttribute('street_number', $location->getAttribute('street_number'));
        $history->setAttribute('city', $location->getAttribute('city'));

        if ($action === HistoryAction::INSERT) {
            $history->setAttribute('is_active', true);
        } elseif ($action === HistoryAction::UPDATE) {
            $history->setAttribute('is_active', $location->getAttribute('is_active'));
        }

        return $history;
    }
}
