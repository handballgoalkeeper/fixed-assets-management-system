<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Mappers\DepartmentMapper;
use App\Misc\Helper;
use App\Models\DepartmentModel;
use App\Repositories\DepartmentRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class DepartmentService
{
    public function __construct(
        protected DepartmentRepository $departmentRepository
    )
    {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return $this->departmentRepository->findAllPaginated($perPage);
    }

    /**
     * @throws ValueNotUniqueException
     * @throws GeneralException
     */
    public function create(array $requestData): void
    {
        if (!$this->departmentRepository->isValueUnique(column: 'name', value: $requestData['name'])) {
            throw new ValueNotUniqueException(entityName: 'Department', columnName: 'name');
        }

        $model = DepartmentMapper::requestToModel($requestData);
        $model->setAttribute('last_modified_by', auth()->id());

        $this->departmentRepository->save($model);
    }

    /**
     * @throws ValueNotUniqueException
     * @throws GeneralException
     */
    public function update(array $requestData, DepartmentModel $current): void
    {
        if (!$this->departmentRepository->isValueUnique(column: 'name', value: $requestData['name'], model: $current)) {
            throw new ValueNotUniqueException(entityName: 'Department', columnName: 'name');
        }

        if (!Helper::isEqualWithType($requestData['name'], $current->getAttribute('name'))) {
            $current->setAttribute('name', $requestData['name']);
        }

        if (!Helper::isEqualWithType($requestData['description'], $current->getAttribute('description'))) {
            $current->setAttribute('description', $requestData['description']);
        }

        if (!Helper::isEqualWithType($requestData['isActive'], $current->getAttribute('is_active'))) {
            $current->setAttribute('is_active', $requestData['isActive']);
        }

        if($current->isDirty()) {
            $current->setAttribute('last_modified_by', auth()->id());
        }

        $this->departmentRepository->save($current);
    }
}
