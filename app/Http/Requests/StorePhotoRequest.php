<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StorePhotoRequest extends FormRequest
{
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
            'photo' => [
                'bail', 'required', 'extensions:jpeg,jpg',
                File::types(['jpeg', 'jpg', 'png'])->max(15 * 1024),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'photo.required' => 'Необхідно вибрати фото для завантаження',
            'photo.extensions' => 'Розширення файлу має бути jpeg, jpg або png',
            'photo.max' => 'Максимальний розмір файлу - 15 МБ'
        ];
    }
}
