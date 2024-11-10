<?php

namespace App\Misc;

class Helper
{
    public static function isEqualWithType(mixed $value1, mixed $value2): bool
    {
        return $value1 === $value2;
    }
}
