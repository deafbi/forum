<?php

namespace App\Http\Controllers\Admin;

use App\Models\Topic;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Only select the columns we need and paginate the results
        $topics = Topic::select(['id', 'title', 'slug', 'category_id', 'user_id', 'created_at', 'updated_at'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Should not create an topic in the admin panel
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:topics',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
        ]);

        $topic = Topic::create($request->only(['title', 'category_id', 'content']));

        return redirect()->route('admin.topics.index')->with('success', 'Topic created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $topic = Topic::findOrFail($id);

        return view('admin.topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $topic = Topic::findOrFail($id);

        $categories = Category::all();
        return view('admin.topics.edit', compact('topic', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $topic = Topic::findOrFail($id);

        $request->validate([
            'title' => 'required|unique:topics,title,' . $topic->id,
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
        ]);

        $topic->update($request->only(['title', 'category_id', 'content']));

        return redirect()->route('admin.topics.index')->with('success', 'Topic updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $topic = Topic::findOrFail($id);

        $topic->delete();
        return redirect()->route('admin.topics.index')->with('success', 'Topic deleted successfully.');
    }
}
