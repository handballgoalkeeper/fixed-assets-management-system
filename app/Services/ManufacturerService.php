<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Repositories\ManufacturerRepository;
use Illuminate\Database\Eloquent\Collection;

class ManufacturerService
{
    public function __construct(
        protected ManufacturerRepository $manufacturerRepository
    ) {}

    /**
     * Get all manufacturers from the repository.
     *
     * @throws EntityNotFoundException if no manufacturers are found (optional)
     */
    public function getAllManufacturers(): Collection
    {
        return $this->manufacturerRepository->findAll();
    }
}
