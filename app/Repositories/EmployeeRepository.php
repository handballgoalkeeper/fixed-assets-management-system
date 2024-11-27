<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\AssetDetailModel;
use App\Models\AssetModel;
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

    /**
     * @throws GeneralException
     * @throws EntityNotFoundException
     */
    public function findAllActive(): Collection
    {
        try {
            $employees = EmployeeModel::where('is_active', '=', true)->get();
        }
        catch (Exception $e) {
            throw new GeneralException();
        }

        if ($employees->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'Employees');
        }

        return $employees;
    }

    /**
     * @throws GeneralException
     */
    public function findAllAssetsPaginatedByEmployeeId(int $perPage, int $employeeId): LengthAwarePaginator
    {
        try {
            $assets = AssetModel::join(AssetDetailModel::TABLE . ' AS ad', 'ad.id', '=', 'assets.id')
                ->where('assigned_to', '=', $employeeId)->paginate($perPage);
        }
        catch (Exception $e) {
            throw new GeneralException();
        }

        return $assets;
    }
}
