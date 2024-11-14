<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\LocationHistoryModel;
use App\Repositories\CrudRepository;
use App\Repositories\HistoryRepository;
use App\Repositories\PaginatedRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function findAllByIdPaginated(int $perPage, int $entityId): LengthAwarePaginator
    {
        // TODO: Implement findAllByIdPaginated() method.
    }

    public function findAllPaginated(int $perPage): LengthAwarePaginator
    {
        // TODO: Implement findAllPaginated() method.
    }
}
