<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AssetModel extends Model
{
    const TABLE = 'assets';

    protected $table = self::TABLE;

    protected $fillable = [
        'asset_type',
        'manufacturer_id',
        'asset_model',
        'serial_number',
        'description',
        'asset_details_id',
        'last_modified_by',
    ];

    protected $hidden = [
        'last_modified_by',
        'created_at',
        'updated_at',
    ];

    protected function assetDetails(): HasOne
    {
        return $this->hasOne(related: AssetDetailModel::class , foreignKey: 'id' , localKey: 'asset_details_id');
    }

    protected function manufacturer(): HasOne
    {
        return $this->hasOne(related: ManufacturerModel::class , foreignKey: 'id' , localKey: 'manufacturer_id');
    }
}
