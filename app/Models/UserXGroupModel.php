<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserXGroupModel extends Model
{
    const TABLE = 'user_x_groups';

    protected $table = self::TABLE;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'group_id',
        'granted_by',
    ];
}
