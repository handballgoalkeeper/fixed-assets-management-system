<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
