<?php

namespace App\Mappers;

use App\Models\EmployeeModel;

class EmployeeMapper
{
    public static function requestDataToModel(array $requestData): EmployeeModel
    {
        return new EmployeeModel([
            'first_name' => $requestData['firstName'],
            'last_name' => $requestData['lastName'],
            'email' => $requestData['email']
        ]);
    }
}
