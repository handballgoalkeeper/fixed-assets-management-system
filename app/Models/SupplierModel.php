<?php

namespace App\Models;

use App\Observers\SupplierModelObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([SupplierModelObserver::class])]
class SupplierModel extends Model
{
    use HasFactory;

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
