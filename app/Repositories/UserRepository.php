<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\GroupModel;
use App\Models\GroupXPermissionModel;
use App\Models\LocationModel;
use App\Models\PermissionModel;
use App\Models\User;
use App\Models\UserXGroupModel;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class UserRepository implements CrudRepository, PaginatedRepository
{

    public function findAll(): Collection
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @throws GeneralException
     */
    public function save(Model $model): void
    {
        try {
            $model->save();
        }
        catch (Exception $e) {
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
            $users = User::paginate($perPage);
        }
        catch (Exception) {
            throw new GeneralException();
        }

        if ($users->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'User');
        }

        return $users;
    }

    public function isValueUnique(string $column, mixed $value, User|Model $model = null): bool
    {
        if (is_null($model)) {
            $count = DB::table(User::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->count();
        } else {
            $count = DB::table(User::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->where(column: 'id', operator: '!=', value: $model->getAttribute('id'))
                ->count();
        }

        return $count === 0;
    }

    /**
     * @throws GeneralException
     */
    public function getUserPermissionsByUserId(int $userId): \Illuminate\Support\Collection
    {
        try {
            $userPermissions =  DB::table(table: UserXGroupModel::TABLE . ' AS uxg')
                ->select(columns: [
                    'p.name AS name'
                ])
                ->join(table: GroupXPermissionModel::TABLE . ' AS gxp', first: 'uxg.group_id', operator: '=', second: 'gxp.group_id')
                ->join(table: PermissionModel::TABLE . ' AS p', first: 'gxp.permission_id', operator: '=', second: 'p.id')
                ->join(table: GroupModel::TABLE . ' AS g', first: 'gxp.group_id', operator: '=', second: 'g.id')
                ->where(column: 'uxg.user_id', operator: '=', value: auth()->id())
                ->where(column: 'g.is_active', operator: '=', value: true)
                ->groupBy(column: 'p.name')->get();
        }
        catch (Exception) {
            throw new GeneralException();
        }

        return $userPermissions;
    }
}
