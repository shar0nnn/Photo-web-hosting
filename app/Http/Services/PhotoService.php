<?php

namespace App\Http\Services;

use App\Models\Group;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoService
{
    public function getPhotosPerPage($userId = null, $isPublic = false, $groupId = null, $skip = 0): array
    {
        $query = Photo::query();

//        dd($query->whereHas('user', function (Builder $query) {
//            $query->where('group_id', 5);
//        })->get());
        if ($userId !== null) {
            $query->where('user_id', $userId);
        }
        if ($isPublic === true) {
            $query->where('is_public', true);
        }
        if ($groupId !== null) {
            $query->whereRelation('user', 'group_id', $groupId)->get();
        }

        $data['allPhotos'] = $query->count();
        $data['photos'] = $query->orderByDesc('created_at')
            ->skip($skip)->take(Photo::PHOTOS_PER_PAGE)->get();

        return $data;
    }

    public function getNumberOfPublicPhotos()
    {
        return Photo::where('is_public', true)->count();
    }
}
