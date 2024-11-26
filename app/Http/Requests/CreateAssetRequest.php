<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'assetType' => 'required|string|max:255',
            'manufacturerId' => 'integer|nullable|exists:manufacturers,id',
            'assetModel' => 'required|string|max:255',
            'serialNumber' => 'string|max:255|nullable',
            'description' => 'string|max:255|nullable'
        ];
    }
}
