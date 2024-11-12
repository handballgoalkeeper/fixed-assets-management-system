<?php

namespace App\Services;

use App\Enums\ErrorMessage;
use App\Enums\HistoryAction;
use App\Exceptions\GeneralException;
use App\Mappers\DepartmentHistoryMapper;
use App\Mappers\ManufacturerHistoryMapper;
use App\Models\DepartmentModel;
use App\Models\ManufacturerModel;
use App\Repositories\DepartmentHistoryRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class DepartmentHistoryService
{
    public function __construct(
        protected DepartmentHistoryRepository $departmentHistoryRepository,
    )
    {
    }

    /**
     * @throws GeneralException
     */
    public function handleDepartmentCreated(DepartmentModel $department): void
    {
        $historyModel = DepartmentHistoryMapper::mapModelToHistoryModelByAction(
            department: $department,
            action: HistoryAction::INSERT
        );

        if (!Auth::check()) {
            $historyModel->setAttribute('modified_by', null);
        } else {
            $historyModel->setAttribute('modified_by', Auth::user()->getAuthIdentifier());
        }

        $this->departmentHistoryRepository->save($historyModel);
    }

    /**
     * @throws GeneralException
     */
    public function handleManufacturerUpdated(DepartmentModel $department): void
    {

        $historyModel = DepartmentHistoryMapper::mapModelToHistoryModelByAction(
            department: $department,
            action: HistoryAction::UPDATE
        );

        if (!Auth::check()) {
            throw new GeneralException(message: ErrorMessage::USER_NOT_AUTHENTICATED->value);
        }

        $historyModel->setAttribute('modified_by', Auth::user()->getAuthIdentifier());

        $this->departmentHistoryRepository->save($historyModel);
    }

    /**
     * @throws GeneralException
     */
    public function findAllPaginated(int $perPage, DepartmentModel $entity): LengthAwarePaginator
    {
        return $this
            ->departmentHistoryRepository
            ->findAllByIdPaginated(perPage: $perPage, entityId: $entity->getAttribute('id'));
    }
}
