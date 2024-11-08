<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CrudRepository
{
    /**
     * @return Collection
     */
    public function findAll(): Collection;

    /**
     * @param Model $model
     * @return void
     */
    public function save(Model $model): void;
}
