<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManufacturerHistoryModel extends Model
{
    const TABLE = 'manufacturer_history';

    protected $table = self::TABLE;

    protected $fillable = [
        'manufacturer_id',
        'action',
        'name',
        'description',
        'is_active',
        'modified_by'
    ];
}
