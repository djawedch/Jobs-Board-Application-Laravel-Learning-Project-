<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
            'role' => ['required', 'in:candidate,employer'],

            'employer' => ['required_if:role,employer', 'nullable', 'string', 'max:255', 'unique:employers,name'],
            'logo' => ['required_if:role,employer', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'logo.required_if' => 'The company logo is required when registering as an employer.',
            'logo.image' => 'The logo must be an image file.',
            'logo.max' => 'The logo must not exceed 2MB in size.',
        ];
    }
}
