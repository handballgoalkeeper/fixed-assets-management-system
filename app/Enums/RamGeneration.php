<?php

namespace App\Enums;

enum RamGeneration: string
{
    case UNKNOWN = 'unknown';
    case DDR1 = 'DDR1';
    case DDR2 = 'DDR2';
    case DDR3 = 'DDR3';
    case DDR4 = 'DDR4';
    case DDR5 = 'DDR5';
    case LPDDR5 = 'LPDDR5';
}
