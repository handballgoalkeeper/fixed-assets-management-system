<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\LocationModel;
use App\Repositories\CrudRepository;
use App\Repositories\PaginatedRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class LocationsRepository implements CrudRepository, PaginatedRepository
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
     */
    public function save(Model $model): void
    {
        // TODO: Implement save() method.
    }

    /**
     * @throws GeneralException
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage): LengthAwarePaginator
    {
        try {
            $locations = DB::table(LocationModel::TABLE)->paginate($perPage);
        }
        catch (Exception) {
            throw new GeneralException();
        }

        if ($locations->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'Locations');
        }

        return $locations;
    }
}
