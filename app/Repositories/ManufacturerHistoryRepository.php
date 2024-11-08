<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\ManufacturerHistoryModel;
use App\Repositories\CrudRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ManufacturerHistoryRepository implements CrudRepository
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
}
