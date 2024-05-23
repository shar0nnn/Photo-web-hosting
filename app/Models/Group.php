<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    public function mainAlbums(): HasMany
    {
        return $this->hasMany(Album::class)->whereNull('parent_id');
    }
}
