<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\PermissionAlreadyInGroup;
use App\Exceptions\ValueNotUniqueException;
use App\Mappers\GroupMapper;
use App\Misc\Helper;
use App\Models\GroupModel;
use App\Models\GroupXPermissionModel;
use App\Repositories\GroupRepository;
use App\Repositories\GroupXPermissionRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\Help;

class GroupService
{
    public function __construct(
        protected GroupRepository $groupRepository,
        protected GroupXPermissionRepository $groupXPermissionRepository
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

    /**
     * @throws GeneralException
     */
    public function getAssignedPermissionsByGroupPaginated(GroupModel $group, int $perPage): LengthAwarePaginator
    {
        return $this->groupRepository->getPermissionsByGroupIdPaginated(groupId: $group->id, perPage: $perPage);
    }

    /**
     * @throws GeneralException
     * @throws PermissionAlreadyInGroup
     */
    public function grantPermissionToGroup(GroupModel $group, int $permissionId): void
    {
        if ($this->groupXPermissionRepository
            ->isPermissionAlreadyGranted(groupId: $group->getAttribute('id'), permissionId: $permissionId)) {
            throw new PermissionAlreadyInGroup();
        }

        $model = new GroupXPermissionModel([
            'group_id' => $group->getAttribute('id'),
            'permission_id' => $permissionId,
            'granted_by' => auth()->id()
        ]);

        $this->groupXPermissionRepository->save($model);
    }

    /**
     * @throws GeneralException
     */
    public function revokePermission(GroupXPermissionModel $model): void
    {
        $this->groupXPermissionRepository->destroy($model);
    }

    /**
     * @throws GeneralException
     */
    public function destroy(GroupXPermissionModel $model): void
    {
        try {
            $model->delete();
        }
        catch (Exception) {
            throw new GeneralException();
        }
    }
}
