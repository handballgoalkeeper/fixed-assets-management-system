<?php

namespace App\Models;

use App\Http\Controllers\ManufacturerController;
use App\Observers\ManufacturerModelObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Collection\Collection;

#[ObservedBy([ManufacturerModelObserver::class])]
class ManufacturerModel extends Model
{
    use HasFactory;

    const TABLE = "manufacturers";

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'last_modified_by',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'last_modified_by',
    ];

    protected function supplier(): HasOne
    {
        return $this->hasOne(related: Manufacturer::classlass, foreignKey: 'id', localKey: 'supplier_id');
    }
}
