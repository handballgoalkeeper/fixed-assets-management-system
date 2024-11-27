<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Misc\Helper;
use App\Models\AssetDetailModel;
use App\Repositories\AssetDetailsRepository;
use Carbon\Carbon;

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
        if (!is_null($requestData['fixedAssetNumber']) && !$this->assetDetailsRepository
            ->isValueUnique(column: 'fixed_asset_number', value: $requestData['fixedAssetNumber'], model: $model)
        ) {
            throw new ValueNotUniqueException(entityName: 'Asset', columnName: 'fixed asset number');
        }

        if (!is_null($requestData['itNumber']) &&!$this->assetDetailsRepository
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

        if (!Helper::isEqualWithType($model->getAttribute('assigned_to'), $requestData['employeeId'])) {
            $model->setAttribute('assigned_to', $requestData['employeeId']);
            if (is_null($requestData['employeeId'])) {
                $model->setAttribute('is_assigned', false);
                $model->setAttribute('assigned_at', null);
            } else {
                $model->setAttribute('is_assigned', true);
                $model->setAttribute('assigned_at', Carbon::now());
            }
        }

        if ($model->isDirty()) {
            $model->setAttribute('last_modified_by', auth()->id());
            $this->assetDetailsRepository->save($model);
        }
    }
}
