<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\DepartmentModel;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class DepartmentRepository implements CrudRepository, PaginatedRepository
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
    public function save(DepartmentModel|Model $model): void
    {
        try {
            $model->save();
        } catch (Exception $e) {
            throw new GeneralException();
        }
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage): LengthAwarePaginator
    {
        $departments = DB::table(DepartmentModel::TABLE)->paginate($perPage);

        if ($departments->isEmpty()) {
            throw new EntityNotFoundException('Department');
        }

        return $departments;
    }

    public function isValueUnique(string $column, mixed $value, DepartmentModel|Model $model = null): bool
    {
        if (is_null($model)) {
            $count = DB::table(DepartmentModel::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->count();
        } else {
            $count = DB::table(DepartmentModel::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->where(column: 'id', operator: '!=', value: $model->getAttribute('id'))
                ->count();
        }

        return $count === 0;
    }
}
