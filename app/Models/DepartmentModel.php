<?php

namespace App\Models;

use App\Observers\DepartmentModelObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([DepartmentModelObserver::class])]
class DepartmentModel extends Model
{
    use HasFactory;

    const TABLE = "departments";

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'last_modified_by'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'last_modified_by'
    ];
}
