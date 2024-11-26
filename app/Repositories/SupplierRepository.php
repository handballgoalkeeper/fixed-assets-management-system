<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\SupplierModel;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class SupplierRepository implements CrudRepository, PaginatedRepository
{

    /**
     * @inheritDoc
     * @throws GeneralException
     */
    public function findAll(): Collection
    {
        try {
            $suppliers = SupplierModel::all();
        }
        catch (Exception) {
            throw new GeneralException();
        }

        return $suppliers;
    }

    /**
     * @inheritDoc
     * @throws GeneralException
     */
    public function save(SupplierModel|Model $model): void
    {
        try {
            $model->save();
        } catch (Exception) {
            throw new GeneralException();
        }
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage): LengthAwarePaginator
    {
        $suppliers = DB::table(SupplierModel::TABLE)->paginate($perPage);

        if ($suppliers->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'supplier');
        }

        return $suppliers;
    }

    public function isValueUnique(string $column, mixed $value, SupplierModel|Model $model = null): bool
    {
        if (is_null($model)) {
            $count = DB::table(SupplierModel::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->count();
        } else {
            $count = DB::table(SupplierModel::TABLE)
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
            $suppliers = SupplierModel::all()->where('is_active', true);
        }
        catch (Exception) {
            throw new GeneralException();
        }

        if ($suppliers->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'Supplier');
        }

        return $suppliers;
    }
}
