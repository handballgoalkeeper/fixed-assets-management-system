<?php

namespace App\Mappers;

use App\Models\GroupModel;

class GroupMapper
{
    public static function requestToModel(array $requestData): GroupModel
    {
        return new GroupModel([
            'name' => $requestData['name'],
            'description' => $requestData['description'],
        ]);
    }
}
