<?php

namespace App\Services;

use App\Repositories\LocationHistoryRepository;

class LocationHistoryService
{
    public function __construct(
        protected LocationHistoryRepository $locationHistoryRepository
    )
    {
    }
}
