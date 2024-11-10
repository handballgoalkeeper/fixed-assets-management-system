<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Repositories\SupplierRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class SupplierService
{
    public function __construct(
        protected SupplierRepository $supplierRepository
    )
    {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage = 10): LengthAwarePaginator {
        return $this->supplierRepository->findAllPaginated(perPage: $perPage);
    }
}
