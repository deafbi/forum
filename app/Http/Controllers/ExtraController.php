<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Group;
use App\Models\Topic;
use App\Models\Vouch;
use App\Models\Reputation;

class ExtraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function members()
    {
        return view('forum.extra.members');
    }

    /**
     * Display a listing of awards resource.
     */
    public function awards()
    {
        return view('forum.extra.awards');
    }

    /**
     * Display a listing of the resource.
     */
    public function groups()
    {
        $groups = Group::with('owner')->get();
        return view('forum.extra.groups', compact('groups'));
    }

    public function leaderboard()
    {
        return view('forum.extra.leaderboard', [
            'topTopicUsers' => $this->topTopicUsers(),
            'topPostUsers' => $this->topPostUsers(),
            'topRepUsers' => $this->topRepUsers(),
            'topVouchUsers' => $this->topVouchUsers(),
        ]);
    }

    private function topTopicUsers()
    {
        return Topic::select('user_id')
            ->groupBy('user_id')
            ->selectRaw('count(*) as total')
            ->orderBy('total', 'desc')
            ->with('user')
            ->take(5)
            ->get();
    }

    private function topPostUsers()
    {
        return Post::select('user_id')
            ->groupBy('user_id')
            ->selectRaw('count(*) as total')
            ->orderBy('total', 'desc')
            ->with('user')
            ->take(5)
            ->get();
    }

    private function topRepUsers()
    {
        return Reputation::select('user_id')
            ->groupBy('user_id')
            ->selectRaw('sum(points) as total')
            ->orderBy('total', 'desc')
            ->with('user')
            ->take(5)
            ->get();
    }

    private function topVouchUsers()
    {
        return Vouch::select('user_id')
            ->groupBy('user_id')
            ->selectRaw('count(*) as total')
            ->orderBy('total', 'desc')
            ->with('user')
            ->take(5)
            ->get();
    }
}
