<?php

namespace App\Http\Controllers;

use App\Http\Services\PhotoService;
use App\Models\Photo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(PhotoService $photoService): View
    {
        $data = $photoService->getPhotosPerPage(null, true);
        $data['showNavBar'] = true;

        return view('main.index', $data);
    }

    public function showUserPhotos(PhotoService $photoService): View
    {
        $data = $photoService->getPhotosPerPage(auth()->id());
        $data['showNavBar'] = true;

        return view('main.index', $data);
    }

    public function getPhotos(Request $request, PhotoService $photoService): JsonResponse
    {
        $start = $request->get('start');

        $photos = Photo::where('user_id', auth()->id())->orderByDesc('created_at')
            ->skip($start)->take($photoService->photosPerPage)->get();
        $path = Storage::url('public/images/');

        $data = view('main.image', compact(['photos', 'path']))->render();

        return response()->json(['data' => $data, 'result' => true]);
    }
}
