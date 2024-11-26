<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'firstName' => 'required|max:255|string',
            'lastName' => 'required|max:255|string',
            'email' => 'required|max:255|email',
            'isActive' => 'required|boolean',
        ];
    }
}
