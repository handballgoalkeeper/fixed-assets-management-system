<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

interface HistoryRepository
{

    /**
     * @param int $perPage
     * @param int $entityId
     * @return LengthAwarePaginator
     */
    public function findAllByIdPaginated(int $perPage, int $entityId): LengthAwarePaginator;
}
