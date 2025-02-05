<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\AssetModel;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class AssetsRepository implements CrudRepository, PaginatedRepository
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
    public function save(AssetModel | Model $model): void
    {
        try {
            $model->save();
        }
        catch (Exception) {
            throw new GeneralException();
        }
    }

    public function findAllPaginated(int $perPage): LengthAwarePaginator
    {
        // TODO: Implement findAllPaginated() method.
    }

    public function isValueUnique(string $column, mixed $value, AssetModel|Model $model = null): bool
    {
        if (is_null($model)) {
            $count = DB::table(AssetModel::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->count();
        } else {
            $count = DB::table(AssetModel::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->where(column: 'id', operator: '!=', value: $model->getAttribute('id'))
                ->count();
        }

        return $count === 0;
    }

    /**
     * @throws GeneralException
     */
    public function getNoOfAssetsPerAssetType(): \Illuminate\Support\Collection
    {
        try {
            $data = DB::table(AssetModel::TABLE . " AS a")
                ->select([
                    'a.asset_type AS asset_type',
                    DB::raw("COUNT(*) AS count")
                ])->groupBy('a.asset_type')->get();
        }
        catch (Exception) {
            throw new GeneralException();
        }

        return $data;

    }
}
