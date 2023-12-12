<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CreateCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::select([
            'id', 'icon', 'name', 'slug', 'tab', 'created_at'
        ])->orderBy('id', 'asc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select([
            'id', 'icon', 'name', 'slug', 'tab', 'created_at'
        ])->get();

        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $action = new CreateCategory(
            title: $request->input('name'),
            description: $request->input('slug'),
        );


        $request->validate([
            'name' => 'required|unique:categories',
            'slug' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tab' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = Category::create($request->only(['name', 'slug', 'icon', 'tab', 'parent_id']));

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        $categories = Category::select([
            'id', 'icon', 'name', 'slug', 'tab', 'created_at'
        ]);

        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'slug' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tab' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update($request->only(['name', 'slug', 'icon', 'tab', 'parent_id']));

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
