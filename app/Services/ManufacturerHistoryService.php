<?php

namespace App\Services;

use App\Enums\ErrorMessage;
use App\Enums\HistoryAction;
use App\Exceptions\GeneralException;
use App\Mappers\ManufacturerHistoryMapper;
use App\Models\ManufacturerModel;
use App\Repositories\ManufacturerHistoryRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ManufacturerHistoryService
{
    public function __construct(
        protected ManufacturerHistoryRepository $manufacturerHistoryRepository
    )
    {
    }

    /**
     * @throws GeneralException
     */
    public function handleManufacturerCreated(ManufacturerModel $manufacturer): void
    {
        $historyModel = ManufacturerHistoryMapper::mapModelToHistoryModelByAction(
            manufacturer: $manufacturer,
            action: HistoryAction::INSERT
        );

        if (!Auth::check()) {
            $historyModel->setAttribute('modified_by', null);
        } else {
            $historyModel->setAttribute('modified_by', Auth::user()->getAuthIdentifier());
        }

        $this->manufacturerHistoryRepository->save($historyModel);
    }

    /**
     * @throws GeneralException
     */
    public function handleManufacturerUpdated(ManufacturerModel $manufacturer): void
    {

        $historyModel = ManufacturerHistoryMapper::mapModelToHistoryModelByAction(
            manufacturer: $manufacturer,
            action: HistoryAction::UPDATE
        );

        if (!Auth::check()) {
            throw new GeneralException(message: ErrorMessage::USER_NOT_AUTHENTICATED->value);
        }

        $historyModel->setAttribute('modified_by', Auth::user()->getAuthIdentifier());

        $this->manufacturerHistoryRepository->save($historyModel);
    }

    /**
     * @throws GeneralException
     */
    public function findAllPaginated(int $perPage, ManufacturerModel $entity): LengthAwarePaginator
    {
        return $this
            ->manufacturerHistoryRepository
            ->findAllByIdPaginated(perPage: $perPage, entityId: $entity->getAttribute('id'));
    }
}
