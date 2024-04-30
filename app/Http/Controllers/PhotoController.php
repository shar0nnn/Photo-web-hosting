<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\Photo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;

class PhotoController extends Controller
{
    public function store(StorePhotoRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $randomName = Str::random(10);
        $originalName = $randomName . '.' . $data['photo']->getClientOriginalExtension();
        $originalNameMin = 'min_' . $randomName . '.' . $data['photo']->getClientOriginalExtension();

        Photo::create([
            'user_id' => auth()->id(),
            'album_id' => array_key_exists('album', $data) ? $data['album'] : null,
            'name' => $data['photo']->getClientOriginalName(),
            'original_name' => $originalName,
            'size' => $data['photo']->getSize(),
        ]);

        $data['photo']->storeAs('public/images' . '/' . auth()->id(), $originalName);

        $manager = new ImageManager(new Driver());
        $fullPath = Storage::disk('public')->path('images/' . auth()->id() . '/' . $originalName);

        $image = $manager->read($fullPath);
        $image->scale(height: 300);
        $image->save(Storage::disk('public')->path('images/' . auth()->id() . '/' . $originalNameMin));

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
            Storage::delete('public/images' . '/' . auth()->id() . '/min_' . $photo->original_name);
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
