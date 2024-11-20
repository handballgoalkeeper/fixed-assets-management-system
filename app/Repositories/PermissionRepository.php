<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Models\PermissionModel;
use App\Repositories\CrudRepository;
use App\Repositories\PaginatedRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PermissionRepository implements CrudRepository, PaginatedRepository
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
        $permissions = DB::table(PermissionModel::TABLE)->paginate($perPage);

        if ($permissions->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'Permission');
        }

        return $permissions;
    }
}
