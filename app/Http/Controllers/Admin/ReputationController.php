<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reputation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;

class ReputationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reputations = Reputation::select(['id', 'user_id', 'giver_id', 'reason'])->orderBy('id', 'desc')->get();

        return view('admin.reputations.index', compact('reputations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::select(['id', 'name'])->get();

        return view('admin.reputations.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required|unique:reputations,name',
        ]);

        // store
        $reputation = Reputation::create($request->only(['name']));

        // redirect
        return redirect()->route('admin.reputations.index')->with('success', 'Reputation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.reputations.show', [
            'reputation' => Reputation::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.reputations.edit', [
            'reputation' => Reputation::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate
        $request->validate([
            'name' => 'required|unique:reputations,name,' . $id,
        ]);

        // update
        $reputation = Reputation::findOrFail($id);
        $reputation->update($request->only(['name']));

        // redirect
        return redirect()->route('admin.reputations.index')->with('success', 'Reputation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete
        $reputation = Reputation::findOrFail($id);

        $reputation->delete();

        // redirect
        return redirect()->route('admin.reputations.index')->with('success', 'Reputation deleted successfully.');
    }
}
