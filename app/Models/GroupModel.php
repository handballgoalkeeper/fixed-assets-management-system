<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model
{
    use HasFactory;

    const TABLE = 'groups';

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];
}
