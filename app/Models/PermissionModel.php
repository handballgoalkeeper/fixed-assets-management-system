<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{
    const TABLE = "permissions";

    protected $table = 'permissions';

    protected $fillable = [
        'name',
        'description'
    ];
}
