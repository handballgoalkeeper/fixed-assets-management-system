<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\ManufacturerModel;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\Eloquent\Collection;

class ManufacturerRepository implements CrudRepository, PaginatedRepository
{

    /**
     * @inheritDoc
     * @throws EntityNotFoundException
     */
    public function findAll(): Collection
    {
        $manufacturers = ManufacturerModel::all();

        if ($manufacturers->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'Department');
        }

        return $manufacturers;
    }

    /**
     * @throws GeneralException
     */
    public function save(ManufacturerModel|Model $model): void
    {
        try {
            $model->save();
        }
        catch (Exception $e) {
            throw new GeneralException();
        }
    }

    /**
     * @inheritdoc
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage): LengthAwarePaginator
    {
        $manufacturers = DB::table(ManufacturerModel::TABLE)->paginate(perPage: $perPage);

        if ($manufacturers->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'Department');
        }

        return $manufacturers;
    }
}
