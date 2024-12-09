<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

interface PaginatedRepository
{

    /**
     * @param int $perPage
     * @param string $searchQuery
     * @param string $sortByColumn
     * @param string $sortOrder
     * @return LengthAwarePaginator
     */
    public function findAllPaginated(int $perPage, string $searchQuery, string $sortByColumn, string $sortOrder): LengthAwarePaginator;

}
