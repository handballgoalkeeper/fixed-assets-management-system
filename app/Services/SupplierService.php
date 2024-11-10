<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Misc\Helper;
use App\Models\SupplierModel;
use App\Repositories\SupplierRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class SupplierService
{
    public function __construct(
        protected SupplierRepository $supplierRepository
    )
    {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage = 10): LengthAwarePaginator {
        return $this->supplierRepository->findAllPaginated(perPage: $perPage);
    }

    /**
     * @throws ValueNotUniqueException
     * @throws GeneralException
     */
    public function update(array $requestData, SupplierModel $current): void
    {
        if (!$this->supplierRepository->isValueUnique(model: $current, column: 'name', value: $requestData['name'])) {
            throw new ValueNotUniqueException(entityName: 'Supplier', columnName: 'name');
        }

        if (!Helper::isEqualWithType($current->getAttribute('name'), $requestData['name'])) {
            $current->setAttribute('name', $requestData['name']);
        }

        if (!Helper::isEqualWithType($current->getAttribute('description'), $requestData['description'])) {
            $current->setAttribute('description', $requestData['description']);
        }

        if (!Helper::isEqualWithType($current->getAttribute('PIB'), $requestData['pib'])) {
            $current->setAttribute('PIB', $requestData['pib']);
        }

        if (!Helper::isEqualWithType($current->getAttribute('is_active'), $requestData['isActive'])) {
            $current->setAttribute('is_active', $requestData['isActive']);
        }

        if (!Helper::isEqualWithType($current->getAttribute('contact_person'), $requestData['contactPerson'])) {
            $current->setAttribute('contact_person', $requestData['contactPerson']);
        }

        if ($current->isDirty()) {
            $current->setAttribute('last_modified_by', auth()->id());
        }

        $this->supplierRepository->save($current);
    }
}
