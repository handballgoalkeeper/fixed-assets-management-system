<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Mappers\AssetMapper;
use App\Misc\Helper;
use App\Models\AssetModel;
use App\Repositories\AssetsRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AssetService
{
    public function __construct(
        protected AssetsRepository $assetsRepository
    )
    {
    }

    /**
     * @throws GeneralException
     */
    public function create(array $requestData): void
    {
        $assetModel = AssetMapper::requestToModel($requestData);

        DB::transaction(function () use ($assetModel) {
            $assetDetailModel = app(AssetDetailsService::class)->createBlankAssetDetails();
            $assetModel->setAttribute('asset_details_id', $assetDetailModel->id);
            $this->assetsRepository->save($assetModel);
        });
    }

    /**
     * @throws ValueNotUniqueException
     * @throws GeneralException
     */
    public function update(AssetModel $model, array $requestData): void
    {
        if (!is_null( $requestData['serialNumber']) and !$this->assetsRepository
            ->isValueUnique(column: 'serial_number', value: $requestData['serialNumber'], model: $model)
        ) {
            throw new ValueNotUniqueException(entityName: 'Asset', columnName: 'serial number');
        }

        if (!Helper::isEqualWithType($model->getAttribute('asset_type'), $requestData['assetType'])) {
            $model->setAttribute('asset_type', $requestData['assetType']);
        }

        if (!Helper::isEqualWithType($model->getAttribute('manufacturer_id'), $requestData['manufacturerId'])) {
            $model->setAttribute('manufacturer_id', $requestData['manufacturerId']);
        }

        if (!Helper::isEqualWithType($model->getAttribute('asset_model'), $requestData['assetModel'])) {
            $model->setAttribute('asset_model', $requestData['assetModel']);
        }

        if (!Helper::isEqualWithType($model->getAttribute('serial_number'), $requestData['serialNumber'])) {
            $model->setAttribute('serial_number', $requestData['serialNumber']);
        }

        if (!Helper::isEqualWithType($model->getAttribute('description'), $requestData['description'])) {
            $model->setAttribute('description', $requestData['description']);
        }

        if ($model->isDirty()) {
            $model->setAttribute('last_modified_by', auth()->id());
            $this->assetsRepository->save($model);
        }
    }
}
