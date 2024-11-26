<?php

namespace App\Enums;

enum CapacityUnitOfMeasure: string
{
    case UNKNOWN = 'unknown';
    case Byte = 'B';
    case Kilobyte = 'KB';
    case Megabyte = 'MB';
    case Gigabyte = 'GB';
    case Terabyte = 'TB';
    case Petabyte = 'PB';
}
