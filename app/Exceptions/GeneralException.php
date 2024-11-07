<?php

namespace App\Exceptions;

use Exception;

class GeneralException extends Exception
{
    public function __construct(string $message = "Something went wrong, please try again later or contact support.")
    {
        parent::__construct($message);
    }
}
