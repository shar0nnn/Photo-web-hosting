<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CorrectParentAlbum implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $parentAlbumId = auth()->user()->group->albums->pluck('id')->toArray();
        if (!in_array($value, $parentAlbumId)) {
            $fail('Помилка створення альбому!');
        }
    }
}
