<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'upcoming');
        $search = $request->query('search');

        $filters = [
            'upcoming'  => fn ($query) => $query->where('status', 'scheduled')->orderBy('kickoff_at'),
            'today'     => fn ($query) => $query->whereDate('kickoff_at', today())->orderBy('kickoff_at'),
            'finished'  => fn ($query) => $query->where('status', 'finished')->orderByDesc('kickoff_at'),
            'postponed' => fn ($query) => $query->where('status', 'postponed')->orderByDesc('kickoff_at'),
        ];

        $query = Game::with('competition');

        $applyFilter = $filters[$status] ?? $filters['upcoming'];
        $applyFilter($query);

        if($search) {
            $query->where(function ($query) use ($search) {
                $query->where('home_team', 'like', "%{$search}%")->orWhere('away_team', 'like', "%{$search}%");
            });
        }
            
        return Inertia::render('Admin/Games', [
           'games' => $query->get(),
           'status' => $status,
           'search' => $search,
           'upcomingGames' => Game::where('kickoff_at', '>', now())->count(),
        ]);
    }

    public function updateScore(Request $request, Game $game) {
        $request->validate([
            'home_score' => ['required', 'integer', 'min:0'],
            'away_score' => ['required', 'integer', 'min:0'],
        ]);

        $game->home_score = $request->home_score;
        $game->away_score = $request->away_score;
        $game->status = 'finished';

        $game->save();

        return back();
    }

    public function show(Game $game) {

        return Inertia::render('Admin/DetailGame', [
            'game' => $game
        ]);
    }
}