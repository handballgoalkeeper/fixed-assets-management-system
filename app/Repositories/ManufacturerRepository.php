<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\ManufacturerModel;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ManufacturerRepository implements CrudRepository, PaginatedRepository
{

    /**
     * @inheritDoc
     * @throws EntityNotFoundException
     */
    public function findAll(): Collection
    {
        $manufacturers = ManufacturerModel::all();

        if ($manufacturers->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'Manufacturer');
        }

        return $manufacturers;
    }

    /**
     * @throws GeneralException
     */
    public function save(ManufacturerModel|Model $model): void
    {
        try {
            $model->save();
        } catch (Exception $e) {
            throw new GeneralException();
        }
    }

    /**
     * @inheritdoc
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage): LengthAwarePaginator
    {
        $manufacturers = DB::table(ManufacturerModel::TABLE)->paginate(perPage: $perPage);

        if ($manufacturers->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'Manufacturers');
        }

        return $manufacturers;
    }

    public function isValueUnique(string $column, mixed $value, ManufacturerModel|Model $model = null): bool
    {
        if (is_null($model)) {
            $count = DB::table(ManufacturerModel::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->count();
        } else {
            $count = DB::table(ManufacturerModel::TABLE)
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
            $manufacturers = ManufacturerModel::all()->where('is_active', true);
        }
        catch (Exception) {
            throw new GeneralException();
        }

        if ($manufacturers->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'Manufacturer');
        }

        return $manufacturers;
    }
}
