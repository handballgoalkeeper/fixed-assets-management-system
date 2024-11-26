<?php

namespace App\Mappers;

use App\Models\AssetModel;

class AssetMapper
{
    public static function requestToModel(array $asset): AssetModel
    {
        return new AssetModel([
            'asset_type' => $asset['assetType'],
            'manufacturer_id' => $asset['manufacturerId'],
            'asset_model' => $asset['assetModel'],
            'serial_number' => $asset['serialNumber'],
            'description' => $asset['description']
        ]);
    }
}
