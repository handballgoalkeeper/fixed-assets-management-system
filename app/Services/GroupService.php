<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Mappers\GroupMapper;
use App\Misc\Helper;
use App\Models\GroupModel;
use App\Repositories\GroupRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\Help;

class GroupService
{
    public function __construct(
        protected GroupRepository $groupRepository
    )
    {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return $this->groupRepository->findAllPaginated($perPage);
    }

    /**
     * @throws GeneralException
     * @throws ValueNotUniqueException
     */
    public function create(array $requestData): void
    {
        if (!$this->groupRepository->isValueUnique(column: 'name', value: $requestData['name'])) {
            throw new ValueNotUniqueException(entityName: 'Group', columnName: 'name');
        }

        $groupModel = GroupMapper::requestToModel($requestData);

        $this->groupRepository->save($groupModel);
    }

    /**
     * @throws ValueNotUniqueException
     * @throws GeneralException
     */
    public function update(array $requestData, GroupModel $currentModel): void
    {
        if (!$this->groupRepository
            ->isValueUnique(column: 'name', value: $requestData['name'], model: $currentModel)
        ) {
            throw new ValueNotUniqueException(entityName: 'Group', columnName: 'name');
        }

        if (!Helper::isEqualWithType($requestData['name'], $currentModel->getAttribute('name'))) {
            $currentModel->setAttribute('name', $requestData['name']);
        }

        if (!Helper::isEqualWithType($requestData['description'], $currentModel->getAttribute('description'))) {
            $currentModel->setAttribute('description', $requestData['description']);
        }

        if (!Helper::isEqualWithType($requestData['isActive'], $currentModel->getAttribute('is_active'))) {
            $currentModel->setAttribute('is_active', $requestData['isActive']);
        }

        if ($currentModel->isDirty() && auth()->check()) {
            $currentModel->setAttribute('last_modified_by', auth()->id());
        }

        $this->groupRepository->save($currentModel);
    }
}
