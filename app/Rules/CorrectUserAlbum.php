<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CorrectUserAlbum implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $userAlbumsId = auth()->user()->albums->pluck('id')->toArray();
        if (!in_array($value, $userAlbumsId)) {
            $fail('Помилка завантаження фото!');
        }
    }
}
