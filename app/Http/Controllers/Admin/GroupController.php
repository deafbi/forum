<?php

namespace App\Http\Controllers\Admin;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::select(['id', 'name', 'slug', 'description', 'color', 'group_avatar', 'owner_id'])
            ->orderBy('id', 'asc')
            ->paginate(10);

            return view('admin.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required|unique:groups,name',
            'slug' => 'required',
            'description' => 'required',
            'color' => 'required',
            'group_avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'owner_id' => 'required',
        ]);

        // store
        $group = Group::create($request->only(['name', 'slug', 'description', 'color', 'group_avatar', 'owner_id']));

        // redirect
        return redirect()->route('admin.groups.index')->with('success', 'Group created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.groups.show', [
            'group' => Group::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.groups.edit', [
            'group' => Group::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate
        $request->validate([
            'name' => 'required|unique:groups,name,' . $id,
            'slug' => 'required',
            'description' => 'required',
            'color' => 'required',
            'group_avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'owner_id' => 'required',
        ]);

        // update
        $group = Group::findOrFail($id);
        $group->update($request->only(['name', 'slug', 'description', 'color', 'group_avatar', 'owner_id']));
        $group->save();

        // redirect
        return redirect()->route('admin.groups.index')->with('success', 'Group updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete
        $group = Group::findOrFail($id);

        $group->delete();

        // redirect
        return redirect()->route('admin.groups.index')->with('success', 'Group deleted successfully.');
    }
}
