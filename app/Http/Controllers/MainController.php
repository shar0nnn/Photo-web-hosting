<?php

namespace App\Http\Controllers;

use App\Http\Services\PhotoService;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(Request $request, PhotoService $photoService): View
    {
        $groups = Group::all();
        $groupId = in_array($request->group, $groups->pluck('id')->toArray()) ? $request->group : null;

        $isPublic = true;
        $userId = null;

        $data = $photoService->getPhotosPerPage($userId, $isPublic, $groupId);
        $data['showNavBar'] = true;
        $numberOfPublicPhotos = $photoService->getNumberOfPublicPhotos();

        return view('main.index', $data,
            compact('groups', 'numberOfPublicPhotos', 'groupId', 'isPublic', 'userId'));
    }

    public function showUserPhotos(PhotoService $photoService): View
    {
        $userId = auth()->id();
        $data = $photoService->getPhotosPerPage($userId);
        $data['showNavBar'] = true;
        $isPublic = false;

        return view('main.index', $data, compact('isPublic', 'userId'));
    }

    public function getPhotos(Request $request, PhotoService $photoService)
    {
        if ($request->ajax()) {
            $start = $request->get('start');
            $userId = $request->get('userId') ?? null;
            $group = $request->get('group') ?? null;
            $isPublic = $request->get('isPublic') == 1 ? true : false;

            $photos = $photoService->getPhotosPerPage($userId, $isPublic, $group, $start);
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
