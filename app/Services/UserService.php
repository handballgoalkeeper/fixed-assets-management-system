<?php

namespace App\Services;

use App\Enums\UserAction;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\GroupAlreadyGranted;
use App\Exceptions\ValueNotUniqueException;
use App\Mappers\UserMapper;
use App\Misc\Helper;
use App\Models\User;
use App\Models\UserXGroupModel;
use App\Repositories\UserRepository;
use App\Repositories\UserXGroupsRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Ramsey\Collection\Collection;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository,
        protected UserXGroupsRepository $userXGroupsRepository
    )
    {
    }

    /**
     * @throws GeneralException
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage): LengthAwarePaginator
    {
        return $this->userRepository->findAllPaginated($perPage);
    }

    /**
     * @throws GeneralException
     */
    public function createNewUser(array $requestData): void
    {
        $userModel = UserMapper::requestToModel(requestData: $requestData);

        $this->userRepository->save($userModel);
    }

    /**
     * @throws GeneralException
     * @throws ValueNotUniqueException
     */
    public function updateUser(array $requestData, User $current): void
    {
        if (!$this->userRepository->isValueUnique(column: 'email', value: $requestData['email'], model: $current)) {
            throw new ValueNotUniqueException(entityName: 'User', columnName: 'email');
        }

        if (!Helper::isEqualWithType($requestData['name'], $current->getAttribute('name'))) {
            $current->setAttribute('name', $requestData['name']);
        }

        if (!Helper::isEqualWithType($requestData['email'],$current->getAttribute('email'))) {
            $current->setAttribute('email', $requestData['email']);
        }

        if (!Helper::isEqualWithType($requestData['isActive'],$current->getAttribute('is_active'))) {
            $current->setAttribute('is_active', $requestData['isActive']);
        }

        if ($current->isDirty()) {
            $current->setAttribute('last_modified_by', auth()->id());
        }

        $this->userRepository->save($current);
    }

    /**
     * @throws GeneralException
     */
    public function getAssignedGroups(User $user, int $perPage): LengthAwarePaginator
    {
        return $this->userXGroupsRepository->findGroupsByUserIdPaginated(perPage: $perPage, userId: $user->getAttribute('id'));
    }

    /**
     * @throws GeneralException
     * @throws GroupAlreadyGranted
     */
    public function assignGroupToUser(User $user, array $requestData): void
    {
        if ($this->userXGroupsRepository
            ->isGroupAlreadyGranted(userId: $user->getAttribute('id'), groupId: $requestData['selectedGroup'])) {
            throw new GroupAlreadyGranted();
        }


        $model = new UserXGroupModel([
            'user_id' => $user->getAttribute('id'),
            'group_id' => $requestData['selectedGroup']
        ]);

        if (auth()->check()) {
            $model->setAttribute('granted_by', auth()->id());
        }

        $this->userXGroupsRepository->save($model);

    }

    /**
     * @throws GeneralException
     */
    public function revokeGroup(UserXGroupModel $model): void
    {
        $this->userXGroupsRepository->destroy($model);
    }

    /**
     * @throws GeneralException
     */
    public function getUserPermissionsByUserId(int $userId): \Illuminate\Support\Collection
    {
        return $this->userRepository->getUserPermissionsByUserId(userId: $userId);
    }
}
