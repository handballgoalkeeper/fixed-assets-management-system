<?php

namespace App\Enums;

enum ErrorMessage: string
{
    case UNHANDLED_EXCEPTION = "Unhandled exception occurred, please contact support.";
    case USER_NOT_AUTHENTICATED = "User not authenticated, please contact support.";
}
