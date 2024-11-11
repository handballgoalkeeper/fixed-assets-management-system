<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Mappers\ManufacturerMapper;
use App\Models\ManufacturerModel;
use App\Repositories\ManufacturerRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ManufacturerService
{
    public function __construct(
        protected ManufacturerRepository $manufacturerRepository
    ) {}

    /**
     * Get all manufacturers from the repository.
     *
     * @throws EntityNotFoundException if no manufacturers are found (optional)
     */
    public function getAllManufacturersPaginated(int $perPage): LengthAwarePaginator
    {
        return $this->manufacturerRepository->findAllPaginated(perPage: $perPage);
    }

    /**
     * @throws GeneralException
     * @throws ValueNotUniqueException
     */
    public function update(array $requestData, ManufacturerModel $currentData): void
    {
        if (!$this->manufacturerRepository
            ->isValueUnique(column: 'name', value: $requestData['name'], model: $currentData)
        ) {
            throw new ValueNotUniqueException(entityName: 'Manufacturer', columnName: 'name');
        }

        if ($currentData->getAttribute('name') !== $requestData['name']) {
            $currentData->setAttribute('name', $requestData['name']);
        }

        if ($currentData->getAttribute('description') !== $requestData['description']) {
            $currentData->setAttribute('description', $requestData['description']);
        }

        if ($currentData->getAttribute('is_active') !== $requestData['isActive']) {
            $currentData->setAttribute('is_active', $requestData['isActive']);
        }

        if ($currentData->isDirty()) {
            $currentData->setAttribute('last_modified_by', auth()->id());
        }

        $this->manufacturerRepository->save($currentData);
    }

    /**
     * @throws ValueNotUniqueException
     * @throws GeneralException
     */
    public function create(array $requestData): void
    {
        if (!$this->manufacturerRepository->isValueUnique(column: 'name', value: $requestData['name'])) {
            throw new ValueNotUniqueException(entityName: 'Manufacturer', columnName: 'name');
        }

        $model = ManufacturerMapper::requestToModel($requestData);
        $model->setAttribute('last_modified_by', auth()->id());

        $this->manufacturerRepository->save($model);
    }
}
