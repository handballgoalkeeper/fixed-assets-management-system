<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\GroupModel;
use App\Models\GroupXPermissionModel;
use App\Models\PermissionModel;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class GroupRepository implements CrudRepository, PaginatedRepository
{

    /**
     * @inheritDoc
     * @throws GeneralException
     * @throws EntityNotFoundException
     */
    public function findAll(): Collection
    {
        try {
            $groups = GroupModel::all();
        }
        catch (Exception $e) {
            throw new GeneralException();
        }

        if ($groups->isEmpty()) {
            throw new EntityNotFoundException('Groups');
        }

        return $groups;
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

    /**
     * @throws GeneralException
     */
    public function getPermissionsByGroupIdPaginated(int $groupId, int $perPage): LengthAwarePaginator
    {
        try {
            $permissions = DB::table(GroupXPermissionModel::TABLE . ' AS gxp')
                ->join(table: PermissionModel::TABLE . ' AS p', first: 'gxp.permission_id', operator: '=', second: 'p.id')
                ->select([
                    'gxp.id as id',
                    'p.name as name',
                    'p.description as description'
                ])
                ->where(column: 'gxp.group_id', operator: '=', value: $groupId)
            ->paginate($perPage);
        }
        catch(Exception $e) {
            throw new GeneralException();
        }

        return $permissions;
    }
}
