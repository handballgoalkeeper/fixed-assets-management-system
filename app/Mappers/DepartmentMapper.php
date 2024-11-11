<?php

namespace App\Mappers;

use App\Models\DepartmentModel;

class DepartmentMapper
{
    public static function requestToModel(array $requestData): DepartmentModel
    {
        $manufacturer = new DepartmentModel();
        $manufacturer->setAttribute('name', $requestData['name']);
        $manufacturer->setAttribute('description', $requestData['description']);

        return $manufacturer;
    }
}
