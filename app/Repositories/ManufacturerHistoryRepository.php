<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\ManufacturerHistoryModel;
use App\Models\User;
use App\Repositories\CrudRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class ManufacturerHistoryRepository implements CrudRepository, HistoryRepository
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
    public function save(ManufacturerHistoryModel|Model $model): void
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
     */
    public function findAllByIdPaginated(int $perPage, int $entityId, string $orderBy = 'desc'): LengthAwarePaginator
    {
        $manufacturerHistory = DB::table(ManufacturerHistoryModel::TABLE . ' AS mh')
            ->leftJoin(table: User::TABLE . ' AS u', first: 'mh.modified_by', operator: '=', second: 'u.id')
            ->select([
                'mh.action AS action',
                'mh.name AS name',
                'mh.description AS description',
                'mh.is_active AS is_active',
                'u.name AS modified_by',
                'mh.timestamp AS timestamp'
            ])
            ->where(column: 'manufacturer_id', operator: '=', value: $entityId)
            ->orderBy(column: 'mh.timestamp', direction: $orderBy)
            ->paginate(perPage: $perPage);

        if ($manufacturerHistory->isEmpty()) {
            throw new GeneralException();
        }

        return $manufacturerHistory;
    }
}
