<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\User;
use Illuminate\View\View;
use App\Models\PastAvatar;
use App\Models\ProfileVisit;
use Illuminate\Http\Request;
use App\Models\UsernameHistory;
use App\Services\ReputationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreCoverRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreAvatarRequest;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    private $reputationService;

    public function __construct(ReputationService $reputationService)
    {
        $this->middleware('auth')->only(['edit', 'update', 'destroy', 'avatarUpdate', 'scan']);
        $this->reputationService = $reputationService;
    }

    public function show(User $user, ReputationService $reputationService): View
    {
        $reputationWithStyle = $reputationService->getReputationWithStyle($user);

        $user = User::select('id', 'username', 'avatar', 'show_cover', 'cover', 'title', 'created_at')
        ->with([
            'roles',
            'profileVisits',
            'posts' => function ($query) {
                $query->select('id', 'user_id', 'topic_id', 'content', 'created_at');
            },
            'topics' => function ($query) {
                $query->select('id', 'user_id', 'category_id', 'title', 'slug', 'created_at')
                    ->with('category');
            },
        ])
        ->findOrFail($user->id);

        if (auth()->id() != $user->id) {
            ProfileVisit::create([
                'profile_id' => $user->id,
                'visitor_id' => auth()->id(),
            ]);
        }

        $lastVisitor = $user->profileVisits->first() ? $user->profileVisits->first()->visitor : null;
        $profileViews = ProfileVisit::where('profile_id', $user->id)->count();

        $latestActivities = $user->load(['posts', 'topics'])
            ->posts->merge($user->topics)
            ->sortByDesc('created_at')
            ->take(5);

        return view('profile.show', compact('user', 'latestActivities', 'reputationWithStyle', 'lastVisitor', 'profileViews'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = auth()->user();
        $pastAvatars = $user->pastAvatars()
            ->select('avatar_url')
            ->distinct()
            ->get();

        return view('profile.edit', compact('user', 'pastAvatars'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $previousUsername = $user->username;

        $canChangeUsername = $user->isInGroup('Upgrade 1') || $user->isInGroup('Upgrade 2');

        $user->fill($request->validated());

        if ($canChangeUsername && $user->isDirty('username')) {
            $usernameHistory = new UsernameHistory([
                'previous_username' => $previousUsername,
                'new_username' => $user->username,
                'changed_at' => Carbon::now(),
            ]);
            $usernameHistory->user()->associate($user);
            $usernameHistory->save();

            $user->save();

            return Redirect::route('profile.account')->with('success', 'Profile updated successfully.');
        } else {
            $user->username = $previousUsername;
            $user->save();

            return Redirect::route('profile.account')->with('error', 'Username could not be changed. You must be part of Upgrade 1 or Upgrade 2 group.');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // TODO move to its own request
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function security()
    {
    }

    public function notifications()
    {
    }

    public function privacy()
    {
    }

    public function account(Request $request)
    {
        return view('account.account', [
            'user' => $request->user(),
        ]);
    }

    public function scan(User $user)
    {
        $ip_address = $user->last_login_ip;

        $users = User::where('last_login_ip', $ip_address)
            ->where('id', '!=', $user)
            ->get();

        return view('forum.scan.index', compact('users', 'user'));
    }

    public function updateSignature(Request $request)
    {
        // TODO move to its own request
        $request->validate([
            'signature' => ['nullable', 'string', 'max:255'],
        ]);

        $user = Auth::user();

        $canUpdateSignature = $user->isInGroup('Upgrade 1') || $user->isInGroup('Upgrade 2') || $user->hasRole('admin');

        // TODO turn into action
        if ($canUpdateSignature) {
            $user->signature = $request->signature;
            $user->save();
            return redirect()->back()->with('success', 'Your signature has been updated.');
        }

        return redirect()->back()->with('error', 'You do not have permission to update your signature.');
    }


    public function updateAvatar(StoreAvatarRequest $request)
    {
        $user = auth()->user();
        $previousAvatar = $user->avatar;

        $user->updateAvatar($request->input('avatar'));

        // Check if the previous avatar already exists in the past_avatars table
        $avatarExists = $user->pastAvatars()
            ->where('avatar_url', $previousAvatar)
            ->exists();

        // Store the previous avatar in the past_avatars table if it doesn't already exist
        if (!$avatarExists) {
            PastAvatar::create([
                'user_id' => $user->id,
                'avatar_url' => $previousAvatar
            ]);
        }

        return redirect()->back()->with('success', 'Your avatar has been updated.');
    }

    public function updateAvatarBackground(Request $req)
    {
        $user = auth()->user();

        $user->avatar_bg = $req->input('avatar_bg');
        $user->save();

        return redirect()->back()->with('success', 'Your avatar background has been updated.');
    }

    public function updateCover(StoreCoverRequest $request)
    {
        $user = auth()->user();

        $canUpdateCover = $user->isInGroup('Upgrade 1') || $user->isInGroup('Upgrade 2') || $user->hasRole('admin');

        if ($canUpdateCover) {
            $user->updateCover($request->input('cover'));
            $user->show_cover = $request->input('show_cover');
            $user->save();

            return redirect()->back()->with('success', 'Your cover has been updated.');
        }

        return redirect()->back()->with('error', 'You do not have permission to update your cover.');
    }

    public function min(Request $request)
    {
        $user = auth()->user();

        $canUpdate = $user->isInGroup('Upgrade 1') || $user->isInGroup('Upgrade 2') || $user->hasRole('admin');

        // TODO: Move to its own request
        $request->validate([
            'title' => 'nullable|string|max:255',
            'username_color' => 'nullable|string|max:7',
            'display_group_id' => 'nullable|integer|exists:groups,id',
            'show_displayed_group' => 'required|boolean',
        ]);

        if ($canUpdate) {
            $user->title = $request->input('title');
            $user->username_color = $request->input('username_color');
        } else {
            if ($request->input('title') || $request->input('username_color')) {
                return redirect()->back()->withErrors(['You must be in Upgrade 1 or Upgrade 2 group to update title or username color.']);
            }
        }

        // TODO make action
        $user->display_group_id = $request->input('display_group_id');
        $user->show_displayed_group = $request->input('show_displayed_group');
        $user->save();

        return redirect()->back()->with('success', 'Your profile has been updated.');
    }
}
