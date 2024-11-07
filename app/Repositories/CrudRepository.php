<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface CrudRepository
{
    /**
     * @return Collection
     */
    public function findAll(): Collection;
}
