<?php

namespace App\Mappers;

use App\Models\LocationModel;

class LocationMapper
{
    public static function requestToModel(array $data): LocationModel {
        $model = new LocationModel();

        $model->setAttribute('alias', $data['alias']);
        $model->setAttribute('street_name', $data['streetName']);
        $model->setAttribute('street_number', $data['streetNumber']);
        $model->setAttribute('city', $data['city']);

        return $model;
    }
}
