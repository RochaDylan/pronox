<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
use App\Models\Game;
use App\Models\Competition;


use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {

        $missingScore = Game::where('status', 'finished')->whereNull('home_score')->count();
        $postponed = Game::where('status', 'postponed')->orderBy('kickoff_at')->get(['home_team', 'away_team']);
        return Inertia::render('Admin/Dashboard', [
            'users' => User::count(),

            'upcomingGames' => Game::where('kickoff_at', '>', now())->count(),
            'todayGame' => Game::whereDate('kickoff_at', today())->count(),
            'missingScore' => $missingScore,
            'postponed' => $postponed->count(),

            'groups' => Group::count(),
            'groupsThisWeek' => Group::where('created_at', '>=', now()->startOfWeek())->count(),

            'competitions' => Competition::count(),
        ]);
    }
}
