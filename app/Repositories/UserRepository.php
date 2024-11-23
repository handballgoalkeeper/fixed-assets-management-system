<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Models\LocationModel;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class UserRepository implements CrudRepository, PaginatedRepository
{

    public function findAll(): Collection
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @throws GeneralException
     */
    public function save(Model $model): void
    {
        try {
            $model->save();
        }
        catch (Exception $e) {
            throw new GeneralException();
        }
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

    public function isValueUnique(string $column, mixed $value, User|Model $model = null): bool
    {
        if (is_null($model)) {
            $count = DB::table(User::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->count();
        } else {
            $count = DB::table(User::TABLE)
                ->where(column: $column, operator: '=', value: $value)
                ->where(column: 'id', operator: '!=', value: $model->getAttribute('id'))
                ->count();
        }

        return $count === 0;
    }
}
