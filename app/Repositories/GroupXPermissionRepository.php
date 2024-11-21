<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\GroupXPermissionModel;
use App\Repositories\CrudRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GroupXPermissionRepository implements CrudRepository
{
    public function findAll(): Collection
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @throws GeneralException
     */
    public function save(GroupXPermissionModel | Model $model): void
    {
        try {
            $model->save();
        }
        catch (Exception) {
            throw new GeneralException();
        }
    }

    public function isPermissionAlreadyGranted(int $groupId, int $permissionId): bool
    {
        $count = DB::table(table: GroupXPermissionModel::TABLE)
            ->where(column: 'group_id',operator: '=', value: $groupId)
            ->where(column: 'permission_id',operator: '=', value: $permissionId)
            ->count();

        return $count > 0;
    }

    /**
     * @throws GeneralException
     */
    public function destroy(GroupXPermissionModel | Model $model): void
    {
        try {
            $model->delete();
        }
        catch (Exception) {
            throw new GeneralException();
        }
    }
}
