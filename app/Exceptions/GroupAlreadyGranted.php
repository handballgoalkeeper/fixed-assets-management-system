<?php

namespace App\Exceptions;

use Exception;

class GroupAlreadyGranted extends Exception
{
    public function __construct(string $groupName = null)
    {
        if (is_null($groupName)) {
            $message = "Group already granted to user.";
        }
        else {
            $message = "Group '$groupName' already granted to user.";
        }

        parent::__construct(message: $message);
    }
}
