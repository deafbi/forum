<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vouch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VouchController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['give', 'store']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchLogs = Vouch::with(['user', 'vouchedByUser'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('forum.vouch.index', [
            'vouchLogs' => $vouchLogs,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $vouchData = Vouch::query()
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('forum.vouch.show', [
            'user' => $user,
            'vouchData' => $vouchData,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function give(User $user)
    {
        $this->authorize('vouch', [$user, Auth::user()]);

        return view('forum.vouch.give', [
            'user' => $user,
        ]);
    }

    /**
     * Display a listing of the resource given by the user.
     */
    public function given(User $user)
    {
        $vouchGivenData = Vouch::where('vouched_by', $user->id)->get();

        return view('forum.vouch.given', [
            'user' => $user,
            'vouchGivenData' => $vouchGivenData,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('vouch', [$user, Auth::user()]);

        // TODO: Move into request
        $this->validate($request, [
            'type' => 'required|in:positive,negative,neutral',
            'reason' => 'required|string|max:255',
        ]);

        // TODO: Move into action
        $vouch = new Vouch([
            'type' => $request->type,
            'reason' => $request->reason,
        ]);

        $vouch->user()->associate($user->id);
        $vouch->vouchedByUser()->associate(auth()->user()->id);
        $vouch->save();

        return redirect()->back()->with('message', 'Vouch added successfully.');
    }
}
