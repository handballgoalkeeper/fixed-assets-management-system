<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
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
}
