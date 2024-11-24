<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{
    const TABLE = "permissions";

    protected $table = 'permissions';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description'
    ];
}
