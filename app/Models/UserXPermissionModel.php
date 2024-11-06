<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserXPermissionModel extends Model
{
    protected $table = 'users_x_permissions';

    protected $fillable = [
        'user_id',
        'permission_id',
        'permission_granted_by'
    ];

    protected function user(): HasOne
    {
        return $this->hasOne(related: User::class, foreignKey: 'id', localKey: 'user_id');
    }

    protected function permission(): HasOne
    {
        return $this->hasOne(related: PermissionModel::class, foreignKey: 'id', localKey: 'permission_id');
    }

    protected function permissionGrantedBy(): HasOne
    {
        return $this->hasOne(related: User::class, foreignKey: 'id', localKey: 'permission_granted_by');
    }

}
