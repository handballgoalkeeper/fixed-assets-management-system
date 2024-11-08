<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturerModel extends Model
{
    use HasFactory;
    const TABLE = "manufacturers";

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'description',
        'last_modified_by',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'last_modified_by',
    ];
}
