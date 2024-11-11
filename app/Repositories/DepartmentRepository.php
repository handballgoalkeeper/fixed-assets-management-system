<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Models\DepartmentModel;
use App\Repositories\CrudRepository;
use App\Repositories\PaginatedRepository;
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
        $departments = DB::table(DepartmentModel::TABLE)->paginate($perPage);

        if ($departments->isEmpty()) {
            throw new EntityNotFoundException('Department');
        }

        return $departments;
    }
}
