<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Repositories\CrudRepository;
use App\Repositories\PaginatedRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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
     * @throws GeneralException
     */
    public function save(EmployeeModel | Model $model): void
    {
        try {
            $model->save();
        }
        catch (Exception) {
            throw new GeneralException();
        }
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

    public function isValueUnique(string $column, mixed $value, EmployeeModel | Model $model = null): bool
    {
        if (is_null($model)) {
            $count = DB::table(EmployeeModel::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->count();
        } else {
            $count = DB::table(EmployeeModel::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->where(column: 'id', operator: '!=', value: $model->getAttribute('id'))
                ->count();
        }

        return $count === 0;
    }

}
