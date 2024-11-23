<?php

namespace App\Models;

use App\Observers\UserXGroupsModelObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([UserXGroupsModelObserver::class])]
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
