<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\GroupModel;
use App\Models\UserXGroupModel;
use App\Repositories\CrudRepository;
use App\Repositories\PaginatedRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class UserXGroupsRepository implements CrudRepository, PaginatedRepository
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
    public function save(UserXGroupModel | Model $model): void
    {
        try {
            $model->save();
        }
        catch (Exception) {
            throw new GeneralException();
        }
    }

    public function findAllPaginated(int $perPage): LengthAwarePaginator
    {
        // TODO: Implement findAllPaginated() method.
    }

    /**
     * @throws GeneralException
     */
    public function findGroupsByUserIdPaginated(int $perPage, int $userId): LengthAwarePaginator
    {
        try {
            $groups = DB::table(UserXGroupModel::TABLE . " AS uxg")
                ->select([
                    'uxg.id AS id',
                    'g.name AS name',
                    'g.description AS description'
                ])
                ->join(GroupModel::TABLE . " AS g", "g.id", "=", "uxg.group_id")
                ->where("uxg.user_id", "=", $userId)->paginate($perPage);
        }
        catch (Exception) {
            throw new GeneralException();
        }

        return $groups;
    }

    public function isGroupAlreadyGranted(int $userId, int $groupId): bool
    {
        $count = DB::table(UserXGroupModel::TABLE)
            ->where("user_id", "=", $userId)
            ->where("group_id", "=", $groupId)
            ->count();

        return $count > 0;
    }
}
