<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\ManufacturerModel;
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

    /**
     * @throws GeneralException
     */
    public function update(array $requestData, ManufacturerModel $currentData): void
    {
        if ($currentData->getAttribute('name') !== $requestData['name']) {
            $currentData->setAttribute('name', $requestData['name']);
        }

        if ($currentData->getAttribute('description') !== $requestData['description']) {
            $currentData->setAttribute('description', $requestData['description']);
        }

        $this->manufacturerRepository->save($currentData);
    }
}
