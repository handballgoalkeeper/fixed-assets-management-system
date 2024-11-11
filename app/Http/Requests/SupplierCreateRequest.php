<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SupplierCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255|string',
            'description' => 'max:255|string|nullable',
            'pib' => 'min:8|max:13|string|nullable',
            'contactPerson' => 'min:0|max:255|string|nullable'
        ];
    }
}
