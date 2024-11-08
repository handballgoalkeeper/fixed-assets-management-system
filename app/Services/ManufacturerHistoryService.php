<?php

namespace App\Services;

use App\Enums\ManufacturerHistoryAction;
use App\Exceptions\GeneralException;
use App\Models\ManufacturerHistoryModel;
use App\Models\ManufacturerModel;
use App\Repositories\ManufacturerHistoryRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class ManufacturerHistoryService
{
    public function __construct(
        protected ManufacturerHistoryRepository $manufacturerHistoryRepository
    ) {}

    /**
     * @throws GeneralException
     */
    public function handleManufacturerCreated(ManufacturerModel $manufacturer): void
    {
        $historyModel = new ManufacturerHistoryModel();
        $historyModel->setAttribute('manufacturer_id', $manufacturer->getAttribute('id'));
        $historyModel->setAttribute('action', ManufacturerHistoryAction::INSERT->value);
        $historyModel->setAttribute('name', $manufacturer->getAttribute('name'));
        $historyModel->setAttribute('description', $manufacturer->getAttribute('description'));
        $historyModel->setAttribute('is_active', true);
        $historyModel->setAttribute('modified_by', null);

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
