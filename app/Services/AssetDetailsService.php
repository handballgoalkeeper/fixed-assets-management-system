<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Misc\Helper;
use App\Models\AssetDetailModel;
use App\Repositories\AssetDetailsRepository;

class AssetDetailsService
{
    public function __construct(
        protected AssetDetailsRepository $assetDetailsRepository
    )
    {
    }

    /**
     * @throws GeneralException
     */
    public function createBlankAssetDetails(): AssetDetailModel
    {
        $assetDetail = new AssetDetailModel();
        $this->assetDetailsRepository->save($assetDetail);
        return $assetDetail;
    }

    /**
     * @throws ValueNotUniqueException
     * @throws GeneralException
     */
    public function update(AssetDetailModel $model, array $requestData): void
    {
//        "fixedAssetNumber" => "2-OS1233"
//        "itNumber" => "IT132"
//        "supplierId" => "10"
//        "storageType" => "HDD"
//        "storageCapacity" => "256"
//        "storageCapacityUnitsOfMeasure" => "GB"
//        "ramGeneration" => "DDR5"
//        "ramCapacity" => "16"
//        "ramCapacityUnitsOfMeasure" => "GB"
        if (!$this->assetDetailsRepository
            ->isValueUnique(column: 'fixed_asset_number', value: $requestData['fixedAssetNumber'], model: $model)
        ) {
            throw new ValueNotUniqueException(entityName: 'Asset', columnName: 'fixed asset number');
        }

        if (!$this->assetDetailsRepository
            ->isValueUnique(column: 'it_number', value: $requestData['itNumber'], model: $model)
        ) {
            throw new ValueNotUniqueException(entityName: 'Asset', columnName: 'it number');
        }

        if (!Helper::isEqualWithType($model->getAttribute('fixed_asset_number'), $requestData['fixedAssetNumber'])) {
            $model->setAttribute('fixed_asset_number', $requestData['fixedAssetNumber']);
        }

        if (!Helper::isEqualWithType($model->getAttribute('it_number'), $requestData['itNumber'])) {
            $model->setAttribute('it_number', $requestData['itNumber']);
        }

        if (!Helper::isEqualWithType($model->getAttribute('supplier_id'), $requestData['supplierId'])) {
            $model->setAttribute('supplier_id', $requestData['supplierId']);
        }

        if (!Helper::isEqualWithType($model->getAttribute('storage_type'), $requestData['storageType'])) {
            $model->setAttribute('storage_type', $requestData['storageType']);
        }

        if (!Helper::isEqualWithType($model->getAttribute('storage_capacity'), $requestData['storageCapacity'])) {
            $model->setAttribute('storage_capacity', $requestData['storageCapacity']);
        }

        if (!Helper::isEqualWithType($model->getAttribute('storage_capacity_units_of_measure'), $requestData['storageCapacityUnitsOfMeasure'])
        ) {
            $model->setAttribute('storage_capacity_units_of_measure', $requestData['storageCapacityUnitsOfMeasure']);
        }

        if (!Helper::isEqualWithType($model->getAttribute('ram_generation'), $requestData['ramGeneration'])) {
            $model->setAttribute('ram_generation', $requestData['ramGeneration']);
        }

        if (!Helper::isEqualWithType($model->getAttribute('ram_capacity'), $requestData['ramCapacity'])) {
            $model->setAttribute('ram_capacity', $requestData['ramCapacity']);
        }

        if (!Helper::isEqualWithType($model->getAttribute('ram_capacity_units_of_measure'), $requestData['ramCapacityUnitsOfMeasure'])
        ) {
            $model->setAttribute('ram_capacity_units_of_measure', $requestData['ramCapacityUnitsOfMeasure']);
        }

        if ($model->isDirty()) {
            $model->setAttribute('last_modified_by', auth()->id());
            $this->assetDetailsRepository->save($model);
        }
    }
}
