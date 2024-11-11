<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|string',
            'description' => 'max:255|string|nullable',
            'pib' => 'max:13|string|nullable',
            'contactPerson' => 'max:255|string|nullable',
            'isActive' => 'required|boolean'
        ];
    }
}
