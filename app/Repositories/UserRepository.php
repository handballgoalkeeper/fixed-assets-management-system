<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements CrudRepository, PaginatedRepository
{

    public function findAll(): Collection
    {
        // TODO: Implement findAll() method.
    }

    public function save(Model $model): void
    {
        // TODO: Implement save() method.
    }

    /**
     * @throws GeneralException
     * @throws EntityNotFoundException
     */
    public function findAllPaginated(int $perPage): LengthAwarePaginator
    {
        try {
            $users = User::paginate($perPage);
        }
        catch (Exception) {
            throw new GeneralException();
        }

        if ($users->isEmpty()) {
            throw new EntityNotFoundException(entityName: 'User');
        }

        return $users;
    }
}
