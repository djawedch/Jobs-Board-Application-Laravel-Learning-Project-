<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => ['required', 'in:candidate,employer'],

            'employer' => ['required_if:role,employer', 'nullable', 'string', 'max:255', 'unique:employers,name'],
            'logo' => ['required_if:role,employer', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your full name.',

            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',

            'password.required' => 'Please enter a password.',
            'password.confirmed' => 'Passwords do not match.',
            'password.min' => 'Password must be at least 8 characters.',

            'role.required' => 'Please select a role.',
            'role.in' => 'Please select either Candidate or Employer.',

            'employer.required_if' => 'Company name is required for employers.',
            'employer.max' => 'Company name must not exceed 255 characters.',
            'employer.unique' => 'This company name is already registered.',

            'logo.required_if' => 'The company logo is required for employers.',
            'logo.image' => 'The logo must be an image file.',
            'logo.mimes' => 'Logo must be a JPG, JPEG, PNG, or GIF file.',
            'logo.max' => 'The logo must not exceed 2MB in size.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim($this->input('name')),
            'email' => trim($this->input('email')),
            'employer' => trim($this->input('employer', '')),
        ]);
    }
}