<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\DepartmentModel;
use App\Models\LocationModel;
use App\Repositories\CrudRepository;
use App\Repositories\PaginatedRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class LocationsRepository implements CrudRepository, PaginatedRepository
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
    public function save(LocationModel | Model $model): void
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
            $locations = DB::table(LocationModel::TABLE)->paginate($perPage);
        }
        catch (Exception) {
            throw new GeneralException();
        }

        if ($locations->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'Locations');
        }

        return $locations;
    }

    public function isValueUnique(string $column, mixed $value, LocationModel|Model $model = null): bool
    {
        if (is_null($model)) {
            $count = DB::table(LocationModel::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->count();
        } else {
            $count = DB::table(LocationModel::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->where(column: 'id', operator: '!=', value: $model->getAttribute('id'))
                ->count();
        }

        return $count === 0;
    }

    /**
     * @throws EntityNotFoundException
     * @throws GeneralException
     */
    public function findAllActive(): Collection
    {
        try {
           $locations = LocationModel::where(column: 'is_active', operator: '=', value: true)->get();
        }
        catch (Exception) {
            throw new GeneralException();
        }

        if ($locations->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'Locations');
        }

        return $locations;
    }
}
