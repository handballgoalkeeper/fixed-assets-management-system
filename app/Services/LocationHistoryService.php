<?php

namespace App\Services;

use App\Enums\HistoryAction;
use App\Exceptions\GeneralException;
use App\Mappers\LocationHistoryMapper;
use App\Mappers\ManufacturerHistoryMapper;
use App\Models\LocationModel;
use App\Repositories\LocationHistoryRepository;
use Illuminate\Support\Facades\Auth;

class LocationHistoryService
{
    public function __construct(
        protected LocationHistoryRepository $locationHistoryRepository
    )
    {
    }

    /**
     * @throws GeneralException
     */
    public function handleLocationCreated(LocationModel $locationModel): void {
        $historyModel = LocationHistoryMapper::mapModelToHistoryModelByAction(
            location: $locationModel,
            action: HistoryAction::INSERT
        );

        if (!Auth::check()) {
            $historyModel->setAttribute('modified_by', null);
        } else {
            $historyModel->setAttribute('modified_by', Auth::user()->getAuthIdentifier());
        }

        $this->locationHistoryRepository->save($historyModel);
    }

    public function handleLocationUpdated(LocationModel $locationModel): void {
        $historyModel = LocationHistoryMapper::mapModelToHistoryModelByAction(
            location: $locationModel,
            action: HistoryAction::UPDATE
        );

        if (!Auth::check()) {
            $historyModel->setAttribute('modified_by', null);
        } else {
            $historyModel->setAttribute('modified_by', Auth::user()->getAuthIdentifier());
        }

        $this->locationHistoryRepository->save($historyModel);
    }
}
