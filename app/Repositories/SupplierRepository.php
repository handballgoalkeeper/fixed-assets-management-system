<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\ManufacturerModel;
use App\Models\SupplierModel;
use App\Repositories\CrudRepository;
use App\Repositories\PaginatedRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class SupplierRepository implements CrudRepository, PaginatedRepository
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
    public function save(SupplierModel|Model $model): void
    {
        try {
            $model->save();
        }
        catch (Exception $e) {
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

    public function isValueUnique(SupplierModel|Model $model, string $column, mixed $value): bool
    {
        $count = DB::table(SupplierModel::TABLE)
            ->where(column: $column, operator: '=', value: $value)
            ->where(column: 'id', operator: '!=', value: $model->getAttribute('id'))
            ->count();

        return $count === 0;
    }
}
