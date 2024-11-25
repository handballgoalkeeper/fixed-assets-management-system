<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
