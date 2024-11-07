<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Models\ManufacturerModel;
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
}
