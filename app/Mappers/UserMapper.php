<?php

namespace App\Mappers;

use App\Models\User;

class UserMapper
{
    public static function requestToModel(array $requestData): User
    {
        return new User([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => bcrypt($requestData['password']),
        ]);
    }
}
