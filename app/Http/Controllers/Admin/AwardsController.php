<?php

namespace App\Http\Controllers\Admin;

use App\Models\Award;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AwardsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $awards = Award::select('id', 'icon', 'name', 'description')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('admin.awards.index', compact('awards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.awards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:awards',
            'description' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $award = Award::create($request->only(['name', 'description', 'icon']));

        return redirect()->route('admin.awards.index')->with('success', 'Award created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $award = Award::findOrFail($id);
        return view('admin.awards.show', compact('award'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $award = Award::findOrFail($id);
        return view('admin.awards.edit', compact('award'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $award = Award::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:awards,award_name,' . $award->id,
            'description' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $award->update($request->only(['name', 'description', 'icon']));

        return redirect()->route('admin.awards.index')->with('success', 'Award updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $award = Award::findOrFail($id);

        $award->delete();

        return redirect()->route('admin.awards.index')->with('success', 'Award deleted successfully.');
    }
}
