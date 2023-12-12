<?php

namespace App\Http\Controllers;

use App\Actions\CreateReputation;
use App\Models\User;
use App\Models\Reputation;
use App\Services\ReputationService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReputationStoreRequest;

class ReputationController extends Controller
{
    protected $createReputation;

    /**
     * Create a new controller instance.
     */
    public function __construct(CreateReputation $createReputation)
    {
        $this->middleware('auth')->only(['give', 'store']);
        $this->createReputation = $createReputation;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reputationLogs = Reputation::getReputationLogs();
        return view('forum.reputation.index', compact('reputationLogs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $reputationData = Reputation::getReputationData($user);
        return view('forum.reputation.show', compact('user', 'reputationData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function give(User $user, ReputationService $reputationService)
    {
        $this->authorize('give-reputation', [$user, Auth::user()]);

        $allowedReputations = $reputationService->allowedReputationsForRole(auth()->user());

        return view('forum.reputation.give', [
            'user' => $user,
            'allowedPoints' => $allowedReputations,
        ]);
    }

    /**
     * Display a listing of the resource given by the user.
     */
    public function given(User $user)
    {
        $reputationGivenData = Reputation::where('giver_id', $user->id)->get();

        return view('forum.reputation.given', [
            'user' => $user,
            'reputationGivenData' => $reputationGivenData,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReputationStoreRequest $request, User $user)
    {
        $this->authorize('give-reputation', [$user, Auth::user()]);

        $validatedData = $request->validated();
        $validatedData['giver_id'] = Auth::id();
        $validatedData['user_id'] = $user->id;

        $this->createReputation->execute($validatedData);

        return redirect()->route('users.reputation.show', $user)->with('success', 'Reputation added successfully.');
    }
}
