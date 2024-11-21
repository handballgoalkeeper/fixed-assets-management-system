<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\PermissionModel;
use App\Repositories\CrudRepository;
use App\Repositories\PaginatedRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PermissionRepository implements CrudRepository, PaginatedRepository
{

    /**
     * @inheritDoc
     * @throws EntityNotFoundException
     */
    public function findAll(): Collection
    {
        $permissions = PermissionModel::all();

        if ($permissions->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'Permission');
        }

        return $permissions;
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
