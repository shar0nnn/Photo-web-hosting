<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Photo extends Model
{
    use HasFactory;

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function usersLikes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'photo_user');
    }

    protected $fillable = [
        'user_id',
        'album_id',
        'name',
        'size',
        'original_name',
        'is_public',
    ];
}
