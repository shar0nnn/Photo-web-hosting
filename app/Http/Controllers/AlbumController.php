<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Models\Album;
use App\Models\Group;
use App\Models\Photo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AlbumController extends Controller
{
    public function index(Album $album): View
    {
        $photos = Photo::where('user_id', auth()->id())->where('album_id', $album->id)
            ->orderByDesc('created_at')->get();
        $path = Storage::url('public/images/');

        return view('albums.index', compact(['photos', 'path', 'album']));
    }

    public function store(StoreAlbumRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (array_key_exists('group', $data)) {
            $group_id = $data['group'];
            $group_name = Group::where('id', ($data['group']))->get()->toArray()[0]['name'];
        } else $group_id = $group_name = null;

        Album::create([
            'user_id' => auth()->id(),
            'group_id' => $group_id,
            'name' => $data['name'],
            'group_name' => $group_name,
        ]);

        return back()->with('success', 'Альбом успішно створено!');
    }

    public function destroy(Album $album): RedirectResponse
    {
        if (auth()->id() === $album->user_id) {
            $album->delete();

            return redirect()->route('user.photos')->with('success', 'Альбом успішно видалений!');
        }

        return back()->withErrors('Помилка видалення альбому!');
    }
}
