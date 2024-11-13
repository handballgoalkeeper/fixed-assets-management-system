<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Repositories\LocationsRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class LocationsService
{
    public function __construct(
        protected LocationsRepository $locationsRepository
    )
    {
    }

    /**
     * @throws GeneralException
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage): LengthAwarePaginator
    {
        return $this->locationsRepository->findAllPaginated(perPage: $perPage);
    }
}
