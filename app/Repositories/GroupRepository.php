<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\GroupModel;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class GroupRepository implements CrudRepository, PaginatedRepository
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
    public function save(GroupModel | Model $model): void
    {
        try {
            $model->save();
        }
        catch(Exception) {
            throw new GeneralException();
        }
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage): LengthAwarePaginator
    {
        $groups = DB::table(GroupModel::TABLE)->paginate($perPage);

        if ($groups->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'Groups');
        }

        return $groups;
    }

    public function isValueUnique(string $column, mixed $value, GroupModel|Model $model = null): bool
    {
        if (is_null($model)) {
            $count = DB::table(GroupModel::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->count();
        } else {
            $count = DB::table(GroupModel::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->where(column: 'id', operator: '!=', value: $model->getAttribute('id'))
                ->count();
        }

        return $count === 0;
    }
}
