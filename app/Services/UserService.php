<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Mappers\UserMapper;
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
        $userModel = UserMapper::requestToModel($requestData);

        $this->userRepository->save($userModel);
    }
}
