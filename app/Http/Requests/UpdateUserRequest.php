<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->input('user-id');

        return [
            'name' => ['required', 'max:30',],
            'group' => ['nullable', 'exists:groups,id',],
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId),],
            'role' => ['required', 'exists:roles,name',],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Необхідно вказати ім\'я',
            'name.max' => 'Максимальний розмір імені - 30 символів',
            'group.exists' => 'Такої групи не існує',
            'email.required' => 'Необхідно вказати email',
            'email.unique' => 'Цей email вже використовується',
        ];
    }
}
