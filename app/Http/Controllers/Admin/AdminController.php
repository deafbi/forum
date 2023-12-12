<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Topic;
use App\Models\Report;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::count();
        $topics = Topic::count();
        $posts = Post::count();
        $reports = Report::count();

        return view('admin.index', compact('users', 'topics', 'posts', 'reports'));
    }
}
