<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UpdateGroupRequest extends FormRequest
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
            'name' => ['required', 'unique:groups,name', 'max:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Необхідно вказати назву групи',
            'name.unique' => 'Група з такою назвою вже існує',
            'name.max' => 'Максимальний розмір назви групи - 10 символів',
        ];
    }
}
