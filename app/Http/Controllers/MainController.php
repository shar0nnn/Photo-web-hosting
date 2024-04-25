<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        $photos = Photo::where('is_public', true)->orderByDesc('created_at')->get();
        $path = Storage::url('public/images/');

        return view('main.index', compact(['photos', 'path']));
    }

    public function showUserPhotos(): View
    {
        $photos = Photo::where('user_id', auth()->id())->orderByDesc('created_at')->get();
        $path = Storage::url('public/images/');

        return view('main.index', compact(['photos', 'path']));
    }

//    public function showUserAlbums(): View
//    {
//        $albums = Album::where('user_id', auth()->id())->orderByDesc('created_at')->get();
//
//        return view('main.index', compact('albums'));
//    }
}
