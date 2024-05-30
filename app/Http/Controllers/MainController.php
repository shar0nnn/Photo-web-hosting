<?php

namespace App\Http\Controllers;

use App\Filters\PhotoFilters;
use App\Http\Services\PhotoService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(PhotoService $photoService, PhotoFilters $filters): View
    {
        $sortFilters = $filters->filters();

        $isPublic = true;
        $userId = null;
        $groupId = $sortFilters['group'] ?? null;

        $data = $photoService->getPhotosPerPage($filters, $userId, $isPublic);
        $data['showNavBar'] = true;

        $numberOfPublicPhotos = $photoService->getNumberOfPublicPhotos();

        return view('main.index', $data,
            compact('numberOfPublicPhotos', 'isPublic', 'userId', 'sortFilters', 'groupId'));
    }

    public function showUserPhotos(PhotoService $photoService, PhotoFilters $photoFilters): View
    {
        $userId = auth()->id();
        $data = $photoService->getPhotosPerPage($photoFilters, $userId);
        $data['showNavBar'] = true;
        $isPublic = false;

        return view('main.index', $data, compact('isPublic', 'userId'));
    }

    public function getPhotos(Request $request, PhotoService $photoService, PhotoFilters $filters)
    {
        if ($request->ajax()) {
            $start = $request->get('start');
            $userId = $request->get('userId') ?? null;
            $isPublic = $request->get('isPublic') == 1 ? true : false;

            $photos = $photoService->getPhotosPerPage($filters, $userId, $isPublic, $start);
            $data = view('main.image', ['photos' => $photos['photos']])->render();

            return response()->json(['data' => $data, 'result' => true]);
        }
    }

    public function showUserGroup(): View
    {
        $group = auth()->user()->group;
        $groupAlbums = $group->mainAlbums;

        abort_unless($group, 403);

        return view('main.groups.index', compact('group', 'groupAlbums'));
    }
}
