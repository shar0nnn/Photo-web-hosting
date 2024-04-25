<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class AddUserRequest extends FormRequest
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
            'name' => ['required', 'max:30',],
            'group' => 'max:10',
            'email' => ['required', 'email', 'unique:users,email',],
            'password' => ['required', 'min:8', 'max:30',],
            'role' => ['required', 'exists:roles,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Необхідно вказати ім\'я',
            'name.max' => 'Максимальний розмір імені - 30 символів',
            'group.max' => 'Назва групи не може бути більше 10 символів',
            'email.required' => 'Необхідно вказати email',
            'email.unique' => 'Цей email вже використовується',
            'password.required' => 'Необхідно вказати пароль',
            'password.min' => 'Пароль не може бути менше 8 символів',
            'password.max' => 'Максимальний розмір паролю - 30 символів',
        ];
    }
}
