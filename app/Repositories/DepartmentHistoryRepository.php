<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\DepartmentHistoryModel;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class DepartmentHistoryRepository implements CrudRepository, HistoryRepository
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
    public function save(DepartmentHistoryModel|Model $model): void
    {
        try {
            $model->save();
        }
        catch (Exception)
        {
            throw new GeneralException();
        }
    }

    /**
     * @throws GeneralException
     */
    public function findAllByIdPaginated(int $perPage, int $entityId, string $orderBy = 'desc'): LengthAwarePaginator
    {
        $departmentHistory = DB::table(DepartmentHistoryModel::TABLE . ' AS dh')
            ->leftJoin(table: User::TABLE . ' AS u', first: 'dh.modified_by', operator: '=', second: 'u.id')
            ->select([
                'dh.action AS action',
                'dh.name AS name',
                'dh.description AS description',
                'dh.is_active AS is_active',
                'u.name AS modified_by',
                'dh.timestamp AS timestamp'
            ])
            ->where(column: 'dh.department_id', operator: '=', value: $entityId)
            ->orderBy(column: 'dh.timestamp', direction: $orderBy)
            ->paginate(perPage: $perPage);

        if ($departmentHistory->isEmpty()) {
            throw new GeneralException();
        }

        return $departmentHistory;
    }
}
