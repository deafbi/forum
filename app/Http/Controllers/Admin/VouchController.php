<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vouch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VouchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouches = Vouch::all();
        return view('admin.vouches.index', compact('vouches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vouches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required|unique:vouches,name',
        ]);

        // store
        $vouch = Vouch::create($request->only(['name']));

        // redirect
        return redirect()->route('admin.vouches.index')->with('success', 'Vouch created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.vouches.show', [
            'vouch' => Vouch::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vouch = Vouch::findOrFail($id);

        return view('admin.vouches.edit', compact('vouch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate
        $request->validate([
            'name' => 'required|unique:vouches,name,' . $id,
        ]);

        // update
        $vouch = Vouch::findOrFail($id);
        $vouch->update($request->only(['name']));

        // redirect
        return redirect()->route('admin.vouches.index')->with('success', 'Vouch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vouch = Vouch::findOrFail($id);

        $vouch->delete();

        return redirect()->route('admin.vouches.index')->with('success', 'Vouch deleted successfully.');
    }
}
