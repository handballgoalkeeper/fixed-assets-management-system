<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'alias' => 'required|max:255|string',
            'streetName' => 'required|max:255|string',
            'streetNumber' => 'required|max:5|string',
            'city' => 'required|max:255|string'
        ];
    }
}
