<?php

namespace App\Exceptions;

use Exception;

class ValueNotUniqueException extends Exception
{
    public function __construct(string $entityName, string $columnName)
    {
        $message = "{$entityName} with {$columnName} you entered, already exists.";
        parent::__construct($message);
    }
}
