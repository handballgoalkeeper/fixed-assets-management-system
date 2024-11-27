<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Mappers\LocationMapper;
use App\Misc\Helper;
use App\Models\LocationModel;
use App\Repositories\LocationsRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

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

    /**
     * @throws ValueNotUniqueException|GeneralException
     */
    public function create(array $requestData): void
    {
        $locationModel = LocationMapper::requestToModel(data: $requestData);

        if (!$this->locationsRepository->isValueUnique(column: 'alias', value: $requestData['alias'])) {

            throw new ValueNotUniqueException(entityName: 'Location', columnName: 'alias');
        }
        $locationModel->setAttribute('last_modified_by', auth()->id());
        $this->locationsRepository->save($locationModel);
    }

    /**
     * @throws ValueNotUniqueException
     * @throws GeneralException
     */
    public function update(array $requestData, LocationModel $location): void
    {
        if (!$this->locationsRepository->isValueUnique(column: 'alias', value: $requestData['alias'], model: $location)) {
            throw new ValueNotUniqueException(entityName: 'Location', columnName: 'alias');
        }

        if (!Helper::isEqualWithType($requestData['alias'], $location->getAttribute('alias'))) {
            $location->setAttribute('alias', $requestData['alias']);
        }

        if (!Helper::isEqualWithType($requestData['streetName'], $location->getAttribute('street_name'))) {
            $location->setAttribute('street_name', $requestData['streetName']);
        }

        if (!Helper::isEqualWithType($requestData['streetNumber'], $location->getAttribute('street_number'))) {
            $location->setAttribute('street_number', $requestData['streetNumber']);
        }

        if (!Helper::isEqualWithType($requestData['city'], $location->getAttribute('city'))) {
            $location->setAttribute('city', $requestData['city']);
        }

        if (!Helper::isEqualWithType($requestData['isActive'], $location->getAttribute('is_active'))) {
            $location->setAttribute('is_active', $requestData['isActive']);
        }

        if ($location->isDirty()) {
            $location->setAttribute('last_modified_by', auth()->id());
        }

        $this->locationsRepository->save($location);
    }

    /**
     * @throws GeneralException
     * @throws EntityNotFoundException
     */
    public function findAllActive(): Collection
    {
        return $this->locationsRepository->findAllActive();
    }
}
