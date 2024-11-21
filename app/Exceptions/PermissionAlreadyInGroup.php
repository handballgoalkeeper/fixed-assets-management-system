<?php

namespace App\Exceptions;

use Exception;

class PermissionAlreadyInGroup extends Exception
{
    public function __construct(string $permissionName = null)
    {
        if (is_null($permissionName)) {
            $message = "Permission already exists in the group";
        }
        else {
            $message = "Permission '$permissionName' already exists in the group.";
        }

        parent::__construct(message: $message);
    }
}
