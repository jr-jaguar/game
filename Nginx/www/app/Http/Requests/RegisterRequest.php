<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'unique:players'
            ],
            'phone_number' => [
                'required',
                'string',
                'regex:/^\+?[1-9]\d{10,14}$/',
                'unique:players'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username is required',
            'username.min' => 'Username must be at least 3 characters',
            'username.unique' => 'This username is already taken',
            'phone_number.required' => 'Phone number is required',
            'phone_number.regex' => 'Invalid phone number format',
            'phone_number.unique' => 'This phone number is already taken',
        ];
    }
}
