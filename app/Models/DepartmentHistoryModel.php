<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentHistoryModel extends Model
{
    const TABLE = 'department_history';

    protected $table = self::TABLE;

    public $timestamps = false;

    protected $fillable = [
        'department_id',
        'action',
        'name',
        'description',
        'is_active',
        'modified_by'
    ];
}
