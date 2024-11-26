<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Mappers\EmployeeMapper;
use App\Models\EmployeeModel;
use App\Repositories\EmployeeRepository;
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
}
