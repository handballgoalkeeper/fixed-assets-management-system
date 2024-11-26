<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "assetType" => "required|max:255|string",
            "manufacturerId" => "integer|nullable|exists:manufacturers,id",
            "assetModel" => "required|max:255|string",
            "serialNumber" => "string|nullable|max:255",
            "description" => "string|nullable",
            "fixedAssetNumber" => "string|nullable|max:255",
            "itNumber" => "string|nullable|max:255",
            "supplierId" => "integer|nullable|exists:suppliers,id",
            "storageType" => "string|nullable|max:255",
            "storageCapacity" => "integer|nullable|min:0",
            "storageCapacityUnitsOfMeasure" => "string|nullable|max:3",
            "ramGeneration" => "string|nullable|max:8",
            "ramCapacity" => "integer|nullable|min:0",
            "ramCapacityUnitsOfMeasure" => "string|nullable|max:3",
        ];
    }
}
