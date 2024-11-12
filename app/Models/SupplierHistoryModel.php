<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierHistoryModel extends Model
{
    const TABLE = "supplier_history";

    protected $table = self::TABLE;

    public $timestamps = false;

    protected $fillable = [
        'supplier_id',
        'action',
        'name',
        'description',
        'PIB',
        'contact_person',
        'is_active',
        'modified_by'
    ];
}
