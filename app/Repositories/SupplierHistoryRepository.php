<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\ManufacturerHistoryModel;
use App\Models\SupplierHistoryModel;
use App\Models\User;
use App\Repositories\HistoryRepository;
use App\Repositories\PaginatedRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class SupplierHistoryRepository implements CrudRepository, HistoryRepository, PaginatedRepository
{

    /**
     * @inheritDoc
     * @throws GeneralException
     */
    public function findAllByIdPaginated(int $perPage, int $entityId, string $orderBy = 'desc'): LengthAwarePaginator
    {

        $supplierHistory = DB::table(SupplierHistoryModel::TABLE . ' AS sh')
            ->leftJoin(table: User::TABLE . ' AS u', first: 'sh.modified_by', operator: '=', second: 'u.id')
            ->select([
                'sh.action AS action',
                'sh.name AS name',
                'sh.description AS description',
                'sh.PIB AS pib',
                'sh.contact_person AS contact_person',
                'sh.is_active AS is_active',
                'u.name AS modified_by',
                'sh.timestamp AS timestamp'
            ])
            ->where(column: 'sh.supplier_id', operator: '=', value: $entityId)
            ->orderBy(column: 'sh.timestamp', direction: $orderBy)
            ->paginate(perPage: $perPage);

        if ($supplierHistory->isEmpty()) {
            throw new GeneralException();
        }

        return $supplierHistory;
    }

    public function findAllPaginated(int $perPage): LengthAwarePaginator
    {
        // TODO: Implement findAllPaginated() method.
    }

    public function findAll(): Collection
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @throws GeneralException
     */
    public function save(SupplierHistoryModel|Model $model): void
    {
        try {
            $model->save();
        }
        catch (Exception $e) {
            throw new GeneralException();
        }
    }
}
