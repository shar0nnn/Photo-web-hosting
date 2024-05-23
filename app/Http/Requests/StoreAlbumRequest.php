<?php

namespace App\Http\Requests;

use App\Rules\CorrectAlbumGroup;
use App\Rules\CorrectParentAlbum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreAlbumRequest extends FormRequest
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
//        $parentAlbumId = $this->input('parent-album');

        return [
            'name' => ['required', 'max:30'],

            'group' => [
                'bail', 'nullable', 'exists:groups,id', new CorrectAlbumGroup,
            ],

            'parent-album' => [
                'bail', 'nullable', 'exists:albums,id', new CorrectParentAlbum,
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Необхідно вказати назву альбому',
            'name.max' => 'Максимальний розмір назви альбому - 30 символів',
            'group.exists' => 'Помилка створення альбому!',
            'parent-album.exists' => 'Помилка створення альбому!',
        ];
    }
}
