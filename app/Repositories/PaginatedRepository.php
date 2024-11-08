<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

interface PaginatedRepository
{

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function findAllPaginated(int $perPage): LengthAwarePaginator;

}
