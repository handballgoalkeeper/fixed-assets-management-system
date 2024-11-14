<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationHistoryModel extends Model
{
    const TABLE = "location_history";

    protected $table = self::TABLE;

    public $timestamps = false;

    protected $fillable = [
        'location_id',
        'action',
        'alias',
        'street_name',
        'street_number',
        'city',
        'is_active',
        'modified_by'
    ];
}
