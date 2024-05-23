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
    public function showUserAlbum(Album $album): View
    {
//        $photos = Photo::where('user_id', auth()->id())->where('album_id', $album->id)
//            ->orderByDesc('created_at')->get();
        if (auth()->id() !== $album->user_id){
            abort(403);
        }

        $photos = $album->photos;

        return view('albums.content.user', compact(['photos', 'album']));
    }

    public function showGroupAlbum(Album $album): View
    {
        if (auth()->user()->group_id !== $album->group_id){
            abort(403);
        }

        $group = $album->group;
        $photos = $album->photos;
        $subAlbums = $album->children;

        return view('albums.content.group', compact(['album', 'photos', 'group', 'subAlbums']));
    }

    public function store(StoreAlbumRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $groupId = $data['group'] ?? null;
        $groupName = $groupId ? Group::find($groupId)->name : null;
        $parentId = $data['parent-album'] ?? null;

        Album::create([
            'user_id' => auth()->id(),
            'group_id' => $groupId,
            'parent_id' => $parentId,
            'name' => $data['name'],
            'group_name' => $groupName,
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
