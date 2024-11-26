<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    const TABLE = 'employees';

    protected $table = self::TABLE;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'is_active',
        'last_modified_by'
    ];

    protected $hidden = [
        'last_modified_by',
        'created_at',
        'updated_at'
    ];
}
