<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    use HasFactory;

    const PHOTO_PATH = 'public/images/';
    const PHOTOS_PER_PAGE = 6;

    protected $fillable = [
        'user_id',
        'album_id',
        'name',
        'size',
        'original_name',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function usersLikes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'photo_id', 'user_id');
    }

    public function currentUserLikes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'photo_id', 'user_id')
            ->where(function (Builder $query) {
                return $query->where('user_id', auth()->id());
            });
    }
}
