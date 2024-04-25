<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAlbumRequest;
use App\Models\Album;
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

    public function store(AddAlbumRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Album::create([
            'user_id' => auth()->id(),
            'name' => $data['name'],
        ]);

        return back()->with('success', 'Альбом успішно створено!');
    }

    public function destroy(Album $album): RedirectResponse
    {
        if (auth()->id() === $album->user_id) {
            $album->delete();

            return redirect()->route('user.photos')->with('success', 'Альбом був успішно видалений!');
        }

        return back()->withErrors('Ви не можете видаляти чужі альбоми!');
    }
}
