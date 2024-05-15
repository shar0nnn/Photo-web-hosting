<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $groups = Group::all()->sortByDesc('name');

        return view('admin.groups.index', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddGroupRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Group::create(['name' => $data['name']]);

        return redirect()->route('groups.index')->with('success', 'Група була успішно створена!');
    }

    /**
     * Display the specified resource.
     */
    public function create(): View
    {
        return view('admin.groups.form');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroupRequest $request, Group $group): RedirectResponse
    {
        $data = $request->validated();
        $group->update(['name' => $data['name']]);

        return redirect()->route('groups.index')->with('success', 'Група була успішно відредагована!');
    }

    public function edit(Group $group): View
    {
        return view('admin.groups.form', compact('group'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group): RedirectResponse
    {
        if ($group->users->isNotEmpty()) {
            return back()->withErrors('Не можна видаляти групу, поки в ній є хоча б 1 учасник');
        }
        $group->delete();

        return back()->with('success', 'Група була успішно видалена!');
    }
}
