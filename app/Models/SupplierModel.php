<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    const TABLE = 'suppliers';

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'description',
        'PIB',
        'contact_person',
        'is_active'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'last_modified_by'
    ];
}
