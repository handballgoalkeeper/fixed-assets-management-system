<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\EmployeeModel;
use App\Repositories\CrudRepository;
use App\Repositories\PaginatedRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeRepository implements CrudRepository, PaginatedRepository
{

    /**
     * @inheritDoc
     */
    public function findAll(): Collection
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @inheritDoc
     */
    public function save(Model $model): void
    {
        // TODO: Implement save() method.
    }

    /**
     * @throws GeneralException
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage): LengthAwarePaginator
    {
        try {
            $employees = EmployeeModel::paginate($perPage);
        }
        catch (Exception)
        {
            throw new GeneralException();
        }

        if ($employees->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'Employees');
        }

        return $employees;
    }
}
