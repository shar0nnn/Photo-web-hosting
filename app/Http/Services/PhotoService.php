<?php

namespace App\Http\Services;

use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoService
{
    public $photosPerPage = 6;
    public function getPhotosPerPage($userId = null, $isPublic = false): array
    {
        $query = Photo::query();

        if ($userId !== null) {
            $query->where('user_id', $userId);
        }
        if ($isPublic === true) {
            $query->where('is_public', true);
        }

        $data['photosPerPage'] = $this->photosPerPage;
        $data['allPhotos'] = $query->orderByDesc('created_at')->count();
        $data['photos'] = $query->orderByDesc('created_at')
            ->skip(0)->take($this->photosPerPage)->get();

        $data['path'] = Storage::url('public/images/');

        return $data;
    }
}
