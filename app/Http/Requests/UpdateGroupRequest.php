<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
        $groupId = $this->input('group-id');

        return [
            'name' => ['required', 'max:10', Rule::unique('groups')->ignore($groupId),],
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
