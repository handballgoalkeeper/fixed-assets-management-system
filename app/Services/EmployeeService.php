<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Mappers\EmployeeMapper;
use App\Misc\Helper;
use App\Models\EmployeeModel;
use App\Repositories\EmployeeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeService
{
    public function __construct(
        protected EmployeeRepository $employeeRepository
    )
    {
    }

    /**
     * @throws GeneralException
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return $this->employeeRepository->findAllPaginated($perPage);
    }

    public function create(array $requestData): void
    {
        $newEmployee = EmployeeMapper::requestDataToModel(requestData: $requestData);

        $this->employeeRepository->save($newEmployee);
    }

    /**
     * @throws ValueNotUniqueException
     * @throws GeneralException
     */
    public function update(EmployeeModel $current, array $requestData): void
    {
        if (!$this->employeeRepository->isValueUnique(column: 'email', value: $requestData['email'], model: $current)) {
            throw new ValueNotUniqueException(entityName: 'Employee', columnName: 'email');
        }

        if (!Helper::isEqualWithType($current->getAttribute('first_name'), $requestData['firstName'])) {
            $current->setAttribute('first_name', $requestData['firstName']);
        }

        if (!Helper::isEqualWithType($current->getAttribute('last_name'), $requestData['lastName'])) {
            $current->setAttribute('last_name', $requestData['lastName']);
        }

        if (!Helper::isEqualWithType($current->getAttribute('email'), $requestData['email'])) {
            $current->setAttribute('email', $requestData['email']);
        }

        if (!Helper::isEqualWithType($current->getAttribute('is_active'), $requestData['isActive'])) {
            $current->setAttribute('is_active', $requestData['isActive']);
        }

        if ($current->isDirty()) {
            $current->setAttribute('last_modified_by', auth()->id());
        }

        $this->employeeRepository->save($current);

    }

    /**
     * @throws GeneralException
     * @throws EntityNotFoundException
     */
    public function findAllActive(): Collection
    {
        return $this->employeeRepository->findAllActive();
    }
}
