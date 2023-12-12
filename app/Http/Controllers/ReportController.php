<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function create(User $user)
    {
        $this->authorize('report', [$user, Auth::user()]);
        return view('forum.reports.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user, Request $request)
    {
        $this->authorize('report', [$user, Auth::user()]);

        $report = $this->createNewReport($request);
        $request->user()->reportsMade()->save($report);

        return redirect()->route('profile.show', ['user' => $user->slug]);
    }

    /**
     * Create a new report.
     */
    private function createNewReport($request)
    {
        $report = new Report([
            'reason' => $request->input('reason'),
        ]);

        $report->reportedUser()->associate($request->input('reported_user_id'));
        $report->reporter()->associate($request->user());

        return $report;
    }
}
