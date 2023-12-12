<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class ForumController extends Controller
{
    /**
     * Show the forum index page.
     */
    public function index()
    {
        return view('index', [
            'activeUsers' => $this->getActiveUsers(),
            'newestMember' => $this->getNewestMember(),
            'onlineAdminsAndModerators' => $this->getOnlineAdminsAndModerators(),
        ]);
    }

    /**
     * Get a collection of active users.
     */
    private function getActiveUsers()
    {
        return Cache::remember('activeUsers', 10, function () {
            if (User::hasAnyUserLoggedIn()) {
                // Eager load roles relationship and select specific columns
                return User::loggedInPast24Hours()
                    ->select('id', 'username', 'last_login_at')
                    ->with('roles')
                    ->inRandomOrder()
                    ->get();
            }

            return collect([]); // return an empty collection if no user has ever logged in
        });
    }

    /**
     * Get a collection of online admins and moderators.
     */
    private function getOnlineAdminsAndModerators()
    {
        return Cache::remember('onlineAdminsAndModerators', 10, function () {
            return User::adminsAndModerators()->online()->get();
        });
    }

    /**
     * Get the newest member.
     */
    private function getNewestMember()
    {
        return Cache::remember('newestMember', 5, function () {
            return User::latest()->first();
        });
    }

    /**
     * Show the latest posts.
     */
    public function latestPosts()
    {
        return view('latest-posts');
    }

    /**
     * Show the latest topics.
     */
    public function latestTopics()
    {
        return view('latest-topics');
    }

    /**
     * Show the search page.
     */
    public function search()
    {
        return view('search');
    }
}
