<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Award;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users|alpha_dash|max:20',
            'password' => 'required|min:8|max:21|confirmed',
        ]);

        $user = User::create([
            'username' => $request->name,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        $roles = Role::select('id', 'name')->get();
        $groups = Group::select('id', 'name')->get();
        $awards = Award::select('id', 'name')->get();

        return view('admin.users.edit', compact('user', 'roles', 'groups', 'awards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Should be moved to a form request
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'username_color' => 'nullable',
            'credit' => 'required|numeric',
            'is_banned' => 'required|boolean',
            'avatar' => 'nullable',
            'role_id' => 'required|exists:roles,id',
            'signature' => 'nullable|string|max:1000',
            'groups' => 'nullable|array',
            'groups.*' => 'exists:groups,id',
            'awards' => 'nullable|array',
            'awards.*' => 'exists:awards,id',
            'post_count' => 'required|numeric',
            'topic_count' => 'required|numeric',
        ]);

        $user->update($request->only([
            'username',
            'username_color',
            'credit',
            'is_banned',
            'avatar',
            'role_id',
            'signature',
            'post_count',
            'topic_count'
        ]));

        // Sync groups with the submitted group IDs
        $groupIds = $request->input('groups') ?: [];
        $user->groups()->sync($groupIds);

        // Sync awards with the submitted award IDs
        $awardIds = $request->input('awards') ?: [];
        $user->awards()->sync($awardIds);
        $user->save();

        // Only update the user's role if their ID is not 1
        if ($user->id != 1) {
            $user->roles()->sync([$request->role_id]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
