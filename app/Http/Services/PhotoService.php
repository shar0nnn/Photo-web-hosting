<?php

namespace App\Http\Services;

use App\Filters\PhotoFilters;
use App\Models\Photo;

class PhotoService
{
    public function getPhotosPerPage(PhotoFilters $filters, $userId = null, $isPublic = false, $skip = 0): array
    {
        $query = Photo::query();

        if ($userId !== null) {
            $query->where('user_id', $userId);
        }
        if ($isPublic === true) {
            $query->where('is_public', true);
        }

        $query->skip($skip)->take(Photo::PHOTOS_PER_PAGE);
        if (!array_key_exists('date', $filters->filters()) && !array_key_exists('likes', $filters->filters())) {
            $query->orderByDesc('created_at');
        }

        $data['photos'] = $query->filter($filters)->get();
        $data['allPhotos'] = $query->count();

        return $data;
    }

    public function getNumberOfPublicPhotos()
    {
        return Photo::where('is_public', true)->count();
    }
}
