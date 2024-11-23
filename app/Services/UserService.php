<?php

namespace App\Services;

use App\Enums\UserAction;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Mappers\UserMapper;
use App\Misc\Helper;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository
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
}
