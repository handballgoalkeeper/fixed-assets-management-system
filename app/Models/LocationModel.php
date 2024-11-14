<?php

namespace App\Models;

use App\Observers\LocationModelObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([LocationModelObserver::class])]
class LocationModel extends Model
{
    const TABLE = 'locations';

    protected $table = self::TABLE;

    protected $fillable = [
        'alias',
        'street_name',
        'street_number',
        'city',
        'last_modified_by'
    ];

    protected $hidden = [
        'last_modified_by',
        'created_at',
        'updated_at'
    ];
}
