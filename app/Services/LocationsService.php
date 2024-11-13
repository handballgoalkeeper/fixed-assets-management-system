<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Mappers\LocationMapper;
use App\Repositories\LocationsRepository;
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
}
