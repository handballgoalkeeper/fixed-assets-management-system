<?php

namespace App\Mappers;

use App\Models\ManufacturerModel;

class ManufacturerMapper
{
    public static function requestToModel(array $requestData): ManufacturerModel
    {
        $manufacturer = new ManufacturerModel();
        $manufacturer->setAttribute('name', $requestData['name']);
        $manufacturer->setAttribute('description', $requestData['description']);

        return $manufacturer;
    }
}
