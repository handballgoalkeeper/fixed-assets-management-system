<?php

namespace App\Services;

use App\Enums\ErrorMessage;
use App\Enums\HistoryAction;
use App\Exceptions\GeneralException;
use App\Mappers\ManufacturerHistoryMapper;
use App\Mappers\SupplierHistoryMapper;
use App\Models\ManufacturerModel;
use App\Models\SupplierModel;
use App\Repositories\SupplierHistoryRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class SupplierHistoryService
{
    public function __construct(
        protected SupplierHistoryRepository $supplierHistoryRepository
    )
    {

    }

    /**
     * @throws GeneralException
     */
    public function handleSupplierCreated(SupplierModel $supplier): void
    {
        $historyModel = SupplierHistoryMapper::mapModelToHistoryModelByAction(
            supplier: $supplier,
            action: HistoryAction::INSERT
        );

        if (!Auth::check()) {
            $historyModel->setAttribute('modified_by', null);
        } else {
            $historyModel->setAttribute('modified_by', Auth::user()->getAuthIdentifier());
        }

        $this->supplierHistoryRepository->save($historyModel);
    }

    /**
     * @throws GeneralException
     */
    public function handleSupplierUpdated(SupplierModel $supplier): void
    {
        $historyModel = SupplierHistoryMapper::mapModelToHistoryModelByAction(
            supplier: $supplier,
            action: HistoryAction::UPDATE
        );

        if (!Auth::check()) {
            throw new GeneralException(message: ErrorMessage::USER_NOT_AUTHENTICATED->value);
        }

        $historyModel->setAttribute('modified_by', Auth::user()->getAuthIdentifier());

        $this->supplierHistoryRepository->save($historyModel);
    }

    /**
     * @throws GeneralException
     */
    public function findAllPaginated(int $perPage, SupplierModel $entity): LengthAwarePaginator
    {
        return $this
            ->supplierHistoryRepository
            ->findAllByIdPaginated(perPage: $perPage, entityId: $entity->getAttribute('id'));
    }
}
