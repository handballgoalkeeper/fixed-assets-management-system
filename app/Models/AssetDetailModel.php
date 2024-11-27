<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AssetDetailModel extends Model
{
    const TABLE = 'asset_details';

    protected $table = self::TABLE;

    protected $fillable = [
        'fixed_asset_number',
        'it_number',
        'supplier_id',
        'storage_type',
        'storage_capacity',
        'storage_capacity_units_of_measure',
        'ram_generation',
        'ram_capacity',
        'ram_capacity_units_of_measure',
        'is_active',
        'activated_at',
        'is_expensed',
        'expensed_at',
        'is_assigned',
        'assigned_at',
        'assigned_to',
        'location_id',
        'last_modified_by',
    ];

    protected $hidden = [
        'last_modified_by',
        'created_at',
        'updated_at'
    ];

    protected function supplier(): HasOne
    {
        return $this->hasOne(related: SupplierModel::class, foreignKey: 'id', localKey: 'supplier_id');
    }

    protected function employee(): HasOne
    {
        return $this->hasOne(related: EmployeeModel::class, foreignKey: 'id', localKey: 'assigned_to');
    }
}
