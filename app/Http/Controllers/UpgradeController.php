<?php

namespace App\Http\Controllers;

use App\Models\Group;

class UpgradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // TODO: Change away from hardcoding.
        $upgrade1 = Group::where('name', 'Upgrade 1')->first();
        $upgrade2 = Group::where('name', 'Upgrade 2')->first();

        return view('upgrade.index', compact('upgrade1', 'upgrade2'));
    }
}
