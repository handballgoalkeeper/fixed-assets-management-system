<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\LocationHistoryModel;
use App\Models\ManufacturerHistoryModel;
use App\Models\User;
use App\Repositories\CrudRepository;
use App\Repositories\HistoryRepository;
use App\Repositories\PaginatedRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class LocationHistoryRepository implements CrudRepository, PaginatedRepository, HistoryRepository
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
    public function save(LocationHistoryModel | Model $model): void
    {
        try {
            $model->save();
        }
        catch(Exception) {
            throw new GeneralException();
        }
    }

    /**
     * @throws GeneralException
     */
    public function findAllByIdPaginated(int $perPage, int $entityId, string $orderBy = 'desc'): LengthAwarePaginator
    {
        $locationHistory = DB::table(LocationHistoryModel::TABLE . ' AS lh')
            ->leftJoin(table: User::TABLE . ' AS u', first: 'lh.modified_by', operator: '=', second: 'u.id')
            ->select([
                'lh.action AS action',
                'lh.alias AS alias',
                'lh.street_name AS street_name',
                'lh.street_number AS street_number',
                'lh.city AS city',
                'lh.is_active AS is_active',
                'u.name AS modified_by',
                'lh.timestamp AS timestamp'
            ])
            ->where(column: 'lh.location_id', operator: '=', value: $entityId)
            ->orderBy(column: 'lh.timestamp', direction: $orderBy)
            ->paginate(perPage: $perPage);

        if ($locationHistory->isEmpty()) {
            throw new GeneralException();
        }

        return $locationHistory;
    }

    public function findAllPaginated(int $perPage): LengthAwarePaginator
    {
        // TODO: Implement findAllPaginated() method.
    }
}
