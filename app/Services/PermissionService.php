<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Repositories\PermissionRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PermissionService
{
    public function __construct(
        protected PermissionRepository $permissionRepository
    )
    {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return $this->permissionRepository->findAllPaginated($perPage);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findAll(): Collection
    {
        return $this->permissionRepository->findAll();
    }
}
