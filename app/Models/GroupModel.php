<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model
{
    const TABLE = 'groups';

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'description',
    ];
}
