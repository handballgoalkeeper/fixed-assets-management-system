<?php

namespace App\Mappers;

use App\Models\SupplierModel;

class SupplierMapper
{
    public static function requestToModel(array $requestData): SupplierModel {
        $supplier = new SupplierModel();
        $supplier->setAttribute('name', $requestData['name']);
        $supplier->setAttribute('description', $requestData['description']);
        $supplier->setAttribute('PIB', $requestData['pib']);
        $supplier->setAttribute('contact_person', $requestData['contactPerson']);
        return $supplier;
    }
}
