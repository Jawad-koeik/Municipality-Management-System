<?php

namespace App\Http\Requests\Auth;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'national_id' => ['required', 'string', 'max:50', 'unique:citizens,national_id'],
            'address' => ['required', 'string', 'max:500'],
            'contact' => ['required', 'string', 'max:50'],
            'date_of_birth' => ['required', 'date', 'before:today'],
        ];
    }
}
