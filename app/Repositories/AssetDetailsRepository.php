<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\AssetDetailModel;
use App\Models\AssetModel;
use App\Repositories\CrudRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssetDetailsRepository implements CrudRepository
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
    public function save(AssetDetailModel | Model $model): void
    {
        try {
            $model->save();
        }
        catch (Exception $e) {
            dd($e);
            throw new GeneralException();
        }
    }

    public function isValueUnique(string $column, mixed $value, AssetDetailModel | Model $model = null): bool
    {
        if (is_null($model)) {
            $count = DB::table(AssetDetailModel::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->count();
        } else {
            $count = DB::table(AssetDetailModel::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->where(column: 'id', operator: '!=', value: $model->getAttribute('id'))
                ->count();
        }

        return $count === 0;
    }
}
