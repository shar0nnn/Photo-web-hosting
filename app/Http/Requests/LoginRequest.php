<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use function Laravel\Prompts\password;

class LoginRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Необхідно ввести email і пароль',
            'password.required' => 'Необхідно ввести email і пароль',
        ];
    }
}
