<?php

namespace App\Enums;

enum StorageType: string
{
    case UNKNOWN = 'unknown';
    case HDD = 'HDD';
    case SSD = 'SSD';
    case SSHD = 'SSHD';
    case NVMe = 'NVMe SSD';
}
