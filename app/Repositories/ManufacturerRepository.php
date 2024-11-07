<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\ManufacturerModel;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class ManufacturerRepository implements CrudRepository
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
}
