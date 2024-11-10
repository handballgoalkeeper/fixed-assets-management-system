<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Models\SupplierModel;
use App\Repositories\CrudRepository;
use App\Repositories\PaginatedRepository;
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
     */
    public function save(Model $model): void
    {
        // TODO: Implement save() method.
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
}
