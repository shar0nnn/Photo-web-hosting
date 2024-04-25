<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\Photo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    public function store(StorePhotoRequest $request, $albumId): RedirectResponse
    {
        $file = $request->validated()['photo'];
        $originalName = Str::random(10) . '.' . $file->getClientOriginalExtension();

        if (isset($albumId)) {
            Photo::create([
                'user_id' => auth()->id(),
                'album_id' => $albumId,
                'name' => $file->getClientOriginalName(),
                'original_name' => $originalName,
                'size' => $file->getSize(),
            ]);
        } else {
            Photo::create([
                'user_id' => auth()->id(),
                'name' => $file->getClientOriginalName(),
                'original_name' => $originalName,
                'size' => $file->getSize(),
            ]);
        }

        $file->storeAs('public/images' . '/' . auth()->id(), $originalName);

        return back()->with('success', 'Фото успішно завантажено!');
    }

    public function update(UpdatePhotoRequest $request, Photo $photo): RedirectResponse
    {
        if (auth()->id() === $photo->user_id) {
            $data = $request->validated();
            $data['is_public'] = (int)$data['is_public'] === 1 ? 0 : 1;
            $photo->update($data);

            return back();
        }

        return back()->withErrors('Ви не можете робити приватними чужі фото');
    }

    public function destroy(Photo $photo): RedirectResponse
    {
        if (auth()->id() === $photo->user_id) {
            Storage::delete('public/images' . '/' . auth()->id() . '/' . $photo->original_name);
            $photo->delete();

            return back()->with('success', 'Фото було успішно видалено!');
        }

        return back()->withErrors('Ви не можете видаляти чужі фото!');
    }

    public function like(Photo $photo): RedirectResponse
    {
        $photo->usersLikes()->sync([auth()->id()]);

        return back();
    }
}
