<?php

namespace App\Models;

use App\Observers\GroupXPermissionModelObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([GroupXPermissionModelObserver::class])]
class GroupXPermissionModel extends Model
{
    const TABLE = "group_x_permissions";

    protected $table = self::TABLE;

    public $timestamps = false;

    protected $fillable = [
        'group_id',
        'permission_id',
        'granted_by',
    ];
}
