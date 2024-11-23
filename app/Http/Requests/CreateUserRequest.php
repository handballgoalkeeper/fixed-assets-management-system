<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255|string',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed:reenteredPassword|regex:/[A-Z]/|regex:/[^a-zA-Z\d]/',
        ];
    }
}
